<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/User.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserDto.php');

class UserAssembler {
	
	public function assemble($user) {
		if (is_null($user)) return null;
		
		$userDto = new UserDto();
		$userDto->setId($user->getId());
		$userDto->setFirstName($user->getFirstName());
		$userDto->setLastName($user->getLastName());
		$userDto->setEmail($user->getEmail());
		$userDto->setPassword($user->getPassword());
		
		$roleDtos = (new RoleAssembler())->assembleAll($user->getRoles());
		$userDto->setRoleDtos($roleDtos);
		return $userDto;
	}
}