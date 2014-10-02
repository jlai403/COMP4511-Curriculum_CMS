<?php

class DisciplineDto {
	private $id;
	private $name;
	private $code;
	private $facultyDto;
	
	public function getCode(){
		return $this->code;
	}
	
	public function setCode($code){
		$this->code = $code;
	}
	
	public function getFacultyDto(){
		return $this->facultyDto;
	}
	
	public function setFacultyDto($facultyDto){
		$this->facultyDto = $facultyDto;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function setName($name){
		$this->name = $name;
	}
	
	public function getDisplayName(){
		return $this->getCode()." - ".$this->getName();
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
