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
		$this->initializeDbConnection()->beginTransaction();
		try {
			$statement = $this->dbConnection->prepare($sp);
			$sqlExecuted = $statement->execute($params);
			$this->commitTransaction();
		} catch(Exception $e){
			$this->rollbackConnection();
			throw new MyException($e->getMessage());
		} finally {
			$this->closeDbConnection();
		}
	}
}
