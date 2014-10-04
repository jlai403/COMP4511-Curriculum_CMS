<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/IEntity.php');

class WorkflowData implements IEntity {
	private $id;
	private $approvalChainStep;
	private $status;
	private $previousWorkflowData;
	private $user;
	
	// Overriden: IEntity
	public function getId(){
		return $this->id;
	}
	
	// Overriden: IEntity
	public function setId($id){
		$this->id = $id;
	}
	
	// Overriden: IEntity
	public function assertValid(){
	}
	
	public function getApprovalChainStep(){
		return $this->approvalChainStep;
	}
	
	public function setApprovalChainStep($approvalChainStep){
		$this->approvalChainStep = $approvalChainStep;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function getPreviousWorkflowData(){
		return $this->previousWorkflowData;
	}
	
	public function setPreviousWorkflowData($previousWorkflowData){
		$this->previousWorkflowData = $previousWorkflowData;
	}
	
	public function getUser(){
		return $this->user;
	}
	
	public function setUser($user){
		$this->user = $user;
	}
	
}