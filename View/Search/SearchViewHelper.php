<?php

class SearchViewHelper {
	
	public function sortByName($searchResultDtos) { 
		$sortedArray = $searchResultDtos;
		usort($sortedArray, function($a, $b){
			return strcasecmp($a->getName(), $b->getName());
		});
		return $sortedArray;
	}
	
	public function sortByType($searchResultDtos) {
		$sortedArray = $searchResultDtos;
		usort($sortedArray, function($a, $b){
			return strcasecmp($a->getType(), $b->getType());
		});
		return $sortedArray;
	}
	
	public function sortByRequester($searchResultDtos) {
		$sortedArray = $searchResultDtos;
		usort($sortedArray, function($a, $b){
			return strcasecmp($a->getRequesterFullName(), $b->getRequesterFullName());
		});
		return $sortedArray;
	}
}