<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/User.php');

class UserRepository extends Repository {
	
	public function create(User $user){
		$params = array(
			$user->getEmail(),
			$user->getPassword(),
		);
		$this->executeStoredProcedure("call createUser(?,?)", $params);
		
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
		$resultSet = $this->executeSelectStoredProcedure("call findUserByEmail(?)", $params);
		$user = $this->extractUserFromResultSet($resultSet[0]);
		return $user;
	}
	
	private function extractUserFromResultSet($record) {
		$user = new User();
		$user->setId($record["id"]);
		$user->setEmail($record["email"]);
		$user->setEncryptedPassword($record["password"]);
		return $user;
	}
}