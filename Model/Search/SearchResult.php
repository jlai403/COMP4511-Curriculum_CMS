<?php

class SearchResult {
	private $type;
	private $id;
	private $name;
	private $requesterFirstName;
	private $requesterLastName;
	
	public function getType() {
		return $this->type;
	}
	
	public function setType($type) {
		$this->type = $type;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getRequesterFirstName() {
		return $this->requesterFirstName;
	}
	
	public function setRequesterFirstName($firstName) {
		$this->requesterFirstName = $firstName;
	}
	
	public function getRequesterLastName() {
		return $this->requesterLastName;
	}
	
	public function setRequesterLastName($lastName) {
		$this->requesterLastName = $lastName;
	}
}