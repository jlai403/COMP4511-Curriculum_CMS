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
        <script src="/Content/js/animation.js"></script>

        <script src="/Content/js/errors.js"></script>
        <link type="text/css" rel="stylesheet" href="/Content/css/module/errors.css" />
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
					
					<div class="steps hide">
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
					
					<!-- STEP ONE START -->
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
							<div class="col-md-3 required">
								Program Name
							</div>
							<div class="col-md-9">
								<input class="form-control" type="text" name="name" placeholder="Program Name" tabindex="1"/>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3 required">
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
							<div class="col-md-3 required">
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
							<div class="col-md-3 required">
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
							<input class="form-control button blue hide" type="button" value="Next"/>
						</div>
					</div>
					<!-- STEP ONE END -->

                    <!-- CONTEXT FOR STEP TWO AND THREE -->
                    <div class="context hide small-text" style="padding: 10px 0; margin: -15px 0 15px; background-color:#FAFAFA;">
                        <div class="row" >
                            <div class="col-md-5 right-align">
                                Program Name:
                            </div>
                            <div class="col-md-5">
                                <span class="programName left-align"/></span>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-5 right-align">
                                Effective Term:
                            </div>
                            <div class="col-md-5">
                                <span class="effectiveTerm left-align"/></span>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-5 right-align">
                                Faculty:
                            </div>
                            <div class="col-md-5">
                                <span class="faculty left-align"/></span>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-5 right-align">
                                Discipline:
                            </div>
                            <div class="col-md-5">
                                <span class="discipline left-align"/></span>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTEXT FOR STEP TWO AND THREE -->

					<!-- STEP TWO START -->
					<div class="step-two">
						<div class="row">
							<div class="col-md-3 required">
								Cross Impact
							</div>
							<div class="col-md-9">
								<textarea name="crossImpact" class="form-control expandOnFocus"  rows="2" tabindex="6"
									placeholder="Please identify how impact to other departments has been addressed, including General Education as appropriate"></textarea>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3 required">
								Student Impact
							</div>
							<div class="col-md-9">
								<textarea name="studentImpact" class="form-control expandOnFocus"  rows="2" tabindex="7"
									placeholder="Please identify how student input or impact has been assessed"></textarea>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3 required">
								Library Impact
							</div>
							<div class="col-md-9">
								<textarea name="libraryImpact" class="form-control expandOnFocus"  rows="2" tabindex="8"
									placeholder="Please identify how impact to the Library has been addressed"></textarea>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3 required">
								ITS Impact
							</div>
							<div class="col-md-9">
								<textarea name="itsImpact" class="form-control expandOnFocus"  rows="2" tabindex="9"
									placeholder="Please identify how impact to ITS has been addressed"></textarea>
							</div>
						</div>
						
						<div class="row center-text" style="padding: 0 100px; margin: 15px 0;">
							<input class="form-control button blue hide" type="button" value="Next" tabindex="10"/>
						</div>
					</div>
					<!-- STEP TWO END -->
					
					<!-- STEP THREE START -->
					<div class="step-three">
						<div class="row">
							<div class="col-md-3">
								Comments
							</div>
							<div class="col-md-9">
								<textarea name="comments" class="form-control expandOnFocus" placeholder="Comments..." rows="2" tabindex="11"></textarea>
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
							<input class="form-control button blue" type="submit" value="Request" tabindex="13"/>
						</div>
					</div>
					<!-- STEP END START -->
					
				</form>			
			</div>
		</div>
	</body>
</html> 

<script>

	$(document).ready(function() {
		clearHighlightsOnFocus();

		// enable javascript features
		$(".steps").removeClass("hide"); //workaround for !important attribute from bootstrap
		$(".step-one .button").removeClass("hide"); //workaround for !important attribute from bootstrap
		$(".step-two .button").removeClass("hide"); //workaround for !important attribute from bootstrap

		$(".step-two").hide();
		$(".step-three").hide();

        $(".step-one input, .step-one textarea").keydown(function(){
            // enter key
            if (event.keyCode == 13) {
                $(".step-one .button").click();
                return false;
            }
        });

        $(".step-two input, .step-two textarea").keydown(function(){
            // enter key
            if (event.keyCode == 13) {
                $(".step-two .button").click();
                return false;
            }
        });
	});

	// change to step one on checkmark click
	$(".steps").on("click", ".step-one-check .glyphicon-check", function() {
		$(".step-one").show();
		$(".step-one .button").show();
		
		$(".step-two").hide();
		$(".step-two .button").hide();
		
		$(".step-three").hide()

        hideContext();
	});

	// change to step two on checkmark click
	$(".steps").on("click", ".step-two-check .glyphicon-check", function() {
		$(".step-two").show()
		$(".step-two .button").show();
		
		$(".step-one").hide()
		$(".step-one .button").hide();
		
		$(".step-three").hide()

        showContext();
	});

	// change to step three on checkmark click
	$(".steps").on("click", ".step-three-check .glyphicon-check", function() {
		$(".step-three").show()
		
		$(".step-two").hide()
		$(".step-two .button").hide();
		
		$(".step-one").hide()
		$(".step-one .button").hide();

        showContext();
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

		$(".step-one").hide();
		$(".step-one .button").hide();

		$(".step-two").show();
		$(".step-two .button").removeClass("hide"); 
		$(".step-two .button").show();

        showContext();
	});

    function showContext(){
        $(".context").removeClass("hide"); //workaround for !important attribute from bootstrap
        $(".context .programName").text($("input[name='name']").val());
        $(".context .effectiveTerm").text($("select[name='effectiveTerm'] option:selected").text());
        $(".context .faculty").text($("select[name='faculty'] option:selected").text());
        $(".context  .discipline").text($("select[name='discipline'] option:selected").text());
    }

    function hideContext(){
        $(".context").addClass("hide");
    }

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

		$(".step-two").hide();
		$(".step-two .button").hide()
		
		$(".step-three").show();

        showContext();
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