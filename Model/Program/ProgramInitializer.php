<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserInitializer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Discipline/DisciplineInitializer.php');

class ProgramInitializer {
	
	private $programInputDto;
	
	public function __construct(ProgramInputDto $programInputDto) {
		$this->programInputDto = $programInputDto;
	}
	
	public function initialize() {
		$program = new Program();
		$program->setProgramName($this->programInputDto->getProgramName());
		$program->setComments($this->programInputDto->getComments());
		
		$discipline = (new DisciplineInitializer($this->programInputDto->getDisciplineDto()))->initialize();
		$program->setDiscipline($discipline);
		
		$requester = (new UserInitializer($this->programInputDto->getRequesterDto()))->initialize();
		$program->setRequester($requester);
		return $program;
	}
}