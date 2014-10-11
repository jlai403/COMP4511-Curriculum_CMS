<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Term/Term.php');

class TermRepository extends Repository {
	
	public function findAll() {
		$resultSet = parent::executeStoredProcedureWithResultSet("call findAllTerms()");
		$terms = $this->extractTermsFromResultSet($resultSet);
		return $terms;
	}
	
	public function findById($termId) {
		$params = array($termId);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findTermById(?)", $params);
		$term = $this->extractTermFromRecord($resultSet[0]);
		return $term;
	}
	
	private function extractTermsFromResultSet($resultSet) {
		$terms = array();
		foreach($resultSet as $record) {
			array_push($terms, $this->extractTermFromRecord($record));
		}
		return $terms;
	}
	
	private function extractTermFromRecord($record) {
		$term = new Term();
		$term->setId($record['id']);
		$term->setYear($record['year']);
		$term->setTerm($record['term']);
		return $term;
	}
}