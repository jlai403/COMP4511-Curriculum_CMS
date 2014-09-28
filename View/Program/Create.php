<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');
$currentUser = SessionManager::authorize();

$faculties = FacadeFactory::getDomainFacade()->findAllFaculties();
$disciplines = FacadeFactory::getDomainFacade()->findAllDisciplines();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Create Program</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link type="text/css" rel="stylesheet" href="/Content/css/bootstrap-3.2.0-dist/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/theme/layout.css" />
		<link type="text/css" rel="stylesheet" href="/Content/css/module/colors.css" />
	</head>

	<body>
		<div class="nav">
			<a class="nav-logo" href="/View">
	      		<img src="/Content/img/Mount_Royal_University_Logo.svg.png" />
	      	</a>
			
			<ul>
				<li class="nav-item">
					<a href="/View/Program/Create.php">Create Program</a>
				</li>
				<li class="nav-item">
					<a href="/Controller/UserController.php?action=logout">Logout</a>
				</li>
			</ul>
		</div>
	
		<form action="/Controller/ProgramController.php?action=create" method="POST">
			Requester: <input type="text" name="requester" value="<?php echo $currentUser->getFirstName()." ".$currentUser->getLastName()?>" /> <br/>
			Program name: <input type="text" name="name" placeholder="Program Name" /> <br/>
			Faculty: 
			<select name="faculty">
				<?php 
					foreach($faculties as $faculty) {
						echo "<option value='".$faculty->getId()."'>".$faculty->getName()."</option>";
					}
				?>
			</select> <br/>
			Discipline: 
			<select name="discipline">
				<?php 
					foreach($disciplines as $discipline) {
						echo "<option value='".$discipline->getId()."'>".$discipline->getDisplayName()."</option>";
					}
				?>
			</select> <br/>
			<br/><input type="submit" value="Submit Request"/>
		</form>
	</body>
</html> 