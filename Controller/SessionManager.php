<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

class SessionManager {
	public static function set($key, $value){
		session_start();
		$_SESSION[$key] = serialize($value);
	}
	
	public static function get($key) {
		session_start();
		$value = isset($_SESSION[$key]) ? unserialize($_SESSION[$key]) : null;
		return $value;
	}
	
	public static function login(User $user, UserDto $userDto) {
		$success = self::authenticateLogin($user, $userDto);
		if ($success) {
			self::set("userEmail", $userDto->getEmail());
		} else {
			throw new MyException("The user name or password provided is incorrect.");
		}
	}
	
	private static function authenticateLogin(User $user, UserDto $userDto) {
		if ($user == null) return false;
	
		$encryptedPassword = SecurityManager::assertAndEncrpytPassword($userDto->getPassword());
		if ($user->getPassword() !== $encryptedPassword) return false;
	
		return true;
	}
	
	public static function logout() {
		session_start();
		session_unset();
		session_destroy();
	}
	
	public static function authorize() {
		$currentUserEmail = self::get("userEmail");
	
		if ($currentUserEmail == null) {
			header('Location: /View/Error/401.php');
			exit;
		}
	
		return FacadeFactory::getDomainFacade()->findUserByEmail($currentUserEmail);
	}
}