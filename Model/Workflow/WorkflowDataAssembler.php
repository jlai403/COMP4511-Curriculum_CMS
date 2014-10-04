<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowData.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowDataDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/StatusFactory.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/ApprovalChain/ApprovalChainAssembler.php');

class WorkflowDataAssembler {
	
	public function assembleAll($workflowDatas) {
		$workflowDataDtos = array();
		foreach($workflowDatas as $workflowData) {
			$workflowDataDto = $this->assemble($workflowData);
			array_push($workflowDataDtos, $workflowDataDto);
		}
		return $workflowDataDtos;
	}
	
	public function assemble(WorkflowData $workflowData) {
		$workflowDataDto = new WorkflowDataDto();
		$workflowDataDto->setId($workflowData->getId());
	
		$status = (new StatusFactory())->getStatus($workflowData->getStatus());
		$workflowDataDto->setStatus($status);
	
		$userDto = (new UserAssembler())->assemble($workflowData->getUser());
		$workflowDataDto->setUserDto($userDto);
		
		$approvalChainStepDto = (new ApprovalChainAssembler())->assemble($workflowData->getApprovalChainStep());
		$workflowDataDto->setApprovalChainStepDto($approvalChainStepDto);
	
		$previousWorkflowData = $workflowData->getPreviousWorkflowData();
		if (!is_null($previousWorkflowData)) {
			$previousWorkflowDataDto = $this->assemble($previousWorkflowData);
			$workflowDataDto->setPreviousWorkflowDataDto($previousWorkflowDataDto);
		}
		return $workflowDataDto;
	}
}