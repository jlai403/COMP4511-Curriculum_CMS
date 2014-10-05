<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/File.php');

class FileInitializer {
	
	public function initializeAll($fileInputDtos) {
		if (empty($fileInputDtos)) return;
		
		$files = array();
		foreach($fileInputDtos as $fileInputDto) {
			$file = $this->initialize($fileInputDto);
			array_push($files, $file);
		}
		return $files;
	}
	
	public function initialize($fileInputDto) {
		$file = new File();
		$file->setName($fileInputDto->getName());
		$file->setType($fileInputDto->getType());
		$file->setSize($fileInputDto->getSize());
		$file->setContent($fileInputDto->getContent());
		return $file;
	}
}