<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

$errorMessage = SessionManager::getError();
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
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="/Content/js/errors.js"></script>
	</head>

	<body>
		<div class="container">
			<div class="col-md-12">
				<form class="form center" action="/Controller/UserController.php?action=signUp" method="POST">
					<div class="row center-text">
						<img class="logo" src="/Content/img/Mount_Royal_University_Logo.svg.png" /> <br/>
					</div>
					
					<div class="row">
						<ul class="errors center-text">
							<?php if (!is_null($errorMessage)) { ?>
								<li><?= $errorMessage ?></li>
							<?php }?>
						</ul>
					</div>
					
					<div class="row">
						<h6>* All fields required.</h6>
					</div>
					
					<div class="row">
						<div class="col-md-6 split-left">
							<input class="form-control" type="text" name="firstName" placeholder="First name" tabindex="1"/>
						</div>
						<div class="col-md-6 split-right">
							<input class="form-control" type="text" name="lastName" placeholder="Last name" tabindex="2"/>
						</div>
					</div>
			
					<div class="row">
						<input class="form-control" type="email" name="email" placeholder="Email" tabindex="3"/>
						<abbr class="info-mark" tooltip="Must be a valid @mtroyal.ca email."> i </abbr>
					</div>
					
					<div class="row">
						<input class="form-control" type="password" name="password" placeholder="Password" tabindex="4"/>
						<abbr class="info-mark" tooltip="Must be at least 6 characters."> i </abbr>
					</div>
					
					<div class="row">
						<select class="form-control" name="roles[]" multiple size="5" tabindex="5">
							<?php foreach($roles as $role) { ?>
								<option value="<?=$role->getId()?>"> <?=$role->getName()?> </option>
							<?php } ?>
						</select>
					</div>
			
					<div class="row center-text">
						<input class="form-control button blue" type="submit" value="Sign Up" tabindex="6"/>
						<a class="link" href="/View/User/SignIn.php" tabindex="7">Already have an account?</a>
					</div>
				</form>			
			</div>
		</div>
	</body>
</html> 

<script>
	clearHighlightsOnFocus();

	$(".form").submit(function(e) {
		clearErrors();

		validateFirstName();
		validateLastName();
		validateEmail();
		validatePassword();
		validateAtLeastOneRoleSelected();

		if (hasErrors()) {
			e.preventDefault();
			printErrors();
			return false;
		}
		
		return true;
	});

	function validateFirstName() {
		var firstName = $("input[name='firstName']").val().trim();
		if (firstName.trim() === '') addError("First name is required.", "firstName")
	}

	function validateLastName() {
		var lastName = $("input[name='lastName']").val().trim();
		if (lastName.trim() === '') addError("Last name is required.", "lastName")
	}

	function validateEmail() {
		var email = $("input[name='email']").val().trim();
		var validEmail = new RegExp("[\w\d\.]+@mtroyal\.ca/"); // 1 or more characters or digits, ends with @mtroyal.ca
		if (email === '' || validEmail.test(email)) addError("Email must be a valid '@mtroyal.ca' email.", "email")
	}

	function validatePassword() {
		var password = $("input[name='password']").val().trim();
		if (password === '' || password.length < 6) addError("Password must be at least 6 characters long.", "password")
	}

	function validateAtLeastOneRoleSelected() {
		var roles = $("select[name='roles[]'] option:selected");
		if (roles.length === 0) addError("At least one role must be selected.", "roles[]");
	}
</script>