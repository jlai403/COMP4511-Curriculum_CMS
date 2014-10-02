<?php
class ApprovalChainStepDto {
	private $id;
	private $sequence;
	private $roleDto;
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}

	public function getSequence(){
		return $this->sequence;
	}
	
	public function setSequence($sequence){
		$this->sequence = $sequence;
	}
	
	public function getRoleDto(){
		return $this->roleDto;
	}
	
	public function setRoleDto($roleDto){
		$this->roleDto = $roleDto;
	}
}