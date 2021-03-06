<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Faculty/Faculty.php');

class FacultyRepository extends Repository {
	
	public function findAll() {
		$params = array();
		$resultSet = $this->executeStoredProcedureWithResultSet("call findAllFaculties()", $params);
		$faculties = $this->extractFacultiesFromResultSet($resultSet);
		return $faculties;
	}
	
	public function findById($id) {
		$params = array($id);
		$resultSet = $this->executeStoredProcedureWithResultSet("call findFacultyById(?)", $params);
		$faculty = $this->extractFacultyFromRecord($resultSet[0]);
		return $faculty;
	}
	
	private function extractFacultiesFromResultSet($resultSet) {
		$faculties = array();
		foreach($resultSet as $record) {
			array_push($faculties, $this->extractFacultyFromRecord($record));
		}
		return $faculties;
	}
	
	private function extractFacultyFromRecord($record) {
		$faculty = new Faculty();
		$faculty->setId($record['id']);
		$faculty->setName($record['name']);
		return $faculty;
	}
}