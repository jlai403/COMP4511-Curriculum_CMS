<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
$loggedIn = SessionManager::userIsLoggedIn();

$redirectUrl = $loggedIn ? "/View/Dashboard" : "/View/User/SignIn.php";
header("Location: ".$redirectUrl);
exit();
?>