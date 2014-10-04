<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');

class StatusFactory {
	public function getStatus($status) {
		switch ($status) {
			case "PENDING_APPROVAL":
				return "Pending Approval";
				break;
			case "APPROVED":
				return "Approved";
				break;
			case "COMPLETED":
				return "Completed";
				break;
			case "REJECTED":
				return "Rejected";
				break;
			default:
				throw new MyException("Status not found");
		}
	}
}