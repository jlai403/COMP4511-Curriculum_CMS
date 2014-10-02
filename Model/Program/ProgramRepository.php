<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Constants.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramInputDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/Program.php');
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
	
	public function findProgramsByRequester($userId) {
		$params = array($userId);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findProgramsByRequester(?)", $params);
		return $this->extractProgramsFromResultSet($resultSet);
	}
	
	private function extractProgramsFromResultSet($resultSet) {
		$programs = array();
		foreach($resultSet as $record) {
			array_push($programs, $this->extractProgramFromRecord($record));
		}
		return $programs;
	}
	
	private function extractProgramFromRecord($record) {
		$program = new Program();
		$program->setProgramName($record["name"]);
		$program->setComments($record["comments"]);
		
		$requester = (new UserRepository())->findById($record["requester_id"]);
		$program->setRequester($requester);
		
		$discipline = (new DisciplineRepository())->findById($record["discipline_id"]);
		$program->setDiscipline($discipline);
		
		$workflowData = (new WorkflowRepository())->findById($record["workflowData_id"]);
		$program->setWorkflowData($workflowData);
		
		return $program;
	}
}