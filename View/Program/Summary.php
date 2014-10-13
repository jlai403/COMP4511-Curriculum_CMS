<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/View/Workflow/WorkflowViewHelper.php');
$currentUser = SessionManager::authorize();

$programDto = FacadeFactory::getDomainFacade()->findProgramById($_GET["id"]);
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Program Request</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/layout.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/program-summary.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/module/colors.css" />
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="/Content/css/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
		<script src="/Content/js/errors.js"></script>
		
		<link type="text/css" rel="stylesheet" href="/Content/css/module/collapse-text.css" />
		<script src="/Content/js/collapse-text.js"></script>
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
	
		<div class="container program-summary center">
			<div class="col-xs-12">
				<div class="row center-text">
					<h3 style="margin: 20px;">Program Request</h3>
				</div>
				
				<div class="row">
					<div class="col-xs-6 summary-details">
						<div class="row center-text">
							<h5>Summary</h5>
						</div>
						
						<div class="details small-text">
							<div class="row">
								<div class="col-xs-6 bold-text right-align"> Requested On: </div>
								<div class="col-xs-6 "> <?= $programDto->getRequestedDate()?> </div>
							</div>
							
							<div class="row">
								<div class="col-xs-6 bold-text right-align"> Requested By: </div>
								<div class="col-xs-6 "> <?= $programDto->getRequesterName()?> </div>
							</div>
							
							<div class="row">
								<div class="col-xs-6 bold-text right-align"> Name: </div>
								<div class="col-xs-6 "> <?= $programDto->getProgramName()?> </div>
							</div>
							
							<div class="row">
								<div class="col-xs-6 bold-text right-align"> Faculty: </div>
								<div class="col-xs-6 "> <?= $programDto->getDisciplineDto()->getFacultyDto()->getName()?> </div>
							</div>
							
							<div class="row">
								<div class="col-xs-6 bold-text right-align"> Discipline: </div>
								<div class="col-xs-6 "> <?= $programDto->getDisciplineDto()->getName()?> </div>
							</div>
							
							<div class="row">
								<div class="col-xs-6 bold-text right-align"> Cross Impact: </div>
								<div class="col-xs-6 "> 
									<p class=cross-impact> <?= $programDto->getCrossImpact()?> </p> 
								</div>
							</div>

							<div class="row">
								<div class="col-xs-6 bold-text right-align"> Student Impact: </div>
								<div class="col-xs-6">
									<p class="student-impact"> <?= $programDto->getStudentImpact()?> </p>
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-6 bold-text right-align"> Library Impact: </div>
								<div class="col-xs-6">
									<p class="library-impact"> <?= $programDto->getLibraryImpact()?> </p> 
								</div>
							</div>
							
							<div class="row">
								<div class="col-xs-6 bold-text right-align"> ITS Impact: </div>
								<div class="col-xs-6"> 
									<p class="its-impact"> <?= $programDto->getItsImpact()?> </p> 
								</div>
							</div>
							
							<?php if (!empty($programDto->getFileDtos())) { ?>
							<div class="row">
								<div class="col-xs-6 bold-text right-align"> Attachments: </div>
								<div class="col-xs-6"> 
									<?php foreach($programDto->getFileDtos() as $fileDto) { ?>
										<a href="/Controller/FileController.php?action=download&id=<?= $fileDto->getId() ?>" target="_blank"><?= $fileDto->getName() ?></a> <br/>
									<?php } ?>
								</div>
							</div>
							<?php } ?>
						</div> <!-- div.details end -->
					</div> <!-- div.col-xs-6 end -->

					<div class="col-xs-6 workflow-details">
						<div class="row center-text">
							<h5>Workflow</h5>
						</div>
						
						<div class="workflow-details small-text">
							<?php foreach($programDto->getWorkflowDataDtos() as $workflowDataDto) { ?>
								<div class="row detail <?= $workflowDataDto->getStatus() ?>">
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5 right-align">
												Role: 
											</div>
											<div class="col-md-7 left-align">
												<?= $workflowDataDto->getApprovalChainStepDto()->getRoleDto()->getName()?>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-5 right-align">
												Status: 
											</div>
											<div class="col-xs-7 left-align">
												<?= $workflowDataDto->getStatus() ?>
											</div>
										</div>
										
										<?php if (!is_null($workflowDataDto->getUserDto())) { ?>
										<div class="row">
											<div class="col-xs-5 right-align">
												
												<?= $workflowDataDto->isRejected() ? "Rejected By: " : "Approved By:" ?>
											</div>
											<div class="col-xs-7 left-align">
												<?= $workflowDataDto->getUserDto()->getFullName() ?>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-12 comments">
						<div class="row center-text">
							<h5>Comments</h5>
						</div>
						<?php if (count($programDto->getCommentDtos()) == 0) { ?>
							<div class="row">
								<div class="col-xs-12">
									<p class="comment center-text small-text">
										No Comments
									</p>
								</div>
							</div>
						<?php } 
						else {
							foreach($programDto->getCommentDtos() as $commentDto) { ?>
							<div class="row">
								<div class="col-xs-12">
									<h5><?=$commentDto->getAuthorName()?></h5>
									<h6><?=$commentDto->getDateTime()?></h6>
									
									<p class="comment">
										<?=$commentDto->getComment()?>
									</p>
								</div>
							</div>
						<?php }
						} ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html> 

<script>
$(".cross-impact").addReadMore();
$(".student-impact").addReadMore();
$(".library-impact").addReadMore();
$(".its-impact").addReadMore();

$(".details").on("click", ".show-more", function() {
	$(this).expandText();
});
$(".details").on("click", ".show-less", function() {
	$(this).collapseText();
});
</script>
