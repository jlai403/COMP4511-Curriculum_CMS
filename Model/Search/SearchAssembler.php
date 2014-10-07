<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Search/SearchResult.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Search/SearchResultDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Search/SearchResultsDto.php');

class SearchAssembler {
	
	private $queryString;
	
	function __construct($queryString) {
		$this->queryString = $queryString;
	}
	
	public function assemble($searchResults) {
		$searchResultsDto = new SearchResultsDto();
		$searchResultsDto->setQueryString($this->queryString);
		
		foreach($searchResults as $searchResult) {
			$searchResultDto = new SearchResultDto();
			$searchResultDto->setUri($this->getUriForType($searchResult->getType(), $searchResult->getId()));
			
			$searchResultDto->setType($searchResult->getType());
			$searchResultDto->setName($searchResult->getName());
			$searchResultDto->setRequesterFirstName($searchResult->getRequesterFirstName());
			$searchResultDto->setRequesterLastName($searchResult->getRequesterLastName());
			
			$searchResultsDto->addSearchResultDto($searchResultDto);
		}
		
		return $searchResultsDto;
	}
	
	private function getUriForType($type, $id) {
		switch ($type) {
			case SearchCriteriaTypes::PROGRAM:
				return "/View/Program/Summary.php?id=".$id;
				break;
			default:
				throw new MyException("Unknown search type.");
		}		
	}
}