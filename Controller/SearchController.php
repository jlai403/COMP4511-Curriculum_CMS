<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/BaseController.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Constants.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Search/SearchCriteriaDto.php');
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
}

$action = $_GET['action'];
(new SearchController())->invokeAction($action);
