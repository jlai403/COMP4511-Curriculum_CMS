<?php

class SearchResultDto implements JsonSerializable{
	private $uri;
	private $type;
	private $name;
	private $requesterFirstName;
	private $requesterLastName;
	
	public function getUri() {
		return $this->uri;
	}
	
	public function setUri($uri) {
		$this->uri = $uri;
	}

	public function getType() {
		return $this->type;
	}
	
	public function setType($type) {
		$this->type = $type;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getRequesterFirstName() {
		return $this->requesterFirstName;
	}
	
	public function setRequesterFirstName($firstName) {
		$this->requesterFirstName = $firstName;
	}
	
	public function getRequesterLastName() {
		return $this->requesterLastName;
	}
	
	public function setRequesterLastName($lastName) {
		$this->requesterLastName = $lastName;
	}
	
	public function getRequesterFullName() {
		return $this->getRequesterFirstName() . " " . $this->getRequesterLastName();
	}

    function jsonSerialize()
    {
        return [
            'searchResultDto' => [
                'name' => $this->getName(),
                'type' => $this->getType(),
                'requester' => $this->getRequesterFullName(),
                'uri' => $this->getUri()
            ]
        ];
    }
}