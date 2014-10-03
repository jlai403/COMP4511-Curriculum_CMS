<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Comment/Comment.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Comment/CommentDto.php');

class CommentAssembler {
	
	public function assembleAll($comments) {
		$commentDtos = array();
		foreach($comments as $comment) {
			$commentDto = $this->assemble($comment);
			array_push($commentDtos, $commentDto);
		}
		return $commentDtos;
	}
	
	
	public function assemble(Comment $comment) {
		$commentDto = new CommentDto();
		$commentDto->setComment($comment->getComment());
		$commentDto->setDateTime($comment->getDateTime());
		$commentDto->setAuthorName($comment->getAuthor()->getFullName());
		return $commentDto;
	}
}