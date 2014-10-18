<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/File.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/FileDto.php');

class FileAssembler {
	
	public function assembleAll($files) {
		$fileDtos = array();
        if (is_null($files)) return $fileDtos;

		foreach($files as $file) {
			$fileDto = $this->assemble($file);
			array_push($fileDtos, $fileDto);
		}
		return $fileDtos;
	}
	
	
	public function assemble(File $file) {
		$fileDto = new FileDto();
		$fileDto->setId($file->getId());
		$fileDto->setName($file->getName());
		$fileDto->setType($file->getType());
		$fileDto->setSize($file->getSize());
		$fileDto->setContent($file->getcontent());
		return $fileDto;
	}
}