<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/LoginManager.php');
$currentUser = LoginManager::verifyAuthentication();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Dashboard</title>
	</head>
	
	<body>
		<div class="navigation" style="float: right;">
			Hello <?php echo $currentUser->getEmail() ?>
			<a href="/Controller/UserController.php?action=logout">Logout</a>
		</div>

		<a href="/View/Program/Create.php">Create Program</a>	
	</body>
</html> 