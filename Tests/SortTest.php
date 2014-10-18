<?php

class SortTest extends PHPUnit_Framework_TestCase
{
	public function setUp() {
		require_once('/Users/jlai/Documents/Projects/COMP4511/Assignment1/Model/Search/SearchResultDto.php');
		require_once('/Users/jlai/Documents/Projects/COMP4511/Assignment1/View/Search/SearchViewHelper.php');
	}

	public function tearDown() {
		unset($_SERVER['DOCUMENT_ROOT']);
	}

	public function testSortByName()
	{
		// Arrange
		$sr1 = new SearchResultDto();
		$sr1->setName("Ruby");
		
		$sr2 = new SearchResultDto();
		$sr2->setName("Lorem Ipsum");
		
		$sr3 = new SearchResultDto();
		$sr3->setName("Lorem Ipsum Hidden");

        $sr4 = new SearchResultDto();
        $sr4->setName("ad");

		$searchResultDtos = array($sr1,$sr2,$sr3,$sr4);
		
		// Act
		$sortedArray = (new SearchViewHelper())->sortByName($searchResultDtos);
		
		// Assert
		$this->assertEquals($sr4->getName(), $sortedArray[0]->getName());
		$this->assertEquals($sr2->getName(), $sortedArray[1]->getName());
        $this->assertEquals($sr3->getName(), $sortedArray[2]->getName());
        $this->assertEquals($sr1->getName(), $sortedArray[3]->getName());

    }

    public function testSortByName_LowerCase()
    {
        // Arrange
        $sr1 = new SearchResultDto();
        $sr1->setName("ABC");

        $sr2 = new SearchResultDto();
        $sr2->setName("BCA");

        $sr3 = new SearchResultDto();
        $sr3->setName("CAB");

        $searchResultDtos = array($sr3,$sr1,$sr2);

        // Act
        $sortedArray = (new SearchViewHelper())->sortByName($searchResultDtos);

        // Assert
        $this->assertEquals($sr1->getName(), $sortedArray[0]->getName());
        $this->assertEquals($sr2->getName(), $sortedArray[1]->getName());
        $this->assertEquals($sr3->getName(), $sortedArray[2]->getName());
    }


    public function testSortByType()
	{
		// Arrange
		$sr1 = new SearchResultDto();
		$sr1->setType("Program");
		
		$sr2 = new SearchResultDto();
		$sr2->setType("Course");
	
		$sr3 = new SearchResultDto();
		$sr3->setType("Program");
	
		$searchResultDtos = array($sr3,$sr1,$sr2);
	
		// Act
		$sortedArray = (new SearchViewHelper())->sortByType($searchResultDtos);
	
		// Assert
		$this->assertEquals($sr2->getType(), $sortedArray[0]->getType());
		$this->assertEquals($sr1->getType(), $sortedArray[1]->getType());
		$this->assertEquals($sr3->getType(), $sortedArray[2]->getType());
	}
	
	public function testSortByRequester()
	{
		// Arrange
		$sr1 = new SearchResultDto();
		$sr1->setRequesterFirstName("Joey");
		$sr1->setRequesterLastName("Lai");
		
		$sr2 = new SearchResultDto();
		$sr2->setRequesterFirstName("John");
		$sr2->setRequesterLastName("Smith");
		
		$sr3 = new SearchResultDto();
		$sr3->setRequesterFirstName("Foo");
		$sr3->setRequesterLastName("Bar");
		
		$searchResultDtos = array($sr3,$sr1,$sr2);
	
		// Act
		$sortedArray = (new SearchViewHelper())->sortByRequester($searchResultDtos);
	
		// Assert
		$this->assertEquals($sr3->getRequesterFullName(), $sortedArray[0]->getRequesterFullName());
		$this->assertEquals($sr1->getRequesterFullName(), $sortedArray[1]->getRequesterFullName());
		$this->assertEquals($sr2->getRequesterFullName(), $sortedArray[2]->getRequesterFullName());
	}
}
