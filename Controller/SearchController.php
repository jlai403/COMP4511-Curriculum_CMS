<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/BaseController.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Constants.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Search/SearchCriteriaDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/View/Search/SearchViewHelper.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');

class SearchController extends BaseController {
	function query() {
		$queryString = $_POST["queryString"];
		
		$searchCriteriaDto = new SearchCriteriaDto();
		$searchCriteriaDto->setQueryString($queryString);
		$searchCriteriaDto->setType(SearchCriteriaTypes::PROGRAM); //todo: Hardcoded for now, should be dynamic or based on user input
		
		$searchResultsDto = FacadeFactory::getSearchFacade()->search($searchCriteriaDto);
		
		SessionManager::set("searchResults", $searchResultsDto);
		parent::redirect("/View/Search/SearchResults.php");
	}

    function sort() {
        $queryString = $_POST["queryString"];
        $sortBy = $_POST["sortBy"];

        $searchCriteriaDto = new SearchCriteriaDto();
        $searchCriteriaDto->setQueryString($queryString);
        $searchCriteriaDto->setType(SearchCriteriaTypes::PROGRAM); //todo: Hardcoded for now, should be dynamic or based on user input

        $searchResultDtos = FacadeFactory::getSearchFacade()->search($searchCriteriaDto);

        $sortedSearchResultDtos = array();

        switch($sortBy) {
            case "Name":
                $sortedSearchResultDtos = (new SearchViewHelper())->sortByName($searchResultDtos->getSearchResultDtos());
                break;
            case "Type":
                $sortedSearchResultDtos = (new SearchViewHelper())->sortByType($searchResultDtos->getSearchResultDtos());
                break;
            case "Requester":
                $sortedSearchResultDtos = (new SearchViewHelper())->sortByRequester($searchResultDtos->getSearchResultDtos());
                break;
        }

        echo json_encode($sortedSearchResultDtos);
    }
}

$action = $_GET['action'];
(new SearchController())->invokeAction($action);
