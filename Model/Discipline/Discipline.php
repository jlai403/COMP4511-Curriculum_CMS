<?php

class Discipline implements IEntity {
	private $id;
	private $name;
	private $code; 
	private $faculty;
	
	public function getFaculty(){
		return $this->faculty;
	}
	
	public function setFaculty($faculty){
		$this->faculty = $faculty;
	}
	
	public function getCode(){
		return $this->code;
	}
	
	public function setCode($code){
		$this->code = $code;
	}
	
	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	// Overriden: IEntity
	public function getId() {
		return $this->id;
	}

	// Overriden: IEntity
	public function setId($id) {
		$this->id = $id;
	}

	// Overriden: IEntity
	public function assertValid() {
	}
}