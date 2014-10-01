<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Discipline/Discipline.php');

class DisciplineRepository extends Repository {
	
	public function findAll() {
		$params = array();
		$resultSet = $this->executeStoredProcedureWithResultSet("call findAllDisciplines()", $params);
		$disciplines = $this->extractDisciplinesFromResultSet($resultSet);
		return $disciplines;
	}
	
private function extractDisciplinesFromResultSet($resultSet) {
		$disciplines = array();
		foreach($resultSet as $record) {
			array_push($disciplines, $this->extractDisciplinesFromRecord($record));
		}
		return $disciplines;
	}
	
	private function extractDisciplinesFromRecord($record) {
		$discipline = new Discipline();
		$discipline->setId($record['id']);
		$discipline->setName($record['name']);
		$discipline->setCode($record['code']);
		return $discipline;
	}
}