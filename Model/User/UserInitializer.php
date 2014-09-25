<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/User.php');

class UserInitializer {
	
	private $userDto;
	
	public function __construct(UserDto $userDto) {
		$this->userDto = $userDto;
	}
	
	public function initialize() {
		$user = new User();
		$user->setEmail($this->userDto->getEmail());
		$user->setPassword($this->userDto->getPassword());
		return $user;
	}
}