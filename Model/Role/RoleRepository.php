<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Role/Role.php');

class RoleRepository extends Repository {
	
	public function findAll() {
		$resultSet = parent::executeStoredProcedureWithResultSet("call findAllRoles()");
		$roles = $this->extractRolesFromResultSet($resultSet);
		return $roles;
	}
	
	public function findRolesByIds($roleIds) {
		$roles = array();
		foreach($roleIds as $id) {
			$params = array($id);
			$resultSet = parent::executeStoredProcedureWithResultSet("call findRoleById(?)", $params);
			array_push($roles, $this->extractRoleFromRecord($resultSet[0]));
		}
		return $roles;
	}
	
	private function extractRolesFromResultSet($resultSet) {
		$roles = array();
		foreach($resultSet as $record) {
			array_push($roles, $this->extractRoleFromRecord($record));
		}
		return $roles;
	}
	
	private function extractRoleFromRecord($record) {
		$role = new Role();
		$role->setId($record['id']);
		$role->setName($record['name']);
		return $role;
	}
}