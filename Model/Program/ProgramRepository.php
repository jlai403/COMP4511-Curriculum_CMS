<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Constants.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramInputDto.php');

class ProgramRepository extends Repository {
	
	public function createProgramRequest(ProgramInputDto $programInputDto) {
		$workflowDataId = (new WorkflowRepository())->create(ApprovalChainConstants::PROGRAM_APPROVAL_CHAIN_NAME);
		$params = array(
			$workflowDataId,
			$programInputDto->getProgramName(),
			$programInputDto->getRequesterId(),
			$programInputDto->getDisciplineId()
			
		);
		parent::executeStoredProcedure("call createProgramRequest(?,?,?,?)", $params);
	}
}