<?php

interface IEntity {
	public function getId();
	public function setId($id);
	public function assertValid();
}