<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Discipline/Discipline.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Discipline/DisciplineDto.php');

class DisciplineAssembler {
	
	public function assembleAll($disciplines) {
		$disciplineDtos = array();
		foreach($disciplines as $discipline){
			$disciplineDto = new DisciplineDto();
			$disciplineDto->setId($discipline->getId());
			$disciplineDto->setName($discipline->getName());
			$disciplineDto->setCode($discipline->getCode());
			
			array_push($disciplineDtos, $disciplineDto);
		}
		return $disciplineDtos;
	}
	
	public function assemble(Discipline $discipline) {
		$disciplineDto = array();
		$disciplineDto = new DisciplineDto();
		$disciplineDto->setId($discipline->getId());
		$disciplineDto->setName($discipline->getName());
		$disciplineDto->setCode($discipline->getCode());
		
		$facultyDto = (new FacultyAssembler())->assemble($discipline->getFaculty());
		$disciplineDto->setFacultyDto($facultyDto);
		return $disciplineDto;
	}
}