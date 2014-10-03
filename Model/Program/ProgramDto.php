<?php 

class ProgramDto {
	
	private $id;
	private $programName;
	private $commentDtos = array();
	private $requesterName;
	private $disciplineDto;
	private $requestedDate;
	private $workflowDataDto;

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
	
	public function getWorkflowDataDto(){
		return $this->workflowDataDto;
	}
	
	public function setWorkflowDataDto($workflowDataDto){
		$this->workflowDataDto = $workflowDataDto;
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
	
	public function getResponsibleParty() {
		return $this->getWorkflowDataDto()->getApprovalChainStepDto()->getRoleDto()->getName();
	}
}