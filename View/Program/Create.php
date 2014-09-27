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
	</head>

	<body>
		<div class="navigation" style="float: right;">
			Hello <?php echo $currentUser->getEmail() ?>
			<a href="/Controller/UserController.php?action=logout">Logout</a>
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