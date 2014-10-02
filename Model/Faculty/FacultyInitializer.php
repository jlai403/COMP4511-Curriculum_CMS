<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Faculty/Faculty.php');

class FacultyInitializer {
	
	private $facultyDto;
	
	public function __construct(FacultyDto $facultyDto) {
		$this->facultyDto = $facultyDto;
	}
	
	public function initialize() {
		$faculty = new Faculty();
		$faculty->setId($this->facultyDto->getId());
		$faculty->setName($this->facultyDto->getName());
		return $faculty;
	}
}