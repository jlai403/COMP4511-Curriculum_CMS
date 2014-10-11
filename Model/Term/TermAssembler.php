<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Term/Term.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Term/TermDto.php');

class TermAssembler {
	
	public function assembleAll($terms) {
		if (is_null($terms)) return null;
		
		$termDtos = array();
		foreach($terms as $term){
			$termDto = $this->assemble($term);			
			array_push($termDtos, $termDto);
		}
		return $termDtos;
	}
	
	public function assemble($term) {
		$termDto = new TermDto();
		$termDto->setId($term->getId());
		$termDto->setYear($term->getYear());
		$termDto->setTerm($term->getTerm());
		return $termDto;
	}
}