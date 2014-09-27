<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/IEntity.php');

class Role implements IEntity {
	private $id;
	private $name;
	
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
		//no asserts
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function setName($name){
		$this->name = $name;
	}
}