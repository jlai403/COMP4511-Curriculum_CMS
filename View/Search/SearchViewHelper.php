<?php

class SearchViewHelper {
	
	public function sortByName($searchResultDtos) { 
		$sortedArray = $searchResultDtos;
		usort($sortedArray, function($a, $b){
			return strcmp($a->getName(), $b->getName());
		});
		return $sortedArray;
	}
	
	public function sortByType($searchResultDtos) {
		$sortedArray = $searchResultDtos;
		usort($sortedArray, function($a, $b){
			return strcmp($a->getType(), $b->getType());
		});
		return $sortedArray;
	}
	
	public function sortByRequester($searchResultDtos) {
		$sortedArray = $searchResultDtos;
		usort($sortedArray, function($a, $b){
			return strcmp($a->getRequesterFullName(), $b->getRequesterFullName());
		});
		return $sortedArray;
	}
}