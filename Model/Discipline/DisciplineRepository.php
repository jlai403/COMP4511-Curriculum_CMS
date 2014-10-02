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
	
	public function findById($id) {
		$params = array($id);
		$resultSet = $this->executeStoredProcedureWithResultSet("call findDisciplineById(?)", $params);
		$discipline = $this->extractDisciplineFromRecord($resultSet[0]);
		return $discipline;
	}
	
	private function extractDisciplinesFromResultSet($resultSet) {
		$disciplines = array();
		foreach($resultSet as $record) {
			array_push($disciplines, $this->extractDisciplineFromRecord($record));
		}
		return $disciplines;
	}
	
	private function extractDisciplineFromRecord($record) {
		$discipline = new Discipline();
		$discipline->setId($record['id']);
		$discipline->setName($record['name']);
		$discipline->setCode($record['code']);
		
		$faculty = (new FacultyRepository())->findById($record["faculty_id"]);
		$discipline->setFaculty($faculty);
		return $discipline;
	}
}