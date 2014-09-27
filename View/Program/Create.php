<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionnManager.php');
$currentUser = SessionManager::authorize();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Create Program</title>
	</head>

	<body>
		<div class="navigation" style="float: right;">
			Hello <?php echo $currentUser->getEmail() ?>
			<a href="/Controller/UserController.php?action=logout">Logout</a>
		</div>
	
		<form action="/Controller/ProgramController.php?action=create" method="POST">
			Program name: <input type="text" name="name" placeholder="Program Name" /> <br/>
			Program type<select name="type">
			
			<input type="submit" value="Submit Request"/>
		</form>
	</body>
</html> 