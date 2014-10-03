<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Comment/Comment.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserInitializer.php');

class CommentInitializer {
	
	private $commentString;
	private $authorDto;
	
	public function __construct($commentString, $authorDto) {
		$this->commentString = $commentString;
		$this->authorDto = $authorDto;
	}
	
	public function initialize() {
		$comment = new Comment();
		$comment->setComment($this->commentString);
		$comment->setDateTime(date("Y-m-d h:i:s A"));
		
		$author = (new UserInitializer($this->authorDto))->initialize();
		$comment->setAuthor($author);
		return $comment;
	}
}