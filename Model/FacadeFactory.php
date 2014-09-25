<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserInitializer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserRepository.php');

class FacadeFactory {
	
	public static function getDomainFacade(){
		return new DomainFacade();
	}
}

class DomainFacade {
	
	public function signUp(UserDto $userDto){
		$user = (new UserInitializer($userDto))->initialize();
		$user->assertValid();
		
		$userRepository = new UserRepository();
		$userRepository->createUser($user);
	}
	
	public function login($userDto){
		
	}
}