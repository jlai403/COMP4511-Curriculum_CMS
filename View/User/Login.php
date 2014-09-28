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
	</head>
	
	<body>
		
		<div class="container">
			<form class="form center" action="/Controller/UserController.php?action=login" method="POST">
				<div class="col-md-12">
					<div class="row center-text">
						<img class="logo" src="/Content/img/Mount_Royal_University_Logo.svg.png" /> <br/>
						<h3>Please sign in</h3>
					</div>
					
					<div class="row">
						<input class="form-control" type="text" name="email" placeholder="email" />
					</div>
			
					<div class="row">
						<input class="form-control" type="password" name="password" placeholder="password" />
					</div>
			
					<div class="row center-text">
						<input class="form-control text-white blue" type="submit" value="Login"/> <br/>
						<a class="sign-up" href="/View/User/SignUp.php">Don't have an account?</a>
					</div>
				</div>
			</form>			
		</div>
	</body>
</html> 