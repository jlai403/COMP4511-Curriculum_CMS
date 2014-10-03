<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Constants.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Comment/CommentRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/Program.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');

class ProgramRepository extends Repository {
	
	public function createProgramRequest(Program $program) {
		$workflowDataId = (new WorkflowRepository())->create(ApprovalChainConstants::PROGRAM_APPROVAL_CHAIN_NAME);
		$params = array(
			$program->getProgramName(),
			$program->getRequester()->getId(),
			$program->getDiscipline()->getId(),
			$program->getRequestedDate(),
			$workflowDataId
		);
		$resultSet = parent::executeStoredProcedureWithResultSet("call createProgramRequest(?,?,?,?,?)", $params);
		$program->setId($resultSet[0]["ProgramId"]);
		
		$this->addCommentsToProgram($program);
	}
	
	private function addCommentsToProgram(Program $program) {
		foreach($program->getComments() as $comment) {
			$commentId = (new CommentRepository())->create($comment);
			$this->addCommentToProgram($program->getId(), $commentId);
		}
	}
	
	public function addCommentToProgram($programId, $commentId) {
		$params = array($programId, $commentId);
		$success = parent::executeStoredProcedure("call addCommentToProgram(?,?)", $params);
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
		$program->setRequestedDate($record["requestedDate"]);
		
		$comments = (new CommentRepository())->findCommentsForProgram($program->getId());
		$program->setComments($comments);
		
		$requester = (new UserRepository())->findById($record["requester_id"]);
		$program->setRequester($requester);
		
		$discipline = (new DisciplineRepository())->findById($record["discipline_id"]);
		$program->setDiscipline($discipline);
		
		$workflowData = (new WorkflowRepository())->findById($record["workflowData_id"]);
		$program->setWorkflowData($workflowData);
		
		return $program;
	}
}