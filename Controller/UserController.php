<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/BaseController.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

class UserController extends BaseController {
	function signUp() {
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		$userDto = new UserDto();
		$userDto->setEmail($email);
		$userDto->setPassword($password);
	
		FacadeFactory::getDomainFacade()->signUp($userDto);
		FacadeFactory::getDomainFacade()->login($userDto);
	
		parent::redirect("Location: /View/Dashboard");
	}
	
	function login() {
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		$userDto = new UserDto();
		$userDto->setEmail($email);
		$userDto->setPassword($password);
	
		FacadeFactory::getDomainFacade()->login($userDto);
	
		parent::redirect("Location: /View/Dashboard");
	}
}

$action = $_GET['action'];
(new UserController())->invokeAction($action);
