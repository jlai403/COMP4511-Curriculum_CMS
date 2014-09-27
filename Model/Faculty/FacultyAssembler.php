<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Faculty/Faculty.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Faculty/FacultyDto.php');

class FacultyAssembler {
	
	public function assembleAll($faculties) {
		$facultyDtos = array();
		foreach($faculties as $faculty){
			$facultyDto = new FacultyDto();
			$facultyDto->setId($faculty->getId());
			$facultyDto->setName($faculty->getName());
			
			array_push($facultyDtos, $faculty);
		}
		return $facultyDtos;
	}
}