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
	$password->setPassword($passwordl);
	FacadeFactory::getDomainFacade()->signUp($userDto);
	FacadeFactory::getDomainFacade()->login($userDto);
	
	header("Location: /View/Dashboard");
	exit();
}

function login() {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$userDto = new UserDto($email, $password);
	FacadeFactory::getDomainFacade()->login($userDto);
	
	header("Location: /View/Dashboard");
	exit();
}
?>