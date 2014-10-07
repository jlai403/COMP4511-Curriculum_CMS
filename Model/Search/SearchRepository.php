<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Search/SearchResult.php');

class SearchRepository extends Repository {
	
	public function search(SearchCriteriaDto $searchCriteriaDto) {
		$resultSet = array();
		switch($searchCriteriaDto->getType()) {
			case SearchCriteriaTypes::PROGRAM:
				$query = $this->buildQueryForProgram($searchCriteriaDto);
				$resultSet = $this->executeQueryWithResultSet($query);
				break;
			default: 
				throw new MyException("Unknown search type.");
		}
		return $this->extractSearchResults($resultSet);
	}
	
	private function extractSearchResults($resultSet){
		if (empty($resultSet)) return null;
		$searchResults = array();
		
		foreach ($resultSet as $record) {
			$searchResult = new SearchResult();
			$searchResult->setType($record["type"]);
			$searchResult->setId($record["id"]);
			$searchResult->setName($record["name"]);
			$searchResult->setRequesterFirstName($record["requesterFirstName"]);
			$searchResult->setRequesterLastName($record["requesterLastName"]);
			array_push($searchResults, $searchResult);
		}

		return $searchResults;
	}
	
	private function buildQueryForProgram(SearchCriteriaDto $searchCriteriaDto) {
		$query = 
		"
			SELECT 'Program' as 'type', p.id, p.name, u.firstName as 'requesterFirstName', u.lastName as 'requesterLastName'
				from Program p
					join User u on p.requester_id = u.id
				where 1=1
				
		";
		$query .= "and p.name like '%" . $searchCriteriaDto->getQueryString() . "%'";
		
		$query .= ";";
		
		return $query;
	}
}