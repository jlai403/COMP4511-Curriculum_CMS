<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Constants.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramInputDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');

class ProgramRepository extends Repository {
	
	public function createProgramRequest(ProgramInputDto $programInputDto) {
		$workflowDataId = (new WorkflowRepository())->create(ApprovalChainConstants::PROGRAM_APPROVAL_CHAIN_NAME);
		$params = array(
			$programInputDto->getProgramName(),
			$programInputDto->getComments(),
			$programInputDto->getRequesterId(),
			$programInputDto->getDisciplineId(),
			$workflowDataId
			
		);
		$success = parent::executeStoredProcedure("call createProgramRequest(?,?,?,?,?)", $params);
		if(!$success) throw new MyException("Error when trying to create program request");
	}
}