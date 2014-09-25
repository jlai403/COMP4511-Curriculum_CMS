<?php

class UserTest extends PHPUnit_Framework_TestCase
{
	public function setUp() {
		$_SERVER['DOCUMENT_ROOT'] = "/Users/jlai/Documents/Projects/COMP4511/Assignment1";
		require_once('/Users/jlai/Documents/Projects/COMP4511/Assignment1/Model/User/User.php');
		require_once('/Users/jlai/Documents/Projects/COMP4511/Assignment1/Model/Erro/MyException.php');
		require_once('/Users/jlai/Documents/Projects/COMP4511/Assignment1/Model/SecurityManager.php');
	}
	
	public function tearDown() {
		unset($_SERVER['DOCUMENT_ROOT']);
	}
	
	public function testAssert()
	{
		// Arrange
		$user = new User();
		$user->setEmail("jlai4991@mtroyal.ca");
		$user->setPassword("password$1");
		
		// Act
		$user->assertValid();
	
		// Assert
	}
	
	/**
	 * @expectedException        MyException
	 * @expectedExceptionMessage Email is an invalid format.
	 */
    public function testAssert_invalidEmail()
    {
        // Arrange
    	$user = new User();
    	$user->setEmail("username@gmail.com");
    	$user->setPassword("password$1");

        // Act
		$user->assertValid();        

        // Assert
       	// assert exception thrown (above function declaration)
    }
    
    public function testValidateAndEncrpytPassword()
    {
    	// Arrange
    	$password = "password$1";
    
    	// Act
    	$encrpytedPassword = SecurityManager::validateAndEncrpytPassword($password);
    
    	// Assert
    	$this->assertNotEquals($password, $encrpytedPassword);
    }
    
    /**
     * @expectedException        MyException
     * @expectedExceptionMessage Password does not have at least 6 characters.
     */
    public function testValidateAndEncrpytPassword_invalidPassword()
    {
    	// Arrange
    	$password = "passw";
    
    	// Act
    	$encrpytedPassword = SecurityManager::validateAndEncrpytPassword($password);
    
    	// Assert
    	$this->assertNotEquals($password, $encrpytedPassword);      
    }

}
