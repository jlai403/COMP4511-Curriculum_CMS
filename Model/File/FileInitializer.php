<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/File.php');

class FileInitializer {
	
	private $fileInputDto;
	
	public function __construct(FileInputDto $fileInputDto) {
		$this->fileInputDto = $fileInputDto;
	}
	
	public function initialize() {
		$file = new File();
		$file->setName($this->fileInputDto->getName());
		$file->setType($this->fileInputDto->getType());
		$file->setSize($this->fileInputDto->getSize());
		$file->setContent($this->fileInputDto->getContent());
		return $file;
	}
}