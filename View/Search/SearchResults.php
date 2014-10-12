<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');

$searchResultsDto = SessionManager::get("searchResults");
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Dashboard</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap-theme.min.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/layout.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/module/colors.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/search-results.css" />
		
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
		
		<div class="container search-results center">
			<div class="row">
				<h1 class="center-text">Search Results For '<?= $searchResultsDto->getQueryString() ?>'</h1>		
			</div>
			
			<div class="row">
				<?php foreach($searchResultsDto->getSearchResultDtos() as $searchResultDto) {  ?>
					<a href="<?= $searchResultDto->getUri() ?>">
						<div class="container item">
							<div class="row">
								<div class="col-md-4 col-xs-6 right-align"> Type: </div>
								<div class="col-md-8 col-xs-6"> <?= $searchResultDto->getType() ?>  </div>
							</div>
							<div class="row">
								<div class="col-md-4 col-xs-6 right-align"> Name: </div>
								<div class="col-md-8 col-xs-6"> <?= $searchResultDto->getName() ?>  </div>
							</div>
							<div class="row">
								<div class="col-md-4 col-xs-6 right-align"> Requested By: </div>
								<div class="col-md-8 col-xs-6"> <?= $searchResultDto->getRequesterFullName() ?>  </div>
							</div>
						</div>
					</a>
				<?php }?>
			</div>
		</div>
	</body>
</html> 