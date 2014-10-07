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
	</head>
	
	<body>
		<div class="nav">
			<a class="nav-logo" href="/View">
	      		<img class="logo" src="/Content/img/Mount_Royal_University_Logo.svg.png" />
	      	</a>
			
			<ul>
				<li>
					<form action="/Controller/SearchController.php?action=query" method="post">
						<div class="form-group has-feedback">
						    <input class="form-control" type="text" name="queryString" placeholder="Search..."/>
						    <i class="glyphicon glyphicon-search form-control-feedback" style="top:0px;"></i>
						</div>
					</form>
				</li>
			
				<li>
					<a href="/View/Program/Request.php">Create Program</a>
				</li>
				<li>
					<a href="/Controller/UserController.php?action=logout">Logout</a>
				</li>
			</ul>
		</div>
		
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