<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
$currentUser = SessionManager::authorize();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Dashboard</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap.min.css" />
	</head>
	
	<body>
		<div class="navigation" style="float: right;">
			Hello <?php echo $currentUser->getEmail() ?>
			<a href="/Controller/UserController.php?action=logout">Logout</a>
		</div>

		<a href="/View/Program/Create.php">Create Program</a>	
	</body>
</html> 