<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Role/RoleRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/ApprovalChain/ApprovalChainStep.php');

class ApprovalChainRepository extends Repository {
	
	public function findApprovalChainStepById($id) {
		$params = array(
			$id
		);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findApprovalChainStepById(?)", $params);
		return $this->extractApprovalChainStepFromRecord($resultSet[0]);
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