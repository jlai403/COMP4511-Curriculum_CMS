<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/BaseController.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

class UserController extends BaseController {
	function signUp() {
		$firstName = $_POST["firstName"];
		$lastName = $_POST["lastName"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$selectedRoles = $_POST["roles"];
		$roleDtos = FacadeFactory::getDomainFacade()->findRolesByIds($selectedRoles);
		
		$userDto = new UserDto();
		$userDto->setFirstName($firstName);
		$userDto->setLastName($lastName);
		$userDto->setEmail($email);
		$userDto->setPassword($password);
		$userDto->setRoleDtos($roleDtos);
	
		FacadeFactory::getDomainFacade()->signUp($userDto);
		FacadeFactory::getDomainFacade()->signIn($userDto);
	
		parent::redirect("Location: /View/Dashboard");
	}
	
	function signIn() {
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		$userDto = new UserDto();
		$userDto->setEmail($email);
		$userDto->setPassword($password);
	
		FacadeFactory::getDomainFacade()->signIn($userDto);
	
		parent::redirect("Location: /View/Dashboard");
	}
	
	function logout() {
		FacadeFactory::getDomainFacade()->logout();
		parent::redirect("Location: /View");
	}
}

$action = $_GET['action'];
(new UserController())->invokeAction($action);
