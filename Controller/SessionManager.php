<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

class SessionManager {
	private static function startSession() {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}
	
	public static function set($key, $value){
		self::startSession();
		$_SESSION[$key] = serialize($value);
	}
	
	public static function get($key) {
		self::startSession();
		$value = isset($_SESSION[$key]) ? unserialize($_SESSION[$key]) : null;
		return $value;
	}
	
	public static function signIn(User $user, UserDto $userDto) {
		$success = self::authenticateSignIn($user, $userDto);
		if ($success) {
			self::set("userEmail", $userDto->getEmail());
		} else {
			throw new MyException("The user name or password provided is incorrect.");
		}
	}
	
	private static function authenticateSignIn(User $user, UserDto $userDto) {
		if ($user == null) return false;
	
		$encryptedPassword = SecurityManager::assertAndEncrpytPassword($userDto->getPassword());
		if ($user->getPassword() !== $encryptedPassword) return false;
	
		return true;
	}
	
	public static function logout() {
		self::startSession();
		session_unset();
		session_destroy();
	}
	
	public static function authorize() {
		if (self::userIsLoggedIn() == false) {
			header('Location: /View/Error/401.php');
			exit;
		}
		return FacadeFactory::getDomainFacade()->findUserByEmail(self::get("userEmail"));
	}
	
	public static function userIsLoggedIn() {
		$currentUserEmail = self::get("userEmail");
		if (is_null($currentUserEmail)) return false;
		return true;
	}
}