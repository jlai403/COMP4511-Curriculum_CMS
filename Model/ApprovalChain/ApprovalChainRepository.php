<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Role/RoleRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/ApprovalChain/ApprovalChainStep.php');

class ApprovalChainRepository extends Repository {
	
	public function findApprovalChainStepById($id) {
		$params = array($id);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findApprovalChainStepById(?)", $params);
		return $this->extractApprovalChainStepFromRecord($resultSet[0]);
	}
	
	public function getNextApprovalChainStepId($approvalChainName, ApprovalChainStep $approvalChainStep) {
		$sequenceToGet = $approvalChainStep->getSequence() + 1;
		$params = array(
			$approvalChainName,
			$sequenceToGet
		);
		$resultSet = parent::executeStoredProcedureWithResultSet("call getApprovalChainStepId(?,?)", $params);

		if (empty($resultSet)) return null;	
		return $resultSet[0]["id"];
	}
	
	private function extractApprovalChainStepFromRecord($record) {
		$approvalChainStep = new ApprovalChainStep();
		$approvalChainStep->setId($record["id"]);
		$approvalChainStep->setSequence($record["sequence"]);
		
		$role = (new RoleRepository())->findById($record["role_id"]);
		$approvalChainStep->setRole($role);
		return $approvalChainStep;
	}
}