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
		$effectiveTermId = $_POST["effectiveTerm"];
		
		$fileInputDtos = FileUploadHelper::convertToFileInputDtos($_FILES["attachments"]);
		
		$programInputDto = new ProgramInputDto();
		$programInputDto->setRequesterDto($currentUser);
		$programInputDto->setComments($comments);
		$programInputDto->setProgramName($programName);
		$programInputDto->setFileInputDtos($fileInputDtos);
		
		$termDto = FacadeFactory::getDomainFacade()->findTermById($effectiveTermId);
		$programInputDto->setEffectiveTermDto($termDto);
		
		$disciplineDto = FacadeFactory::getDomainFacade()->findDisiplineById($disciplineId);
		$programInputDto->setDisciplineDto($disciplineDto);
		
		try {
			FacadeFactory::getDomainFacade()->createProgramRequest($programInputDto);
			parent::redirect("/View/Program/Requested.php");
		} catch (Exception $e) {
			parent::addError($e->getMessage());
		}
		
	}
	
	function updateStatus(){
		$action = $_POST["submit"];
		$programId = $_POST["id"];
		$comment = $_POST["comments"];
		$attachments = $_FILES["attachments"];
		
		$this->addFilesToProgram($programId, $attachments);
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

	private function addFilesToProgram($programId, $attachments) {
		$fileInputDtos = FileUploadHelper::convertToFileInputDtos($_FILES["attachments"]);
		if (empty($fileInputDtos)) return;
		
		$currentUser = SessionManager::authorize();
		FacadeFactory::getDomainFacade()->addFilesToProgram($programId, $fileInputDtos);
	}
	
	private function approve($programId) {
		$currentUser = SessionManager::authorize();
		FacadeFactory::getDomainFacade()->approveProgram($currentUser->getId(), $programId);
		parent::redirect("/View/Program/Summary.php?id=".$programId);
	}
	
	private function reject($programId) {
		$currentUser = SessionManager::authorize();
		FacadeFactory::getDomainFacade()->rejectProgram($currentUser->getId(), $programId);
		parent::redirect("/View/Program/Summary.php?id=".$programId);
	}
}

$action = $_GET['action'];
(new ProgramController())->invokeAction($action);
