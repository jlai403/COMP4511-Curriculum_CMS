<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Role/Role.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Role/RoleDto.php');

class RoleAssembler {
	
	public function assembleAll($roles) {
		$roleDtos = array();
		foreach($roles as $role){
			$roleDto = new RoleDto();
			$roleDto->setId($role->getId());
			$roleDto->setName($role->getName());
			
			array_push($roleDtos, $roleDto);
		}
		return $roleDtos;
	}
}