<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
$currentUser = SessionManager::authorize();

$requestedProgramDtos = FacadeFactory::getDomainFacade()->findProgramsByRequester($currentUser->getEmail());
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Dashboard</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap.min.css" />
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
										<div class="col-xs-3"> Program Name: </div>
										<div class="col-xs-9"> <?= $requestedProgramDto->getProgramName() ?>  </div>
									</div>
									<div class="row">
										<div class="col-xs-3"> Faculty: </div>
										<div class="col-xs-9"> <?= $requestedProgramDto->getDisciplineDto()->getFacultyDto()->getName() ?>  </div>
									</div>
									<div class="row">
										<div class="col-xs-3"> Discipline: </div>
										<div class="col-xs-9"> <?= $requestedProgramDto->getDisciplineDto()->getName() ?>  </div>
									</div>
									<div class="row">
										<div class="col-xs-3"> Reponsible Party: </div>
										<div class="col-xs-9"> <?= $requestedProgramDto->getResponsibleParty() ?>  </div>
									</div>
									<div class="row">
										<div class="col-xs-3"> Status: </div>
										<div class="col-xs-9"> <?= $requestedProgramDto->getWorkflowDataDto()->getStatus() ?>  </div>
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