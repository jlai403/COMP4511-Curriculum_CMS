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
		<title>Program Summary</title>
		
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
	
	
		<div class="container summary center">
			<div class="col-md-12">
				<div class="row center-text">
					<h3 style="margin: 20px;">Program Summary</h3>
				</div>
				
				<div class="row">
					<div class="col-xs-5 col-sm-3 bold-text right-align"> Name: </div>
					<div class="col-xs-7 col-sm-3"> <?= $programDto->getProgramName()?> </div>
					
					<div class="col-xs-5 col-sm-3 bold-text right-align"> Faculty: </div>
					<div class="col-xs-7 col-sm-3"> <?= $programDto->getDisciplineDto()->getFacultyDto()->getName() ?> </div>
				</div>
		
				<div class="row">
					<div class="col-xs-5 col-sm-3 bold-text right-align"> Requested By: </div>
					<div class="col-xs-7 col-sm-3"> <?= $programDto->getRequesterName() ?> </div>
					
					<div class="col-xs-5 col-sm-3 bold-text right-align"> Discipline: </div>
					<div class="col-xs-7 col-sm-3"> <?= $programDto->getDisciplineDto()->getName() ?> </div>
				</div>
				
				<hr style="margin:20px 0 0 0;"/>
				
				<div class="row">
					<div class="col-md-6 workflow">
						<div class="row center-text">
							<h5 style="margin-bottom: 25px;">Workflow</h5>
							
							<?php foreach($programDto->getWorkflowDataDtos() as $workflowDataDto) { ?>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-4 right-align">
												Role: 
											</div>
											<div class="col-md-8 left-align">
												<?= $workflowDataDto->getApprovalChainStepDto()->getRoleDto()->getName()?>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-4 right-align">
												Status: 
											</div>
											<div class="col-xs-8 left-align">
												<?= $workflowDataDto->getStatus() ?>
											</div>
										</div>
										
										<?php if (!is_null($workflowDataDto->getUserDto())) { ?>
										<div class="row">
											<div class="col-xs-4 right-align">
												
												<?= $workflowDataDto->isRejected() ? "Rejected By: " : "Approved By:" ?>
											</div>
											<div class="col-xs-8 left-align">
												<?= $workflowDataDto->getUserDto()->getFullName() ?>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
								
								<hr/>
							<?php } ?>
							
						</div>
					</div>
				
					<div class="col-md-6 comments">
						<div class="row center-text">
							<h5>Comments</h5>
						</div>
					
						<?php foreach($programDto->getCommentDtos() as $commentDto) { ?>
							<div class="row">
								<div class="col-md-12">
									<h5><?=$commentDto->getAuthorName()?></h5>
									<h6><?=$commentDto->getDateTime()?></h6>
									
									<p class="comment">
										<?=$commentDto->getComment()?>
									</p>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html> 