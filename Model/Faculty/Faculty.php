<?php

class Faculty implements IEntity {
	private $id;
	private $name;

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