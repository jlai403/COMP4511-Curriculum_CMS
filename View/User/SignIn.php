<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
$errorMessage = SessionManager::getError();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Login</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/signin.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/layout.css" />

		<link type="text/css" rel="stylesheet" href="/Content/css/module/colors.css" />
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="/Content/js/errors.js"></script>
	</head>
	
	<body>
		
		<div class="container">
			<div class="col-md-12">
				<form class="form center" action="/Controller/UserController.php?action=signIn" method="POST">
					<div class="row center-text">
						<img class="logo" src="/Content/img/Mount_Royal_University_Logo.svg.png" /> <br/>
						<h3>Please sign in</h3>
					</div>
					
					<div class="row">
						<ul class="errors center-text">
							<?php if (!is_null($errorMessage)) { ?>
								<li><?= $errorMessage ?></li>
							<?php }?>
						</ul>
					</div>
					
					<div class="row">
						<input class="form-control" type="email" name="email" placeholder="email" tabindex="1"/>
					</div>
			
					<div class="row">
						<input class="form-control" type="password" name="password" placeholder="password" tabindex="2"/>
					</div>
			
					<div class="row center-text">
						<input class="form-control button blue" type="submit" value="Login" tabindex="3"/>
						<a class="link" href="/View/User/SignUp.php" tabindex="4">Don't have an account?</a>
					</div>
				</form>			
			</div>
		</div>
	</body>
</html>

<script>
    $(document).ready(function(){
        clearHighlightsOnFocus();
    });

	$('.form').submit(function(e) {
		clearErrors();

		validateEmail();
		validatePassword();

		if (hasErrors()) {
			e.preventDefault();
			printErrors();
			return false;
		};
		return true;
	});

	function validateEmail() {
		var email = $("input[name='email']").val().trim();
		if (email === '') addError("You must enter an email.","email");
	}

	function validatePassword() {
		var password = $("input[name='password']").val().trim();
		if (password === '') addError("You must enter a password.","password");
	}
</script>