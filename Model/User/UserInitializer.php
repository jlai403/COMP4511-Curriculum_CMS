<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/User.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Role/RoleInitializer.php');

class UserInitializer {
	
	private $userDto;
	
	public function __construct(UserDto $userDto) {
		$this->userDto = $userDto;
	}
	
	public function initialize() {
		$user = new User();
		$user->setFirstName($this->userDto->getFirstName());
		$user->setLastName($this->userDto->getLastName());
		$user->setEmail($this->userDto->getEmail());
		$user->assertAndEncrpytPassword($this->userDto->getPassword());
		$roles = $this->initializeRoles($this->userDto->getRoleDtos());
		$user->setRoles($roles);
		
		return $user;
	}
	
	private function initializeRoles($roleDtos){
		$roles = array();
		foreach($roleDtos as $roleDto) {
			array_push($roles, (new RoleInitializer($roleDto))->initialize());
		}
		return $roles;
	}
}