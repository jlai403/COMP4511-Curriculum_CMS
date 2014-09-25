<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/User.php');

class UserRepository extends Repository {
	
	public function createUser(User $user){
		$params = array(
			$user->getEmail(),
			$user->getPassword(),
		);
		$this->executeStoredProcedure("call createUser(?,?)", $params);
	}
}