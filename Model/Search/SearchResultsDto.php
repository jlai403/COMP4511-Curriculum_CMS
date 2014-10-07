<?php

class SearchResultsDto {
	private $queryString;
	private $searchResultDtos;
	
	function __construct() {
		$this->searchResultDtos = array();
	}
	
	public function getQueryString() {
		return $this->queryString;
	}
	
	public function setQueryString($queryString) {
		$this->queryString = $queryString;
	}
	
	public function getSearchResultDtos() {
		return $this->searchResultDtos;
	}
	
	public function addSearchResultDto($searchResultDto) {
		array_push($this->searchResultDtos, $searchResultDto);
	}
}