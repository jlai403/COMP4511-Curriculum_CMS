<?php

class DisciplineDto {
	private $id;
	private $name;
	private $code;
	
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
