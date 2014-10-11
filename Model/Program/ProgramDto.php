<?php 

class ProgramDto {
	
	private $id;
	private $programName;
	private $commentDtos = array();
	private $fileDtos = array();
	private $requesterName;
	private $disciplineDto;
	private $requestedDate;
	private $workflowDataDtos = array();
	private $effectiveTermDto;
	private $crossImpact;
	private $studentImpact;
	private $libraryImpact;
	private $itsImpact;
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function getRequestedDate(){
		return $this->requestedDate;
	}
	
	public function setRequestedDate($requestedDate){
		$this->requestedDate = $requestedDate;
	}
	
	public function getWorkflowDataDtos(){
		return $this->workflowDataDtos;
	}
	
	public function setWorkflowDataDtos($workflowDataDtos){
		$this->workflowDataDtos = $workflowDataDtos;
	}
	
	public function getProgramName(){
		return $this->programName;
	}
	
	public function setProgramName($programName){
		$this->programName = $programName;
	}

	public function getCommentDtos(){
		return $this->commentDtos;
	}
	
	public function setCommentDtos($commentDtos){
		$this->commentDtos = $commentDtos;
	}
	
	public function getFileDtos(){
		return $this->fileDtos;
	}
	
	public function setFileDtos($fileDtos){
		$this->fileDtos = $fileDtos;
	}
	

	public function getRequesterName(){
		return $this->requesterName;
	}
	
	public function setRequesterName($requesterName){
		$this->requesterName = $requesterName;
	}
	
	public function getDisciplineDto(){
		return $this->disciplineDto;
	}
	
	public function setDisciplineDto($disciplineDto){
		$this->disciplineDto = $disciplineDto;
	}
	
	public function getEffectiveTermDto(){
		return $this->effectiveTermDto;
	}
	
	public function setEffectiveTermDto($effectiveTermDto){
		$this->effectiveTermDto = $effectiveTermDto;
	}
	
	public function getResponsibleParty() {
		return $this->getCurrentWorkflowDataDto()->getApprovalChainStepDto()->getRoleDto()->getName();
	}
	
	public function getCurrentWorkflowDataDto() {
		$currentWorkflowDataDto = end($this->workflowDataDtos);
		reset($this->workflowDataDtos);
		return $currentWorkflowDataDto;
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