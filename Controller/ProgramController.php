<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/BaseController.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramInputDto.php');

class ProgramController extends BaseController {

	function request() {
		$currentUser = SessionManager::authorize();
		$programName = $_POST["name"];
		$comments = $_POST["comments"];
		$disciplineId = $_POST["discipline"];
		
		$programInputDto = new ProgramInputDto();
		$programInputDto->setRequesterDto($currentUser);
		$programInputDto->setComments($comments);
		$programInputDto->setProgramName($programName);
		
		$disciplineDto = FacadeFactory::getDomainFacade()->findDisiplineById($disciplineId);
		$programInputDto->setDisciplineDto($disciplineDto);
		
		FacadeFactory::getDomainFacade()->createProgramRequest($programInputDto);
		parent::redirect("Location: /View/Program/Requested.php");
	}
}

$action = $_GET['action'];
(new ProgramController())->invokeAction($action);
