<?php

class UserTest extends PHPUnit_Framework_TestCase
{
	public function setUp() {
		$_SERVER['DOCUMENT_ROOT'] = "/Users/jlai/Documents/Projects/COMP4511/Assignment1";
		require_once('/Users/jlai/Documents/Projects/COMP4511/Assignment1/Model/User/User.php');
		require_once('/Users/jlai/Documents/Projects/COMP4511/Assignment1/Model/Error/MyException.php');
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
		$user->setEncryptedPassword("password$1");
		$user->setRoles(array("role", "role2"));

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
    	$user->setEncryptedPassword("password$1");

        // Act
		$user->assertValid();        

        // Assert
       	// assert exception thrown (above function declaration)
    }
    
    /**
     * @expectedException        MyException
     * @expectedExceptionMessage At least one role must be selected.
     */
    public function testAssert_noRoleSelected()
    {
    	// Arrange
    	$user = new User();
    	$user->setEmail("username@mtroyal.ca");
    	$user->setEncryptedPassword("password$1");
    
    	// Act
    	$user->assertValid();
    
    	// Assert
    	// assert exception thrown (above function declaration)
    }
    
    public function testAssertAndEncrpytPassword()
    {
    	// Arrange
    	$password = "password$1";
    
    	// Act
    	$encrpytedPassword = SecurityManager::assertAndEncrpytPassword($password);
    
    	// Assert
    	$this->assertNotEquals($password, $encrpytedPassword);
    }
    
    /**
     * @expectedException        MyException
     * @expectedExceptionMessage Password does not have at least 6 characters.
     */
    public function testAssertAndEncrpytPassword_invalidPassword()
    {
    	// Arrange
    	$password = "passw";
    
    	// Act
    	$encrpytedPassword = SecurityManager::assertAndEncrpytPassword($password);
    
    	// Assert
    	$this->assertNotEquals($password, $encrpytedPassword);      
    }

}
