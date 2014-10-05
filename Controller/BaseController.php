<?php
abstract class BaseController {
	
	public function invokeAction($action) {
		call_user_func(array($this, $action));
	}
	
	protected function redirect($location) {
		header("Location: ".$location);
		exit();
	}
	
	protected function authenticateUser() {
		return LoginManager::verifyAuthentication();
	}
	
	protected function addError($errorMessage) {
		$uri = $_SERVER['HTTP_REFERER'];
		SessionManager::addError($errorMessage);
		$this->redirect($uri);
	}
}