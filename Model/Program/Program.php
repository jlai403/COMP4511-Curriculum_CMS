<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/IEntity.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Search/ISearchable.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Error/MyException.php');

class Program implements IEntity, ISearchable {
	
	private $id;
	private $programName;
	private $comments = array();
	private $requester;
	private $discipline;
	private $workflowDatas;
	private $requestedDate;
	private $files = array();
	
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
		$this->assertProgramNameIsValid();
	}
	
	private function assertProgramNameIsValid(){
		$programNameIsNull = is_null($this->getProgramName());
		$programNameIsEmpty = empty($this->getProgramName());
		if ($programNameIsNull || $programNameIsEmpty) throw new MyException("Program Name is required.");
	}
	
	public function getProgramName(){
		return $this->programName;
	}
	
	public function setProgramName($programName){
		$this->programName = $programName;
	}
	
	public function getRequestedDate(){
		return $this->requestedDate;
	}
	
	public function setRequestedDate($requestedDate){
		$this->requestedDate = $requestedDate;
	}

	public function getComments(){
		return $this->comments;
	}
	
	public function setComments($comments){
		$this->comments = $comments;
	}

	public function addComment($comment){
		array_push($this->comments, $comment);
	}
	
	public function getFiles(){
		return $this->files;
	}
	
	public function setFiles($files){
		$this->files = $files;
	}
	
	public function addFile($file){
		array_push($this->files, $file);
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
	
	public function getWorkflowDatas(){
		return $this->workflowDatas;
	}
	
	public function setWorkflowDatas($workflowDatas){
		$this->workflowDatas = $workflowDatas;
	}
	
	public function getCurrentWorkflowData() {
		$currentWorkflowData = end($this->workflowDatas);
		reset($this->workflowDatas);
		return $currentWorkflowData;
	}
}