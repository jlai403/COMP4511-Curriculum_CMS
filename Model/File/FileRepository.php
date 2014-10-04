<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');

class FileRepository extends Repository {
	
	public function create(File $file) {
		$params = array(
			$file->getName(),				
			$file->getType(),				
			$file->getSize(),				
			$file->getContent(),				
		);
		$resultSet = parent::executeStoredProcedureWithResultSet("call createFile(?,?,?,?)", $params);
		return $resultSet[0]["FileId"];
	}
}