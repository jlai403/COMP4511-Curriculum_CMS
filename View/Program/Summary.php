<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
$currentUser = SessionManager::authorize();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Program Summary</title>
		
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
				<div class="row center-text">
					<h3 style="margin: 20px;">Program Summary</h3>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						Requester
					</div>
					<div class="col-md-9">
					</div>
				</div>
		
				<div class="row">
					<div class="col-md-3">
						Program Name
					</div>
					<div class="col-md-9">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						Faculty
					</div>
					<div class="col-md-9">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						Discipline
					</div>
					<div class="col-md-9">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						Comments
					</div>
					<div class="col-md-9">
					</div>
				</div>
			</div>
		</div>
	</body>
</html> 