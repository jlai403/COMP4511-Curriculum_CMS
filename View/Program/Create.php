<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/LoginManager.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramConstants.php');
$currentUser = LoginManager::verifyAuthentication();

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
				<?php 
				$validProgramTypes = unserialize(VALID_PROGRAM_TYPES);
				foreach ($validProgramTypes as $programType) {
					echo "<option value='" . $programType . "'>" . $programType . "</option>";
				}
				?>
			</select> <br/>
			
			<input type="submit" value="Submit Request"/>
		</form>
	</body>
</html> 