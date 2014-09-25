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
		Hello <?php echo $currentUser->getEmail() ?>
	</body>
</html> 