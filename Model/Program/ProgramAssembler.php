<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/Program.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowDataAssembler.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Comment/CommentAssembler.php');

class ProgramAssembler {
	
	public function assembleAll($programs) {
		$programDtos = array();
		foreach($programs as $program) {
			$programDto = $this->assemble($program);
			array_push($programDtos, $programDto);
		}
		return $programDtos;
	}
	
	
	public function assemble(Program $program) {
		$programDto = new ProgramDto();
		$programDto->setId($program->getId());
		$programDto->setRequestedDate($program->getRequestedDate());
		$programDto->setProgramName($program->getProgramName());
		$programDto->setRequesterName($program->getRequester()->getFullName());

		$commentDtos = (new CommentAssembler())->assembleAll($program->getComments());
		$programDto->setCommentDtos($commentDtos);
		
		$disciplineDto = (new DisciplineAssembler())->assemble($program->getDiscipline());
		$programDto->setDisciplineDto($disciplineDto);
		
		$workflowDataDto = (new WorkflowDataAssembler())->assemble($program->getWorkflowData());
		$programDto->setWorkflowDataDto($workflowDataDto);
		
		return $programDto;
	}
}