<?php

class WorkflowDataDto {
	private $id;
	private $approvalChainStepDto;
	private $status;
	private $previousWorkflowDataDto;
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function getApprovalChainStepDto(){
		return $this->approvalChainStepDto;
	}
	
	public function setApprovalChainStepDto($approvalChainStepDto){
		$this->approvalChainStepDto = $approvalChainStepDto;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function getPreviousWorkflowDataDto(){
		return $this->previousWorkflowDataDto;
	}
	
	public function setPreviousWorkflowDataDto($previousWorkflowDataDto){
		$this->previousWorkflowDataDto = $previousWorkflowDataDto;
	}
}