<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/IEntity.php');

class Term implements IEntity {
	private $id;
	private $year;
	private $term;
	
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
		//no asserts
	}
	
	public function getTerm(){
		return $this->term;
	}
	
	public function setTerm($term){
		$this->term = $term;
	}
	
	public function getYear(){
		return $this->year;
	}
	
	public function setYear($year){
		$this->year = $year;
	}
}