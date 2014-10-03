<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Constants.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/Program.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');

class ProgramRepository extends Repository {
	
	public function createProgramRequest(Program $program) {
		$workflowDataId = (new WorkflowRepository())->create(ApprovalChainConstants::PROGRAM_APPROVAL_CHAIN_NAME);
		$params = array(
			$program->getProgramName(),
			$program->getComments(),
			$program->getRequester()->getId(),
			$program->getDiscipline()->getId(),
			$program->getRequestedDate(),
			$workflowDataId
		);
		$success = parent::executeStoredProcedure("call createProgramRequest(?,?,?,?,?,?)", $params);
		if(!$success) {
			(new WorkflowRepository())->delete($workflowDataId);
			throw new MyException("Error when trying to create program request");
		}
	}
	
	public function findProgramsByRequester($userId) {
		$params = array($userId);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findProgramsByRequester(?)", $params);
		return $this->extractProgramsFromResultSet($resultSet);
	}
	
	public function findProgramsForApproval($userId) {
		$params = array($userId);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findProgramsForApproval(?)", $params);
		return $this->extractProgramsFromResultSet($resultSet);
	}
	
	public function findById($id) {
		$params = array($id);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findProgramById(?)", $params);
		return $this->extractProgramFromRecord($resultSet[0]);
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
		$program->setId($record["id"]);
		$program->setProgramName($record["name"]);
		$program->setComments($record["comments"]);
		$program->setRequestedDate($record["requestedDate"]);
		
		$requester = (new UserRepository())->findById($record["requester_id"]);
		$program->setRequester($requester);
		
		$discipline = (new DisciplineRepository())->findById($record["discipline_id"]);
		$program->setDiscipline($discipline);
		
		$workflowData = (new WorkflowRepository())->findById($record["workflowData_id"]);
		$program->setWorkflowData($workflowData);
		
		return $program;
	}
}