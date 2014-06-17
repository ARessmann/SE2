<?php 

//include_once('modules/Analysis.php');

//require_once 'init.php';
 
class AnalysisTest extends ControllerTestCase
{

	public function testGetId() {

		$analysis = new Core_Model_Analysis();

		$id = $analysis->getId();

		$this->assertTrue(isset($id));
	}
	public function testSaveEvent()
    	{
	    	$analysis = new Core_Model_Analysis();
	    	
	    	$analysis->setAnalysisDate("01.01.2000");
	    	$analysis->setEventId(1);
	    	$analysis->setFilterId(1);
	    		    	    	
	    	$id = $analysis->save();
	    	
	    	$this->assertTrue(isset($id));
	    }
	    
	public function testToArrayContainsAttributes() 
	    {
		$analysis = new Core_Model_Analysis();
	    	
	    	$analysis->setAnalysisDate("01.01.2000");
	    	$analysis->setEventId(1);
	    	$analysis->setFilterId(1);
	    	
	    	$data = $analysis->toArray();
	    	
	    	$this->assertTrue(($data['analysis_date'] == "01.01.2000"));
	    	$this->assertTrue(($data['event_id'] == 1));
	    	$this->assertTrue(($data['filter_id'] == 1));
	    	
	    }

	public function testGetData() 
	    {
		$analysis = new Core_Model_Analysis();
	    	
	    	$analysis->setAnalysisDate("01.01.2000");
	    	$analysis->setEventId(1);
	    	$analysis->setFilterId(1);
	    	
	    	$data = $analysis->getData();
	    	
	    	$this->assertTrue(($data['analysis_date'] == "01.01.2000"));
	    	$this->assertTrue(($data['event_id'] == 1));
	    	$this->assertTrue(($data['filter_id'] == 1));
	    	
	    }

	public function testgetTableName () {

	  	$analysis = new Core_Model_Analysis();

		$this->assertTrue(('analysis' == $analysis->getTableName()));

	}

	public function testgetProperties () {

	  	$analysis = new Core_Model_Analysis();

		$this->assertTrue((count($analysis->getProperties()) > 0));

	}
	    
	public function testSetGetAnalysisDate()
	    {
	       	$analysis = new Core_Model_Analysis();
	       	
	       	$analysis->setAnalysisDate("01.01.2000");
	    
	    	$this->assertTrue(("01.01.2000" == $analysis->getAnalysisDate()));
	    }
	    
	public function testSetGetEventId()
	    {
	       	$analysis = new Core_Model_Analysis();
	       	
	       	$analysis->setEventId(1);
	    
	    	$this->assertTrue((1 == $analysis->getEventId()));
	    }
	public function testSetGetFilterId()
	    {
	       	$analysis = new Core_Model_Analysis();
	       	
	       	$analysis->setFilterId(1);
	    
	    	$this->assertTrue((1 == $analysis->getFilterId()));
	    }
	}
