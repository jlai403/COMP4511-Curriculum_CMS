<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/IEntity.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/SecurityManager.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');

class User implements IEntity {
	private $id;
	private $email;
	private $password;
	
	public function getEmail() {
		return $this->email;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function validateAndEncrpytPassword($password) {
		$hashedPassword = SecurityManager::validateAndEncrpytPassword($password);
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
	}
	
	private function assertEmailIsValid() {
		$validEmailPattern = "/[\w\d\.]+@mtroyal\.ca/";
		$matches = preg_match($validEmailPattern, $this->email);
		if ($matches === 0) {
			throw new MyException("Email is an invalid format.");
		}
	}
	
}