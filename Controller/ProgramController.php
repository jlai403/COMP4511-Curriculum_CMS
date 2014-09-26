<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/BaseController.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/FacadeFactory.php');

class ProgramController extends BaseController {

	function create() {
		parent::redirect("Location: /View/Program/Requested.php");
	}
}

$action = $_GET['action'];
(new ProgramController())->invokeAction($action);
