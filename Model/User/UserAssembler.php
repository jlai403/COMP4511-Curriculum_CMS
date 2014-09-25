<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/User.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserDto.php');

class UserAssembler {
	
	private $user;
	
	public function __construct(User $user) {
		$this->user = $user;
	}
	
	public function assemble() {
		$userDto = new UserDto();
		$userDto->setEmail($this->user->getEmail());
		$userDto->setPassword($this->user->getPassword());
		return $userDto;
	}
}