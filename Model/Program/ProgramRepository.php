<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Constants.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Comment/CommentRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/FileRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/Program.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');

class ProgramRepository extends Repository {
	
	public function approve(User $user, Program $program) {
		$workflowDataId = (new WorkflowRepository())->advanceToNextStep(ApprovalChainConstants::PROGRAM_APPROVAL_CHAIN_NAME, $user, $program->getCurrentWorkflowData());
		if ($program->getCurrentWorkflowData()->getId() === $workflowDataId) return;
		
		$this->updateWorkflowDataForProgram($program, $workflowDataId);
	}
	
	public function reject(User $user, Program $program) {
		(new WorkflowRepository())->reject($user, $program->getCurrentWorkflowData());
	}
	
	
	private function updateWorkflowDataForProgram(Program $program, $workflowDataId) {
		$params = array($program->getId(), $workflowDataId);
		$success = parent::executeStoredProcedure("call updateWorkflowDataForProgram(?,?)", $params);
	}
	
	public function createProgramRequest(Program $program) {
        $this->addWorkflowData($program);

		$params = array(
			$program->getProgramName(),
			$program->getRequester()->getId(),
			$program->getDiscipline()->getId(),
			$program->getRequestedDate(),
			$program->getCurrentWorkflowData()->getId(),
			$program->getEffectiveTerm()->getId(),
			$program->getCrossImpact(),
			$program->getStudentImpact(),
			$program->getLibraryImpact(),
			$program->getItsImpact()
		);
		
		$resultSet = parent::executeStoredProcedureWithResultSet("call createProgramRequest(?,?,?,?,?,?,?,?,?,?)", $params);
		$program->setId($resultSet[0]["ProgramId"]);
		
		$this->addCommentsToProgram($program);
		$this->addFilesToProgram($program->getId(), $program->getFiles());

        return $program;
	}


    public function addWorkflowData(Program $program)
    {
        $workflowDataId = (new WorkflowRepository())->create(ApprovalChainConstants::PROGRAM_APPROVAL_CHAIN_NAME);
        $workflowData = (new WorkflowRepository())->findById($workflowDataId);
        $program->setCurrentWorkflowData($workflowData);
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
	
	public function addFilesToProgram($programId, $files) {
		if (empty($files)) return;
		foreach($files as $file) {
			$fileId = (new FileRepository())->create($file);
			$this->addFileToProgram($programId, $fileId);
		}
	}
	
	public function addFileToProgram($programId, $fileId) {
		$params = array($programId, $fileId);
		$success = parent::executeStoredProcedure("call addFileToProgram(?,?)", $params);
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
		$program->setCrossImpact($record["crossImpact"]);
		$program->setStudentImpact($record["studentImpact"]);
		$program->setLibraryImpact($record["libraryImpact"]);
		$program->setItsImpact($record["itsImpact"]);
		
		$comments = (new CommentRepository())->findCommentsForProgram($program->getId());
		$program->setComments($comments);
		
		$files = (new FileRepository())->findFilesForProgram($program->getId());
		$program->setFiles($files);
		
		$requester = (new UserRepository())->findById($record["requester_id"]);
		$program->setRequester($requester);
		
		$discipline = (new DisciplineRepository())->findById($record["discipline_id"]);
		$program->setDiscipline($discipline);
		
		$effectiveTerm = (new TermRepository())->findById($record["effectiveTerm_id"]);
		$program->setEffectiveTerm($effectiveTerm);
		
		$workflowDatas = array();
		(new WorkflowRepository())->getWorkflowDataHistory($record["workflowData_id"], $workflowDatas);
		$program->setWorkflowDatas($workflowDatas);
		
		return $program;
	}
}