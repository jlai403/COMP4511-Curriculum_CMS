<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
$currentUser = SessionManager::authorize();

$programId = $_GET["id"];
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
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="/Content/css/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
		<script src="/Content/js/errors.js"></script>
	</head>

	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header" style="height: 150px;">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand nav-logo" href="/View">
						<img class="logo" src="/Content/img/Mount_Royal_University_Logo.svg.png" />
					</a>
				</div>
	
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse"
					id="bs-example-navbar-collapse-1">
					<ul class="nav nav-pills navbar-right">
						<li>
							<form action="/Controller/SearchController.php?action=query"
								method="post">
								<div class="form-group has-feedback">
									<input class="form-control" type="text" name="queryString"
										placeholder="Search..." /> <i
										class="glyphicon glyphicon-search form-control-feedback"
										style="top: 0px;"></i>
								</div>
							</form>
						</li>
						
						<!-- NAV LINKS START -->
						<li> <a href="/View/Program/Request.php">Create Program</a> </li>
						<li> <a href="/Controller/UserController.php?action=logout">Logout</a> </li>
						<!-- NAV LINKS END -->
					</ul>
				</div> <!-- /.navbar-collapse -->
			</div> <!-- /.container-fluid -->
		</nav>
	
		<div class="container form center">
			<div class="col-md-12 center-text">
				<h4>Program requested is now in the approval process.</h4>
                <h6 class="redirect-text"><a href="/View/Program/Summary.php?id=<?= $programId ?>">Click here</a> to view your request</h6>
				<h6>You can also check the status of your request on the <a href="/View/Dashboard">Homepage</a>.</h6>
			</div>
		</div>
	</body>
</html>

<script>
    var redirectSeconds = 10;
    var redirectUrl = "/View/Program/Summary.php?id=<?= $programId ?>";

    $(document).ready(function(){
        redirectToProgramSummary();
    });

    function redirectToProgramSummary() {
        $(".redirect-text").html("Redirecting to <a href='" + redirectUrl + "'>Program Summary</a> in <span id='seconds'></span> seconds...");
        $("#seconds").text(redirectSeconds--);
        setInterval(function(){redirectCountDown()}, 1000);
    }

    function redirectCountDown(){
        $("#seconds").text(redirectSeconds--);
        if (redirectSeconds === 0) {
            window.location.replace(redirectUrl);
        }
    }

</script>