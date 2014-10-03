<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Repository.php');

class CommentRepository extends Repository {
	
	public function create(Comment $comment) {
		$params = array(
			$comment->getComment(),
			$comment->getAuthor()->getId(),
			$comment->getDateTime(),
		);
		$resultSet = parent::executeStoredProcedureWithResultSet("call createComment(?,?,?)", $params);
		return $resultSet[0]["CommentId"];
	}
	
	public function findCommentsForProgram($programId) {
		$params = array($programId);
		$resultSet = parent::executeStoredProcedureWithResultSet("call findCommentsForProgram(?)", $params);
		return $this->extractCommentsFromResultSet($resultSet);
	}
	
	private function extractCommentsFromResultSet($resultSet) {
		$comments = array();
		foreach($resultSet as $record) {
			array_push($comments, $this->extractCommentFromRecord($record));
		}
		return $comments;
	}
	
	private function extractCommentFromRecord($record) {
		$comment = new Comment();
		$comment->setId($record["id"]);
		$comment->setComment($record["comment"]);
		$comment->setDateTime($record["datetime"]);
		
		$author = (new UserRepository())->findById($record["author_id"]);
		$comment->setAuthor($author);
	
		return $comment;
	}
}