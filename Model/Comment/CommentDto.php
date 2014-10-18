<?php

class CommentDto implements JsonSerializable {
	
	private $comment;
	private $authorName;
	private $dateTime;
	
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
	
	public function getAuthorName(){
		return $this->authorName;
	}
	
	public function setAuthorName($authorName){
		$this->authorName = $authorName;
	}

    function jsonSerialize()
    {
        return [
            'commentDto' => [
                'comment' => $this->getComment(),
                'authorName' => $this->getAuthorName(),
                'dateTime' => $this->getDateTime()
            ]
        ];
    }
}