<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Constants.php');

class SearchCriteriaDto {
	private $type;
	private $queryString;
	
	public function getType() {
		return $this->type;
	}
	
	public function setType($type) {
		$this->type = $type;
	}
	
	public function getQueryString() {
		return $this->queryString;
	}
	
	public function setQueryString($queryString) {
		$this->queryString = $queryString;
	}
}