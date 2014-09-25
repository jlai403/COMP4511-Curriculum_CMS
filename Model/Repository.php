<?php

abstract class Repository {
	/*** mysql hostname ***/
	private $hostname = 'localhost';
	
	/*** mysql username ***/
	private $username = 'comp4511_dev';
	
	/*** mysql password ***/
	private $password = 'comp4511_password$1';
	
	private $dbConnection;
	
	protected function initializeDbConnection() {
		try {
			$this->dbConnection = new PDO("mysql:host=".$this->hostname.";dbname=assignment1", $this->username, $this->password);
			return $this->dbConnection;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	protected function beginTransaction() {
		$this->dbConnection->beginTransaction();
	}
	
	protected function commitTransaction() {
		$this->dbConnection->commit();
	}
	
	protected function rollbackTransaction() {
		$this->dbConnection->rollBack();
	}
	
	protected function closeDbConnection() {
		$this->dbConnection = null;
	}
	
	protected function executeStoredProcedure($sp, array $params) {
		$success = false;
		
		$this->initializeDbConnection();
		$this->beginTransaction();
		try {
			$statement = $this->dbConnection->prepare($sp);
			$success = $statement->execute($params);
			$this->commitTransaction();
		} catch(Exception $e){
			$this->rollbackConnection();
			throw new MyException($e->getMessage());
		} finally {
			$this->closeDbConnection();
		}
		
		return $success;
	}
	
	protected function executeSelectStoredProcedure($sp, array $params) {
		$resultSet = array();
		
		$this->initializeDbConnection();
		try {
			$statement = $this->dbConnection->prepare($sp);
			$statement->execute($params);
			$resultSet = $statement->fetchAll();
		} catch(Exception $e){
			throw new MyException($e->getMessage());
		} finally {
			$this->closeDbConnection();
		}
		
		return $resultSet;
	}
	
	/*** ABSTRACT METHODS ***/
	public abstract function create(IEntity $entity);
}
