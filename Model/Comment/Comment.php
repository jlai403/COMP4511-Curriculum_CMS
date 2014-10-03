<?php

class Comment implements IEntity {
	
	private $id;
	private $comment;
	private $author;
	private $dateTime;
	
	// Overriden: IEntity
	public function getId() {
		return $this->id;
	}
	
	// Overriden: IEntity
	public function setId($id) {
		$this->id = $id;
	}
	
	// Overriden: IEntity
	public function assertValid() {
	}
	
	public function getComment(){
		return $this->comment;
	}
	
	public function setComment($comment){
		$this->comment = $comment;
	}
	
	public function getDateTime(){
		return $this->dateTime;
	}
	
	public function setDateTime($dateTime){
		$this->dateTime = $dateTime;
	}
	
	public function getAuthor(){
		return $this->author;
	}
	
	public function setAuthor($author){
		$this->author = $author;
	}
}