<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');

class WorkflowRepository extends Repository {
	
	public function create($approvalChainName) {
		$params = array(
			$approvalChainName
		);
		$resultSet = parent::executeStoredProcedureWithResultSet("call createWorkflowData(?)", $params);
		return $resultSet[0]["WorkflowDataId"];
	}
}