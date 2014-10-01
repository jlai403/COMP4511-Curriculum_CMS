<?php 

class ProgramInputDto {
	
	private $programName;
	private $comments;
	private $requesterId;
	private $disciplineId;

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

	public function getRequesterId(){
		return $this->requesterId;
	}
	
	public function setRequesterId($requesterId){
		$this->requesterId = $requesterId;
	}
	
	public function getDisciplineId(){
		return $this->disciplineId;
	}
	
	public function setDisciplineId($disciplineId){
		$this->disciplineId = $disciplineId;
	}
}