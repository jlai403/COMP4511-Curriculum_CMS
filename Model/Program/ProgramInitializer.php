<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Discipline/DisciplineInitializer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Comment/CommentInitializer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/FileInitializer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Term/TermInitializer.php');

class ProgramInitializer {
	
	private $programInputDto;
	
	public function __construct(ProgramInputDto $programInputDto) {
		$this->programInputDto = $programInputDto;
	}
	
	public function initialize() {
		$program = new Program();
		$program->setProgramName($this->programInputDto->getProgramName());
		$program->setRequestedDate(date("Y-m-d"));
		$program->setCrossImpact($this->programInputDto->getCrossImpact());
		$program->setStudentImpact($this->programInputDto->getStudentImpact());
		$program->setLibraryImpact($this->programInputDto->getLibraryImpact());
		$program->setItsImpact($this->programInputDto->getItsImpact());
		
		$this->addComments($program);
		$this->addFiles($program);
		
		$term = (new TermInitializer($this->programInputDto->getEffectiveTermDto()))->initialize();
		$program->setEffectiveTerm($term);
		
		$discipline = (new DisciplineInitializer($this->programInputDto->getDisciplineDto()))->initialize();
		$program->setDiscipline($discipline);
		
		$requester = (new UserInitializer($this->programInputDto->getRequesterDto()))->initialize();
		$program->setRequester($requester);
		return $program;
	}
	
	private function addComments($program) {
		$commentString = $this->programInputDto->getComments();
		if (trim($commentString) == false) return;

		$commentAuthor = $this->programInputDto->getRequesterDto();
		$comment = (new CommentInitializer($commentString, $commentAuthor))->initialize();
		$program->addComment($comment);
	}
	
	private function addFiles(Program $program) {
		$files = (new FileInitializer())->initializeAll($this->programInputDto->getFileInputDtos());
		$program->setFiles($files);
	}
}