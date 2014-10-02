<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/ApprovalChain/ApprovalChainRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowData.php');

class WorkflowRepository extends Repository {
	
	public function create($approvalChainName) {
		$params = array(
			$approvalChainName
		);
		$resultSet = parent::executeStoredProcedureWithResultSet("call createWorkflowData(?)", $params);
		return $resultSet[0]["WorkflowDataId"];
	}
	
	public function findById($id) {
		$params = array(
			$id
		);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findWorkflowDataById(?)", $params);
		return $this->extractWorkflowDataFromRecord($resultSet[0]);
	}
	
	public function findStatusById($id) {
		$params = array(
			$id
		);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findStatusById(?)", $params);
		return $resultSet[0]["name"];
	}
	
	private function extractWorkflowDataFromRecord($record) {
		$workflowData = new WorkflowData();
		
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