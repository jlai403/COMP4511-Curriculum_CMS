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
		$selectedRoles = isset($_POST["roles"]) ? $_POST["roles"] : null;
		
		$roleDtos = FacadeFactory::getDomainFacade()->findRolesByIds($selectedRoles);
		
		$userDto = new UserDto();
		$userDto->setFirstName($firstName);
		$userDto->setLastName($lastName);
		$userDto->setEmail($email);
		$userDto->setPassword($password);
		$userDto->setRoleDtos($roleDtos);
	
		try {
			FacadeFactory::getDomainFacade()->signUp($userDto);
			FacadeFactory::getDomainFacade()->signIn($userDto);
			parent::redirect("/View/Dashboard");
		} catch (Exception $e) {
			parent::addError($e->getMessage());
		}
	}
	
	function signIn() {
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		$userDto = new UserDto();
		$userDto->setEmail($email);
		$userDto->setPassword($password);
		
		try {
			FacadeFactory::getDomainFacade()->signIn($userDto);
			parent::redirect("/View/Dashboard");
		} catch (Exception $e) {
			$uri = $_SERVER['HTTP_REFERER'];
			SessionManager::addError($e->getMessage());
			parent::redirect($uri);
		}
	}
	
	function logout() {
		FacadeFactory::getDomainFacade()->logout();
		parent::redirect("/View");
	}
}

$action = $_GET['action'];
(new UserController())->invokeAction($action);
