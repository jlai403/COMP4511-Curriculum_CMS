<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/BaseController.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramInputDto.php');

class ProgramController extends BaseController {

	function request() {
		$currentUser = SessionManager::authorize();
		$programName = $_POST["name"];
		$disciplineId = $_POST["discipline"];
		
		$programInputDto = new ProgramInputDto();
		$programInputDto->setRequesterId($currentUser->getId());
		$programInputDto->setProgramName($programName);
		$programInputDto->setDisciplineId($disciplineId);
		
		FacadeFactory::getDomainFacade()->createProgramRequest($programInputDto);
		parent::redirect("Location: /View/Program/Requested.php");
	}
}

$action = $_GET['action'];
(new ProgramController())->invokeAction($action);
