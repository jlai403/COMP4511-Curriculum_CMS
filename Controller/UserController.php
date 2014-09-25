<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

$action = $_GET['action'];
$controller = new UserController();
call_user_func(array($controller, $action));

class UserController {
	function signUp() {
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		$userDto = new UserDto();
		$userDto->setEmail($email);
		$userDto->setPassword($password);
	
		FacadeFactory::getDomainFacade()->signUp($userDto);
		FacadeFactory::getDomainFacade()->login($userDto);
	
		$this->redirect("Location: /View/Dashboard");
	}
	
	function login() {
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		$userDto = new UserDto();
		$userDto->setEmail($email);
		$userDto->setPassword($password);
	
		FacadeFactory::getDomainFacade()->login($userDto);
	
		$this->redirect("Location: /View/Dashboard");
	}
	
	function redirect($location) {
		header($location);
		exit();
	}
}
?>