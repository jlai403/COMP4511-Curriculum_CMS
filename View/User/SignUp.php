<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

$roles = FacadeFactory::getDomainFacade()->findAllRoles();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Sign Up</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/signup.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/layout.css" />

		<link type="text/css" rel="stylesheet" href="/Content/css/module/colors.css" />
	</head>

	<body>
		<div class="container">
			<div class="col-md-12">
				<form class="form center" action="/Controller/UserController.php?action=signUp" method="POST">
					<div class="row center-text">
						<img class="logo" src="/Content/img/Mount_Royal_University_Logo.svg.png" /> <br/>
					</div>
					
					<div class="row">
						<div class="col-md-6 split-left">
							<input class="form-control" type="text" name="firstName" placeholder="First name" />
						</div>
						<div class="col-md-6 split-right">
							<input class="form-control" type="text" name="lastName" placeholder="Last name"/>
						</div>
					</div>
			
					<div class="row">
						<input class="form-control" type="text" name="email" placeholder="Email"/>
						<abbr class="info-mark" title="Must be a valid @mtroyal.ca email."> i </abbr>
					</div>
					
					<div class="row">
						<input class="form-control" type="password" name="password" placeholder="Password"/>
					</div>
					
					<div class="row">
						<select class="form-control" name="roles[]" multiple size="5">
							<?php 
								foreach($roles as $role) {
									echo "<option value='".$role->getId()."'>".$role->getName()."</option>";
								}	
							?>
						</select>
					</div>
			
					<div class="row center-text">
						<input class="form-control button blue" type="submit" value="Sign Up"/>
						<a class="link" href="/View/User/SignIn.php">Already have an account?</a>
					</div>
				</form>			
			</div>
		</div>
	</body>
</html> 