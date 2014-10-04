<?php 

class ProgramInputDto {
	
	private $programName;
	private $comments;
	private $requesterDto;
	private $disciplineDto;
	private $fileInputDtos;
	
	public function getProgramName(){
		return $this->programName;
	}
	
	public function setProgramName($programName){
		$this->programName = $programName;
	}

	public function getComments(){
		return $this->comments;
	}
	
	public function setComments($comments){
		$this->comments = $comments;
	}

	public function getRequesterDto(){
		return $this->requesterDto;
	}
	
	public function setRequesterDto($requesterDto){
		$this->requesterDto = $requesterDto;
	}
	
	public function getDisciplineDto(){
		return $this->disciplineDto;
	}
	
	public function setDisciplineDto($disciplineDto){
		$this->disciplineDto = $disciplineDto;
	}
	
	public function getFileInputDtos(){
		return $this->fileInputDtos;
	}
	
	public function setFileInputDtos($fileInputDtos){
		$this->fileInputDtos = $fileInputDtos;
	}
}