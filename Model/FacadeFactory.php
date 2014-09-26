<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserInitializer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserAssembler.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/LoginManager.php');

class FacadeFactory {
	
	public static function getDomainFacade(){
		return new DomainFacade();
	}
}

class DomainFacade {
	
	public function signUp(UserDto $userDto){
		$user = (new UserInitializer($userDto))->initialize();
		$user->assertValid();
		
		(new UserRepository())->create($user);
	}
	
	public function login($userDto){
		$user = (new UserRepository())->findUserByEmail($userDto->getEmail());
		LoginManager::login($user, $userDto);
	}
	
	public function logout(){
		LoginManager::logout();
	}
	
	public function findUserByEmail($email) {
		$user = (new UserRepository())->findUserByEmail($email);
		return (new UserAssembler($user))->assemble();
	}
}