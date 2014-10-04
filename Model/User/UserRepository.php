<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/User.php');

class UserRepository extends Repository {
	
	public function create(User $user){
		$params = array(
			$user->getFirstName(),
			$user->getLastName(),
			$user->getEmail(),
			$user->getPassword(),
		);
		$this->executeStoredProcedure("call createUser(?,?,?,?)", $params);
		
		$userId = $this->findUserByEmail($user->getEmail())->getId();
		$this->addRolesToUser($userId, $user->getRoles());
	}
	
	private function addRolesToUser($userId, $roles) {
		foreach($roles as $role) {
			$params = array(
				$userId,
				$role->getId()		
			);
			$this->executeStoredProcedure("call addRoleToUser(?,?)", $params);
		}
	}
	
	public function findUserByEmail($email) {
		$params = array($email);
		$resultSet = $this->executeStoredProcedureWithResultSet("call findUserByEmail(?)", $params);
		if (empty($resultSet)) return null;
		
		$user = $this->extractUserFromRecord($resultSet[0]);
		return $user;
	}
	
	public function findById($id) {
		$params = array($id);
		$resultSet = $this->executeStoredProcedureWithResultSet("call findUserById(?)", $params);
		if (empty($resultSet)) return null;
		
		$user = $this->extractUserFromRecord($resultSet[0]);
		return $user;
	}
	
	private function extractUserFromRecord($record) {
		$user = new User();
		$user->setId($record["id"]);
		$user->setFirstName($record["firstName"]);
		$user->setLastName($record["lastName"]);
		$user->setEmail($record["email"]);
		$user->setEncryptedPassword($record["password"]);
		
		$roles = (new RoleRepository())->findRolesForUser($user->getId());
		$user->setRoles($roles);
		
		return $user;
	}
}