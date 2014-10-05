<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/IEntity.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/SecurityManager.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');

class User implements IEntity {
	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $password;
	private $roles;
	
	public function getFirstName() {
		return $this->firstName;
	}
	
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	
	public function getLastName() {
		return $this->lastName;
	}
	
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
	
	public function getFullName() {
		return $this->getFirstName()." ".$this->getLastName();
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function getRoles() {
		return $this->roles;
	}
	
	public function setRoles($roles) {
		$this->roles = $roles;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function assertAndEncrpytPassword($password) {
		$hashedPassword = SecurityManager::assertAndEncrpytPassword($password);
		$this->password = $hashedPassword;
	}
	
	public function setEncryptedPassword($password) {
		$this->password = $password;
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
		$this->assertEmailIsValid();
		$this->assertAtLeastOneRoleIsSelected();
	}
	
	private function assertEmailIsValid() {
		$validEmailPattern = "/[\w\d\.]+@mtroyal\.ca/";
		$matches = preg_match($validEmailPattern, $this->email);
		if ($matches === 0) {
			throw new MyException("Email is an invalid format.");
		}
	}
	
	private function assertAtLeastOneRoleIsSelected() {
		if (is_null($this->getRoles()) || sizeof($this->getRoles()) == 0 ) {
			throw new MyException("At least one role must be selected");
		}
	}
}