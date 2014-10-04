<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/BaseController.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramInputDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/FileUploadHelper.php');

class ProgramController extends BaseController {

	function request() {
		$currentUser = SessionManager::authorize();
		$programName = $_POST["name"];
		$comments = $_POST["comments"];
		$disciplineId = $_POST["discipline"];
		
		$fileInputDtos = array();
		if(isset($_FILES["attachments"])){
			$fileInputDtos = FileUploadHelper::convertToFileInputDtos($_FILES["attachments"]);
		}
		
		$programInputDto = new ProgramInputDto();
		$programInputDto->setRequesterDto($currentUser);
		$programInputDto->setComments($comments);
		$programInputDto->setProgramName($programName);
		$programInputDto->setFileInputDtos($fileInputDtos);
		$disciplineDto = FacadeFactory::getDomainFacade()->findDisiplineById($disciplineId);
		$programInputDto->setDisciplineDto($disciplineDto);
		
		FacadeFactory::getDomainFacade()->createProgramRequest($programInputDto);
		parent::redirect("Location: /View/Program/Requested.php");
	}
	
	function updateStatus(){
		$action = $_POST["submit"];
		$programId = $_POST["id"];
		$comment = $_POST["comments"];

		$this->addCommentToProgram($programId, $comment);
		
		if ($action == "approve") $this->approve($programId);
		if ($action == "reject") $this->reject($programId);
		throw new MyException("Unknown action.");
	}
	
	private function addCommentToProgram($programId, $comment) {
		if (trim($comment) == false) return;
		$currentUser = SessionManager::authorize();
		FacadeFactory::getDomainFacade()->addCommentToProgram($programId, $comment, $currentUser);
	}
	
	private function approve($programId) {
		$currentUser = SessionManager::authorize();
		FacadeFactory::getDomainFacade()->approveProgram($currentUser->getId(), $programId);
		parent::redirect("Location: /View/Program/Summary.php?id=".$programId);
	}
	
	private function reject($programId) {
		$currentUser = SessionManager::authorize();
		FacadeFactory::getDomainFacade()->rejectProgram($currentUser->getId(), $programId);
		parent::redirect("Location: /View/Program/Summary.php?id=".$programId);
	}
}

$action = $_GET['action'];
(new ProgramController())->invokeAction($action);
