<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
$currentUser = SessionManager::authorize();

$programDto = FacadeFactory::getDomainFacade()->findProgramById($_GET["id"]);
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Update Program Status</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/layout.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/program-summary.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/module/colors.css" />
	</head>

	<body>
		<div class="nav">
			<a class="nav-logo" href="/View">
	      		<img src="/Content/img/Mount_Royal_University_Logo.svg.png" />
	      	</a>
			
			<ul>
				<li>
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
					<h3 style="margin: 20px;">Update Program Status</h3>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						Requester
					</div>
					<div class="col-md-9">
						<input class="form-control" type="text" value="<?=$programDto->getRequesterName()?>" readonly/>
					</div>
				</div>
		
				<div class="row">
					<div class="col-md-3">
						Program Name
					</div>
					<div class="col-md-9">
						<input class="form-control" type="text" value="<?=$programDto->getProgramName()?>" readonly/>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						Faculty
					</div>
					<div class="col-md-9">
						<input class="form-control" type="text" value="<?=$programDto->getDisciplineDto()->getFacultyDto()->getName()?>" readonly/>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						Discipline
					</div>
					<div class="col-md-9">
						<input class="form-control" type="text" value="<?=$programDto->getDisciplineDto()->getName()?>" readonly/>
					</div>
				</div>
				
				<hr/>
				
				<div class="row center-text">
					<h3 style="margin: 20px;">Comments</h3>
				</div>
				
				<?php foreach($programDto->getCommentDtos() as $commentDto) { ?>
					<div class="row">
						<div class="col-md-12">
							<h5><?=$commentDto->getAuthorName()?></h5>
							<h6><?=$commentDto->getDateTime()?></h6>
							
							<div class="comment">
								<?=$commentDto->getComment()?>
							</div>
						</div>
					</div>
				<?php } ?>
				
			</div>
		</div>
	</body>
</html> 