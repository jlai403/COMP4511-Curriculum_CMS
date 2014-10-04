<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/BaseController.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

class FileController extends BaseController {
	function download() {
		$fileId = $_GET["id"];
		
		$fileDto = FacadeFactory::getDomainFacade()->findFileById($fileId);
		
		header("Content-length:" . $fileDto->getSize());
		header("Content-type:" . $fileDto->getType());
		header("Content-Disposition: attachment; filename=" . $fileDto->getName());
		echo $fileDto->getContent();
		exit;
	
	}
}

$action = $_GET['action'];
(new FileController())->invokeAction($action);
