<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/BaseController.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramInputDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');

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
	
	function updateStatus(){
		$action = $_POST["submit"];
		$programId = $_POST["id"];
		
		if ($action == "approve") $this->approve($programId);
		if ($action == "reject") $this->reject($programId);
		throw new MyException("Unknown action.");
	}
	
	private function approve($programId) {
		FacadeFactory::getDomainFacade()->approveProgram($programId);
		parent::redirect("Location: /View/Program/Summary.php?id=".$programId);
	}
	
	private function reject($programId) {
		FacadeFactory::getDomainFacade()->rejectProgram($programId);
		parent::redirect("Location: /View/Program/Summary.php?id=".$programId);
	}
}

$action = $_GET['action'];
(new ProgramController())->invokeAction($action);
