<?php 

class UserDto {
	
	private $email;
	private $password;
	private $roleDtos;

	public function getEmail(){
		return $this->email;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function setPassword($password){
		$this->password = $password;
	}
	
	public function getRoleDtos(){
		return $this->roleDtos;
	}
	
	public function setRoleDtos($roleDtos){
		$this->roleDtos = $roleDtos;
	}
}