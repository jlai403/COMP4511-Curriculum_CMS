<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Login</title>
	</head>

	<body>
		<form action="/Controller/UserController.php?action=login" method="POST">
			<input type="text" name="email" placeholder="email" />
			<input type="password" name="password" placeholder="password" />
			<input type="submit" value="Login"/>
		</form>
	</body>
</html> 