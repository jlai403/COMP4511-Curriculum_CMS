<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/User.php');

class LoginManager {
	
	public static function login(User $user, UserDto $userDto) {
		$success = self::validateLogin($user, $userDto);
		if ($success) {
			session_start();
			$_SESSION["userEmail"] = $userDto->getEmail();
		} else {
			throw new MyException("The user name or password provided is incorrect.");
		}
	}
	
	public static function validateLogin(User $user, UserDto $userDto) { 
		if ($user == null) return false;
		
		$encryptedPassword = SecurityManager::assertAndEncrpytPassword($userDto->getPassword());
		if ($user->getPassword() !== $encryptedPassword) return false;

		return true;	
	}
	
	public static function verifyAuthentication() {
		session_start();
		$currentUserEmail = isset($_SESSION["userEmail"]) ? $_SESSION["userEmail"] : null;
		
		if ($currentUserEmail == null) {
			header('Location: /View/Error/401.php');
			exit;
		}
		
		return FacadeFactory::getDomainFacade()->findUserByEmail($currentUserEmail);
	}
	
	public static function logout() {
		session_start();
		session_unset();
		session_destroy();
	}
}