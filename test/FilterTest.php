<?php 

//include_once('modules/Filter.php');

//require_once 'init.php';
 
class FilterTest extends ControllerTestCase
{
       
	public function testGetId() {

		$filter = new Core_Model_Filter();

		$id = $filter->getId();

		$this->assertTrue(isset($id));
	}
	public function testSaveEvent(){

		$filter = new Core_Model_Filter();

		$filter->setFilterName ("TestName");
		$filter->setFilterTags("TestTag");
		$filter->setFilterFrom("01.01.2000");
		$filter->setFilterTo("01.01.2000");
		$filter->setFilterLocation("TestLocation");
		$filter->setFilterLanguage("TestLang");
		$filter->setEventId("TestLocation");
		
		$id = $filter->save();

		$this->assertTrue(isset($id));
	}
	

    	public function testToArrayContainsAttributes() 
    	{
		$filter = new Core_Model_Filter();

		$filter->setFilterName ("TestName");
		$filter->setFilterTags("TestTag");
		$filter->setFilterFrom("01.01.2000");
		$filter->setFilterTo("01.01.2000");
		$filter->setFilterLocation("TestLocation");
		$filter->setFilterLanguage("TestLang");
		$filter->setEventId(1);
	    	
	    	$data = $filter->toArray();

	    	$this->assertTrue(($data['filter_name' ] == "TestName"));
	    	$this->assertTrue(($data['filter_tags'] == "TestTag"));
	    	$this->assertTrue(($data['filter_from' ] == "01.01.2000"));
		$this->assertTrue(($data['filter_to' ] == "01.01.2000"));
		$this->assertTrue(($data['filter_location' ] == "TestLocation"));
		$this->assertTrue(($data['filter_language' ] == "TestLang"));
		$this->assertTrue(($data['event_id' ] == 1));
		    	
    	}

	public function testgetData() 
    	{
		$filter = new Core_Model_Filter();

		$filter->setFilterName ("TestName");
		$filter->setFilterTags("TestTag");
		$filter->setFilterFrom("01.01.2000");
		$filter->setFilterTo("01.01.2000");
		$filter->setFilterLocation("TestLocation");
		$filter->setFilterLanguage("TestLang");
		$filter->setEventId(1);
	    	
	    	$data = $filter->getData();

	    	$this->assertTrue(($data['filter_name' ] == "TestName"));
	    	$this->assertTrue(($data['filter_tags'] == "TestTag"));
	    	$this->assertTrue(($data['filter_from' ] == "01.01.2000"));
		$this->assertTrue(($data['filter_to' ] == "01.01.2000"));
		$this->assertTrue(($data['filter_location' ] == "TestLocation"));
		$this->assertTrue(($data['filter_language' ] == "TestLang"));
		$this->assertTrue(($data['event_id' ] == 1));
    	
    	}
    
	public function testgetTableName () {

	  	$filter = new Core_Model_Filter();

		$this->assertTrue(('filter' == $filter->getTableName()));

	}

	public function testgetProperties () {

	  	$filter = new Core_Model_Filter();

		$this->assertTrue((count($filter->getProperties()) > 0));

	}


	public function testSetGetFilterName() {

		$filter = new Core_Model_Filter();

		$filter->setFilterName("TestName");

		$this->assertTrue(("TestName" == $filter->getFilterName()));
	}

	public function testSetFilterTags() {

		$filter = new Core_Model_Filter();

		$filter->setFilterTags("TestTag");

		$this->assertTrue(("TestTag" == $filter->getFilterTags()));

	}

	public function testSetGetFilterFrom() {

		$filter = new Core_Model_Filter();

		$filter->setFilterFrom("01.01.2000");

		$this->assertTrue(("01.01.2000" == $filter->getFilterFrom()));

	}

	public function testSetGetFilterTo() {

		$filter = new Core_Model_Filter();

		$filter->setFilterTo("01.01.2000");

		$this->assertTrue(("01.01.2000" == $filter->getFilterTo()));

	}
	public function testSetGetFilterLocation() {

		$filter = new Core_Model_Filter();

		$filter->setFilterLocation("TestLoc");

		$this->assertTrue(("TestLoc" == $filter->getFilterLocation()));

	}
	public function testSetGetFilterLanguage() {

		$filter = new Core_Model_Filter();

		$filter->setFilterLanguage("TestLang");

		$this->assertTrue(("TestLang" == $filter->getFilterLanguage()));

	}
	public function testSetGetEventId() {

		$filter = new Core_Model_Filter();

		$filter->setEventId(1);

		$this->assertTrue((1 == $filter->getEventId()));

	}
}
