<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Constants.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/ApprovalChain/ApprovalChainRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowData.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');

class WorkflowRepository extends Repository {
	
	public function create($approvalChainName) {
		$params = array( $approvalChainName );
		$resultSet = parent::executeStoredProcedureWithResultSet("call createWorkflowData(?)", $params);
		return $resultSet[0]["WorkflowDataId"];
	}
	
	public function advanceToNextStep($approvalChainName, WorkflowData $workflowData) {
		$nextApprovalChainStepId = (new ApprovalChainRepository())->getNextApprovalChainStepId($approvalChainName, $workflowData->getApprovalChainStep());
		if (is_null($nextApprovalChainStepId)) {
			$this->updateWorkflowDataStatus($workflowData->getId(), StatusConstants::COMPLETED);
			return $workflowData->getId();
		} else {
			$this->updateWorkflowDataStatus($workflowData->getId(), StatusConstants::APPROVED);
				
			$params = array($nextApprovalChainStepId, $workflowData->getId());
			$resultSet = parent::executeStoredProcedureWithResultSet("call createWorkflowDataForApprovalChainStep(?,?)", $params);
			return $resultSet[0]["WorkflowDataId"];
		}
	}
	
	private function updateWorkflowDataStatus($id, $statusId) {
		$params = array($id, $statusId);
		$success = parent::executeStoredProcedure("call updateWorkflowDataStatus(?,?)", $params);
	}
	
	public function delete($id) {
		$params = array( $id );
		$success = parent::executeStoredProcedure("call deleteWorkflowData(?)", $params);
		if(!$success) throw new MyException("Error when deleting WorkflowData.");
	}
	
	public function findById($id) {
		$params = array( $id );
		$resultSet = parent::executeStoredProcedureWithResultSet("call findWorkflowDataById(?)", $params);
		return $this->extractWorkflowDataFromRecord($resultSet[0]);
	}
	
	public function findStatusById($id) {
		$params = array( $id );
		$resultSet = parent::executeStoredProcedureWithResultSet("call findStatusById(?)", $params);
		return $resultSet[0]["name"];
	}
	
	private function extractWorkflowDataFromRecord($record) {
		$workflowData = new WorkflowData();
		$workflowData->setId($record["id"]);
		$status = $this->findStatusById($record["status_id"]);
		$workflowData->setStatus($status);
		
		$approvalChainStep = (new ApprovalChainRepository())->findApprovalChainStepById($record["approvalChainStep_id"]);
		$workflowData->setApprovalChainStep($approvalChainStep);
		
		$workflowDataId = $record["previousWorkflowData_id"];
		if(!is_null($workflowDataId)){
			$previousWorkflowData = $this->findById($workflowDataId);
			$workflowData->setPreviousWorkflowData($previousWorkflowData);
		}
		
		return $workflowData;
	}
}