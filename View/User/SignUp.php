<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

$roles = FacadeFactory::getDomainFacade()->findAllRoles();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Sign Up</title>
	</head>

	<body>
		<form action="/Controller/UserController.php?action=signUp" method="POST">
			<input type="text" name="firstName" placeholder="First name"/> <br/>
			<input type="text" name="lastName" placeholder="Last name"/> <br/>
			<input type="text" name="email" placeholder="Email"/> <br/>
			<input type="password" name="password" placeholder="Password"/> <br/>
			<select name="roles[]" multiple size="5">
				<?php 
					foreach($roles as $role) {
						echo "<option value='".$role->getId()."'>".$role->getName()."</option>";
					}	
				?>
			</select> <br/>
			<input type="submit" />
		</form>
	</body>
</html> 