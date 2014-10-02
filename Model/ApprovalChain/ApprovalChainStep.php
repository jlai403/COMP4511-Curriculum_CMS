<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/IEntity.php');

class ApprovalChainStep implements IEntity {
	private $id;
	private $sequence;
	private $role;
	
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
	
	public function getSequence(){
		return $this->sequence;
	}
	
	public function setSequence($sequence){
		$this->sequence = $sequence;
	}
	
	public function getRole(){
		return $this->role;
	}
	
	public function setRole($role){
		$this->role = $role;
	}
}