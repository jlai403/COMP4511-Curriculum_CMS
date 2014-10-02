<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/IEntity.php');

class Program implements IEntity {
	
	private $id;
	private $programName;
	private $comments;
	private $requester;
	private $discipline;
	private $workflowData;

	// Overriden: IEntity
	public function getId(){
		return $this->id;
	}
	
	// Overriden: IEntity
	public function setId($id){
		$this->id = $id;
	}
	
	// Overriden: IEntity
	public function assertValid(){
	}
	
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

	public function getRequester(){
		return $this->requester;
	}
	
	public function setRequester($requester){
		$this->requester = $requester;
	}
	
	public function getDiscipline(){
		return $this->discipline;
	}
	
	public function setDiscipline($discipline){
		$this->discipline = $discipline;
	}
	
	public function getWorkflowData(){
		return $this->workflowData;
	}
	
	public function setWorkflowData($workflowData){
		$this->workflowData = $workflowData;
	}
}