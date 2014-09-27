<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Role/Role.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Role/RoleDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Role/RoleInitializer.php');

class RoleInitializer {
	
	private $roleDto;
	
	public function __construct(RoleDto $roleDto) {
		$this->roleDto = $roleDto;
	}
	
	public function initialize() {
		$role = new Role();
		$role->setId($this->roleDto->getId());
		$role->setName($this->roleDto->getName());
		return $role;
	}
}