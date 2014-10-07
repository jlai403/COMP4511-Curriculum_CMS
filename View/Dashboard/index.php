<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
$currentUser = SessionManager::authorize();

$requestedProgramDtos = FacadeFactory::getDomainFacade()->findProgramsByRequester($currentUser->getEmail());
$actionableProgramDtos = FacadeFactory::getDomainFacade()->findProgramsForApproval($currentUser->getEmail());
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

		<link type="text/css" rel="stylesheet" href="/Content/css/theme/dashboard.css" />
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
		
		
		<div class="container">
			<div class="row">
				<!-- ACTIONABLE ITEMS START -->
				<div class="col-md-6">
					<div class="actionable-items">
						<h6>Actionable Items</h6>
						
						<?php foreach($actionableProgramDtos as $actionableProgramDto) { 
						?>
							<a href="/View/Program/UpdateStatus.php?id=<?=$actionableProgramDto->getId()?>">
								<div class="container item">
									<div class="row">
										<div class="col-md-4 col-xs-6"> Request Date: </div>
										<div class="col-md-8 col-xs-6"> <?= $actionableProgramDto->getRequestedDate() ?>  </div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-6"> Requested By: </div>
										<div class="col-md-8 col-xs-6"> <?= $actionableProgramDto->getRequesterName() ?>  </div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-6"> Program Name: </div>
										<div class="col-md-8 col-xs-6"> <?= $actionableProgramDto->getProgramName() ?>  </div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-6"> Status: </div>
										<div class="col-md-8 col-xs-6"> <?= $actionableProgramDto->getCurrentWorkflowDataDto()->getStatus() ?>  </div>
									</div>
								</div>
							</a>
						<?php }?>
						
					</div>
				</div>
				<!-- ACTIONABLE ITEMS END -->
				
				<!-- REQUESTS START -->
				<div class="col-md-6">
					<div class="request-items">
						<h6>Your Requested Items</h6>
						
						<?php foreach($requestedProgramDtos as $requestedProgramDto) { 
						?>
							<a href="/View/Program/Summary.php?id=<?=$requestedProgramDto->getId()?>">
								<div class="container item">
									<div class="row">
										<div class="col-md-4 col-xs-6"> Request Date: </div>
										<div class="col-md-8 col-xs-6"> <?= $requestedProgramDto->getRequestedDate() ?>  </div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-6"> Program Name: </div>
										<div class="col-md-8 col-xs-6"> <?= $requestedProgramDto->getProgramName() ?>  </div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-6"> Reponsible Party: </div>
										<div class="col-md-8 col-xs-6"> <?= $requestedProgramDto->getResponsibleParty() ?>  </div>
									</div>
									<div class="row">
										<div class="col-md-4 col-xs-6"> Status: </div>
										<div class="col-md-8 col-xs-6"> <?= $requestedProgramDto->getCurrentWorkflowDataDto()->getStatus() ?>  </div>
									</div>
								</div>
							</a>
						<?php }?>
						
					</div>
				</div>
				<!-- REQUESTS END -->
			</div>
		</div>
	</body>
</html> 