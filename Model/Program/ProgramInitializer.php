<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Discipline/DisciplineInitializer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Comment/CommentInitializer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/FileInitializer.php');

class ProgramInitializer {
	
	private $programInputDto;
	
	public function __construct(ProgramInputDto $programInputDto) {
		$this->programInputDto = $programInputDto;
	}
	
	public function initialize() {
		$program = new Program();
		$program->setProgramName($this->programInputDto->getProgramName());
		$program->setRequestedDate(date("Y-m-d"));
		
		$this->addComments($program);
		$this->addFiles($program);
		
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
		if (empty($this->programInputDto->getFileInputDtos())) return;
		
		foreach($this->programInputDto->getFileInputDtos() as $fileInputDto) {
			$file = (new FileInitializer($fileInputDto))->initialize();
			$program->addFile($file);
		}
	}
}