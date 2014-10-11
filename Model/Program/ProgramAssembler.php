<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/Program.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowDataAssembler.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Comment/CommentAssembler.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/FileAssembler.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Term/TermAssembler.php');

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
		$programDto->setCrossImpact($program->getCrossImpact());
		$programDto->setStudentImpact($program->getStudentImpact());
		$programDto->setLibraryImpact($program->getLibraryImpact());
		$programDto->setItsImpact($program->getItsImpact());

		$commentDtos = (new CommentAssembler())->assembleAll($program->getComments());
		$programDto->setCommentDtos($commentDtos);
				
		$fileDtos = (new FileAssembler())->assembleAll($program->getFiles());
		$programDto->setFileDtos($fileDtos);
		
		$disciplineDto = (new DisciplineAssembler())->assemble($program->getDiscipline());
		$programDto->setDisciplineDto($disciplineDto);
		
		$effectiveTermDto = (new TermAssembler())->assemble($program->getEffectiveTerm());
		$programDto->setEffectiveTermDto($effectiveTermDto);
		
		$workflowDataDtos = (new WorkflowDataAssembler())->assembleAll($program->getWorkflowDatas());
		$programDto->setWorkflowDataDtos($workflowDataDtos);
		
		return $programDto;
	}
}