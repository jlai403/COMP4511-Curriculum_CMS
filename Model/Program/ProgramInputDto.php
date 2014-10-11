<?php 

class ProgramInputDto {
	
	private $programName;
	private $comments;
	private $requesterDto;
	private $disciplineDto;
	private $fileInputDtos;
	private $effectiveTermDto;
	private $crossImpact;
	private $studentImpact;
	private $libraryImpact;
	private $itsImpact;
	
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
	
	public function getEffectiveTermDto(){
		return $this->effectiveTermDto;
	}
	
	public function setEffectiveTermDto($termDto){
		$this->effectiveTermDto = $termDto;
	}
	
	public function getCrossImpact() {
		return $this->crossImpact;
	}
	
	public function setCrossImpact($crossImpact) {
		$this->crossImpact = $crossImpact;
	}
	
	public function getStudentImpact() {
		return $this->studentImpact;
	}
	
	public function setStudentImpact($studentImpact) {
		$this->studentImpact = $studentImpact;
	}
	
	public function getLibraryImpact() {
		return $this->libraryImpact;
	}
	
	public function setLibraryImpact($libraryImpact) {
		$this->libraryImpact = $libraryImpact;
	}
	
	public function getItsImpact() {
		return $this->itsImpact;
	}
	
	public function setItsImpact($itsImpact) {
		$this->itsImpact = $itsImpact;
	}
}