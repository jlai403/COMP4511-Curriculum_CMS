<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Discipline/DisciplineInitializer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Comment/CommentInitializer.php');

class ProgramInitializer {
	
	private $programInputDto;
	
	public function __construct(ProgramInputDto $programInputDto) {
		$this->programInputDto = $programInputDto;
	}
	
	public function initialize() {
		$program = new Program();
		$program->setProgramName($this->programInputDto->getProgramName());
		
		$commentString = $this->programInputDto->getComments();
		$commentAuthor = $this->programInputDto->getRequesterDto();
		$comment = (new CommentInitializer($commentString, $commentAuthor))->initialize();
		$program->addComment($comment);
		
		$discipline = (new DisciplineInitializer($this->programInputDto->getDisciplineDto()))->initialize();
		$program->setDiscipline($discipline);
		
		$requester = (new UserInitializer($this->programInputDto->getRequesterDto()))->initialize();
		$program->setRequester($requester);
		return $program;
	}
}