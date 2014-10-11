<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Term/Term.php');

class TermInitializer {
	
	private $termDto;
	
	public function __construct(TermDto $termDto) {
		$this->termDto = $termDto;
	}
	
	public function initialize() {
		$term = new Term();
		$term->setId($this->termDto->getId());
		$term->setYear($this->termDto->getYear());
		$term->setTerm($this->termDto->getTerm());
		return $term;
	}
}