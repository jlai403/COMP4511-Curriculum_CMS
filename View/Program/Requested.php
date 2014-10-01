<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
$currentUser = SessionManager::authorize();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>New Program Requested</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/layout.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/create-program.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/module/colors.css" />
	</head>

	<body>
		<div class="nav">
			<a class="nav-logo" href="/View">
	      		<img src="/Content/img/Mount_Royal_University_Logo.svg.png" />
	      	</a>
			
			<ul>
				<li class="active">
					<a href="/View/Program/Request.php">Create Program</a>
				</li>
				<li>
					<a href="/Controller/UserController.php?action=logout">Logout</a>
				</li>
			</ul>
		</div>
	
	
		<div class="container form center">
			<div class="col-md-12">
				<h3>Program has been requested and is now in the approval process.</h3>
				<h5>You can check the status of your request on the <a href="/View/Dashboard">Homepage</a>.</h5>		
			</div>
		</div>
	</body>
</html> 