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
						<li class="active"> <a href="/View/Program/Request.php">Create Program</a> </li>
						<li> <a href="/Controller/UserController.php?action=logout">Logout</a> </li>
						<!-- NAV LINKS END -->
					</ul>
				</div> <!-- /.navbar-collapse -->
			</div> <!-- /.container-fluid -->
		</nav>
	
		<div class="container form center">
			<div class="col-md-12">
				<form action="/Controller/ProgramController.php?action=request" method="POST" enctype="multipart/form-data">
					<div class="row center-text">
						<h3 style="margin: 20px;">Create Program</h3>
					</div>
					
					<div class="steps">
						<div class="row">
							<div class="col-xs-4 center-text step-one-check">
								Step One </br>
								<i class="glyphicon glyphicon-unchecked cursor"></i> 
							</div>
							<div class="col-xs-4 center-text step-two-check">
								Step Two </br>
								<i class="glyphicon glyphicon-unchecked cursor"></i> 
							</div>
							<div class="col-xs-4 center-text step-three-check">
								Step Three </br>
								<i class="glyphicon glyphicon-unchecked cursor"></i> 
							</div>
						</div>
					</div>
					
					<div class="row">
						<ul class="errors center-text">
							<?php if (!is_null($errorMessage)) { ?>
								<li><?= $errorMessage ?></li>
							<?php }?>
						</ul>
					</div>
					
					<div class="step-one">
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
								<input class="form-control" type="text" name="name" placeholder="Program Name" tabindex="1"/>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								Effective Term
							</div>
							<div class="col-md-9">
								<select class="form-control" name="effectiveTerm" tabindex="2">
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
								<select class="form-control" name="faculty" tabindex="3">
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
								<select class="form-control" name="discipline" tabindex="4">
									<?php foreach($disciplines as $discipline) { ?>
										<option value="<?=$discipline->getId()?>"> <?=$discipline->getDisplayName()?> </option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="row center-text" style="padding: 0 100px; margin: 15px 0;" tabindex="5">
							<input class="form-control button blue" type="button" value="Next"/>
						</div>
					</div>
					
					<div class="step-two hide">
						<div class="row">
							<div class="col-md-3">
								Cross Impact
							</div>
							<div class="col-md-9">
								<textarea name="crossImpact" class="form-control"  rows="5" tabindex="6"
									placeholder="Please identify how impact to other departments has been addressed, including General Education as appropriate"></textarea>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								Student Impact
							</div>
							<div class="col-md-9">
								<textarea name="studentImpact" class="form-control"  rows="5" tabindex="7"
									placeholder="Please identify how student input or impact has been assessed"></textarea>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								Library Impact
							</div>
							<div class="col-md-9">
								<textarea name="libraryImpact" class="form-control"  rows="5" tabindex="8"
									placeholder="Please identify how impact to the Library has been addressed"></textarea>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								ITS Impact
							</div>
							<div class="col-md-9">
								<textarea name="itsImpact" class="form-control"  rows="5" tabindex="9"
									placeholder="Please identify how impact to ITS has been addressed"></textarea>
							</div>
						</div>
						
						<div class="row center-text" style="padding: 0 100px; margin: 15px 0;">
							<input class="form-control button blue" type="button" value="Next" tabindex="10"/>
						</div>
					</div>
					
					<div class="step-three hide">
						<div class="row">
							<div class="col-md-3">
								Comments
							</div>
							<div class="col-md-9">
								<textarea name="comments" class="form-control" placeholder="Comments..." rows="5" tabindex="11"></textarea>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								Attachments
							</div>
							<div class="col-md-9">
								<input name="attachments[]" type="file" multiple style="font-size:12px;" tabindex="12"/>
							</div>
						</div>
						
						<div class="row center-text" style="padding: 0 100px; margin: 15px 0;">
							<input class="form-control button blue" type="button" value="Request" tabindex="13"/>
						</div>
					</div>
					
				</form>			
			</div>
		</div>
	</body>
</html> 

<script>
	clearHighlightsOnFocus();

	$(".steps").on("click", ".step-one-check .glyphicon", function() {
		$(".step-one").removeClass("hide");
		$(".step-two").addClass("hide");
		$(".step-three").addClass("hide");
	});

	$(".steps").on("click", ".step-two-check .glyphicon", function() {
		$(".step-two").removeClass("hide");
		$(".step-one").addClass("hide");
		$(".step-three").addClass("hide");
	});

	$(".steps").on("click", ".step-three-check .glyphicon", function() {
		$(".step-three").removeClass("hide");
		$(".step-two").addClass("hide");
		$(".step-one").addClass("hide");
	});

	
	$(".step-one .button").click(function() {
		clearErrors();

		validateProgramName();

		if (hasErrors()) {
			printErrors();
			return false;
		}
		
		$(".step-one-check .glyphicon").removeClass("glyphicon-unchecked");
		$(".step-one-check .glyphicon").addClass("glyphicon-check");
		$(".step-one").toggleClass("hide");
		$(".step-two").toggleClass("hide");
	});

	function validateProgramName() {
		var programName = $("input[name='name']").val().trim();
		if (programName === '') addError("Program name is required.", "name");
	}

	$(".step-two .button").click(function() {
		clearErrors();

		validateCrossImpact();
		validateStudentImpact();
		validateLibraryImpact();
		validateItsImpact();

		if (hasErrors()) {
			printErrors();
			return false;
		}
		
		$(".step-two-check .glyphicon").removeClass("glyphicon-unchecked");
		$(".step-two-check .glyphicon").addClass("glyphicon-check");
		$(".step-two").toggleClass("hide");
		$(".step-three").toggleClass("hide");
	});

	function validateCrossImpact() {
		var crossImpact = $("textarea[name='crossImpact']").val().trim();
		if (crossImpact === '') addError("Cross impact is required.", "crossImpact");
	}

	function validateStudentImpact() {
		var studentImpact = $("textarea[name='studentImpact']").val().trim();
		if (studentImpact === '') addError("Student impact is required.", "studentImpact");
	}

	function validateLibraryImpact() {
		var libraryImpact = $("textarea[name='libraryImpact']").val().trim();
		if (libraryImpact === '') addError("Library impact is required.", "libraryImpact");
	}

	function validateItsImpact() {
		var itsImpact = $("textarea[name='itsImpact']").val().trim();
		if (itsImpact === '') addError("ITS impact is required.", "itsImpact");
	}
	
	
	$(".step-three .button").click(function() {
		$(".step-three-check .glyphicon").removeClass("glyphicon-unchecked");
		$(".step-three-check .glyphicon").addClass("glyphicon-check");

		$("form").submit();
	});

</script>