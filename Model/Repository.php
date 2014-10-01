<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Constants.php');

abstract class Repository {
	private $dbConnection;
	
	protected function initializeDbConnection() {
		try {
			$this->dbConnection = new PDO("mysql:host=".DBConstants::HOSTNAME.";dbname=assignment1", DBConstants::USERNAME, DBConstants::PASSWORD);
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
	
	protected function executeQueryWithResultSet($query) {
		$resultSet = array();
		
		$this->initializeDbConnection();
		$this->beginTransaction();
		try {
			$statement = $this->dbConnection->prepare($query);
			$statement->execute();
			$resultSet = $statement->fetchAll();
		} catch(Exception $e){
			throw new MyException($e->getMessage());
		} finally {
			$this->closeDbConnection();
		}
		return $resultSet;
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
	
	protected function executeStoredProcedureWithResultSet($sp, array $params = array()) {
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
}
