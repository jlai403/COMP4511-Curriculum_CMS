<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
$currentUser = SessionManager::authorize();

$errorMessage = SessionManager::getError();

$effectiveTerms = FacadeFactory::getDomainFacade()->findAllTerms();
$faculties = FacadeFactory::getDomainFacade()->findAllFaculties();
$disciplines = FacadeFactory::getDomainFacade()->findAllDisciplines();

?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>New Program Request</title>
		
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
				<form action="/Controller/ProgramController.php?action=request" method="POST" enctype="multipart/form-data">
					<div class="row center-text">
						<h3 style="margin: 20px;">Create Program</h3>
					</div>
					
					<?php if (!is_null($errorMessage)) { ?>
					<div class="row">
						<p class="error center-text"><?= $errorMessage ?></p>
					</div>
					<?php } ?>
					
					<div class="row">
						<div class="col-md-3">
							Requester
						</div>
						<div class="col-md-9">
							<input class="form-control" type="text" name="requester" value="<?php echo $currentUser->getFirstName()." ".$currentUser->getLastName()?>" readonly/>
						</div>
					</div>
			
					<div class="row">
						<div class="col-md-3">
							Program Name
						</div>
						<div class="col-md-9">
							<input class="form-control" type="text" name="name" placeholder="Program Name" />
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-3">
							Effective Term
						</div>
						<div class="col-md-9">
							<select class="form-control" name="effectiveTerm">
								<?php foreach($effectiveTerms as $term) { ?>
									<option value="<?=$term->getId()?>"> <?=$term->getDisplayName()?> </option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-3">
							Faculty
						</div>
						<div class="col-md-9">
							<select class="form-control" name="faculty">
								<?php foreach($faculties as $faculty) { ?>
									<option value="<?=$faculty->getId()?>"> <?=$faculty->getName()?> </option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-3">
							Discipline
						</div>
						<div class="col-md-9">
							<select class="form-control" name="discipline">
								<?php foreach($disciplines as $discipline) { ?>
									<option value="<?=$discipline->getId()?>"> <?=$discipline->getDisplayName()?> </option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-3">
							Comments
						</div>
						<div class="col-md-9">
							<textarea name="comments" class="form-control" placeholder="Comments..."></textarea>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-3">
							Attachments
						</div>
						<div class="col-md-9">
							<input name="attachments[]" type="file" multiple style="font-size:12px;"/>
						</div>
					</div>
					
					<div class="row center-text">
						<input class="form-control button blue center" type="submit" value="Request" style="max-width: 300px;"/>
					</div>
				</form>			
			</div>
		</div>
	</body>
</html> 