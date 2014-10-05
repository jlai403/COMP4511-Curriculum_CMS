<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/FileInputDto.php');

class FileUploadHelper {

	public static function convertToFileInputDtos($attachments) {
		$attachments = self::reorganizeAttachments($attachments);
		$fileInputDtos = array();
		foreach($attachments as $attachment) {
			if(empty($attachment["name"])) continue;
			$fileInputDto = new FileInputDto();
			$fileInputDto->setName($attachment["name"]);
			$fileInputDto->setType($attachment["type"]);
			$fileInputDto->setSize($attachment["size"]);
			
			$content = file_get_contents($attachment["tmp_name"]);
			$fileInputDto->setContent($content);
			
			array_push($fileInputDtos, $fileInputDto);
		}		
		return $fileInputDtos;
	}
	
	private static function reorganizeAttachments($attachments) {
		$result = array();
		foreach($attachments as $key1 => $value1) {
			foreach($value1 as $key2 => $value2) {
				$result[$key2][$key1] = $value2;
			}
		}
		return $result;
	}
}