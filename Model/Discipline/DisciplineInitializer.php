<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Discipline/Discipline.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Faculty/FacultyInitializer.php');

class DisciplineInitializer {
	
	private $disciplineDto;
	
	public function __construct(DisciplineDto $disciplineDto) {
		$this->disciplineDto = $disciplineDto;
	}
	
	public function initialize() {
		$discipline = new Discipline();
		$discipline->setId($this->disciplineDto->getId());
		$discipline->setName($this->disciplineDto->getName());
		$discipline->setCode($this->disciplineDto->getCode());
		
		$faculty = (new FacultyInitializer($this->disciplineDto->getFacultyDto()))->initialize();
		$discipline->setFaculty($faculty);
		
		return $discipline;
	}
}