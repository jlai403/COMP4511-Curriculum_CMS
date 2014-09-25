<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

$action = $_GET['action'];
$action();

function signUp() {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$userDto = new UserDto();
	$userDto->setEmail($email);
	$userDto->setPassword($password);
	
	FacadeFactory::getDomainFacade()->signUp($userDto);
	FacadeFactory::getDomainFacade()->login($userDto);
	
	redirect("Location: /View/Dashboard");
}

function login() {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$userDto = new UserDto();
	$userDto->setEmail($email);
	$userDto->setPassword($password);
	
	FacadeFactory::getDomainFacade()->login($userDto);
	
	redirect("Location: /View/Dashboard");
}

function redirect($location) {
	header($location);
	exit();
}
?>