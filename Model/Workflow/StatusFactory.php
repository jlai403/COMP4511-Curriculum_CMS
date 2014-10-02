<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');

class StatusFactory {
	public function getStatus($status) {
		if ($status === "PENDING_APPROVAL") {
			return "Pending Approval";
		}
		throw new MyException("Status not found");
	}
}