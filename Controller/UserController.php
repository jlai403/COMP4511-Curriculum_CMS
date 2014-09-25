<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

$action = $_GET['action'];
$action();

function signUp(){
	(string)$email = $_POST['email'];
	(string)$password = $_POST['password'];
	
	$userDto = new UserDto($email, $password);
	FacadeFactory::getDomainFacade()->signUp($userDto);
}

