<?php 

//include_once('modules/Language.php');

//require_once 'init.php';
 
class LanguageTest extends ControllerTestCase
{
       public function testGetId() {

		$language = new Core_Model_Language();

		$id = $language->getId();

		$this->assertTrue(isset($id));
	}

	public function testSaveEvent(){

		$language = new Core_Model_Language();

		$language->setLanguageCode ("TestDE");
		
		$id = $language->save();

		$this->assertTrue(isset($id));
	}
	

    	public function testToArrayContainsAttributes() 
    	{
		$language = new Core_Model_Language();

		$language->setLanguageCode ("TestDE");
	    	
	    	$data = $language->toArray();

	    	$this->assertTrue(($data['language_code' ] == "TestDE"));
    	
    	}

	public function testGetData() 
    	{
		$language = new Core_Model_Language();

		$language->setLanguageCode ("TestDE");
	    	
	    	$data = $language->getData();

	    	$this->assertTrue(($data['language_code' ] == "TestDE"));
    	
    	}
    
    
	public function testgetTableName () {

	  	$language = new Core_Model_Language();

		$this->assertTrue(('language_definition' == $language->getTableName()));

	}

	public function testgetProperties () {

	  	$language = new Core_Model_Language();

		$this->assertTrue((count($language->getProperties()) > 0));

	}

	public function testSetGetLanguageCode() {

		$language = new Core_Model_Language();

		$language->setLanguageCode("TestDE");

		$this->assertTrue(("TestDE" == $language->getLanguageCode()));
	}

}
