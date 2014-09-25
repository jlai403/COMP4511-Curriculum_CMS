<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/User.php');

class UserRepository extends Repository {
	
	public function create(IEntity $entity){
		$params = array(
			$entity->getEmail(),
			$entity->getPassword(),
		);
		$success = $this->executeStoredProcedure("call createUser(?,?)", $params);
		return $success;
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