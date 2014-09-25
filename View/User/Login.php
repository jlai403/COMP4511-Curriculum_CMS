<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Login</title>
	</head>

	<body>
		<form action="/Controller/UserController.php?action=login" method="POST">
			<input type="text" name="email" />
			<input type="password" name="password" />
			<input type="submit" />
		</form>
	</body>
</html> 