<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/File.php');

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
	
	public function findById($id) {
		$params = array($id);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findFileById(?)", $params);
		return $this->extractFileFromRecord($resultSet[0]);
	}
	
	public function findFilesForProgram($programId) {
		$params = array($programId);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findFilesForProgram(?)", $params);
		return $this->extractFilesFromResultSet($resultSet);
	}
	
	private function extractFilesFromResultSet($resultSet) {
		$files = array();
		foreach($resultSet as $record) {
			array_push($files, $this->extractFileFromRecord($record));
		}
		return $files;
	}
	
	private function extractFileFromRecord($record) {
		$file = new File();
		$file->setId($record["id"]);	
		$file->setName($record["name"]);	
		$file->setType($record["type"]);	
		$file->setSize($record["size"]);	
		$file->setContent($record["content"]);	
		return $file;
	}
}