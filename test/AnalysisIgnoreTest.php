<?php 

//include_once('modules/AnalysisIgnore.php');

//require_once 'init.php';
 
class AnalysisIgnoreTest extends ControllerTestCase
{

	public function testGetId() {

		$ignore = new Core_Model_AnalysisIgnore();

		$id = $ignore->getId();

		$this->assertTrue(isset($id));
	}
	public function testSaveEvent()
    	{
	    	$ignore = new Core_Model_AnalysisIgnore();
	    	
	    	$ignore->setFilterId(1);
	    	$ignore->setTweetId(1);
	    		    	    	
	    	$id = $ignore->save();
	    	
	    	$this->assertTrue(isset($id));
	    }
	    
	public function testToArrayContainsAttributes() 
	    {
		$ignore = new Core_Model_AnalysisIgnore();
	    	
	    	$ignore->setFilterId(1);
	    	$ignore->setTweetId(1);
	    	
	    	$data = $ignore->toArray();
	    	
	    	$this->assertTrue(($data['filter_id'] == 1));
	    	$this->assertTrue(($data['tweet_id'] == 1));
	    	
	    }

	public function testGetData() 
	    {
		$ignore = new Core_Model_AnalysisIgnore();
	    	
	    	$ignore->setFilterId(1);
	    	$ignore->setTweetId(1);
	    	
	    	$data = $ignore->getData();
	    	
	    	$this->assertTrue(($data['filter_id'] == 1));
	    	$this->assertTrue(($data['tweet_id'] == 1));
	    	
	    }

	public function testgetTableName () {

	  	$ignore = new Core_Model_AnalysisIgnore();

		$this->assertTrue(('analysis_ignore' == $ignore->getTableName()));

	}

	public function testgetProperties () {

	  	$ignore = new Core_Model_AnalysisIgnore();

		$this->assertTrue((count($ignore->getProperties()) > 0));

	}
	    
	public function testSetGetFilterId()
	    {
	       	$ignore = new Core_Model_AnalysisIgnore();
	       	
	       	$ignore->setFilterId(1);
	    
	    	$this->assertTrue((1 == $ignore->getFilterId()));
	    }
	    
	public function testSetGetTweetId()
	    {
	       	$ignore = new Core_Model_AnalysisIgnore();
	       	
	       	$ignore->setTweetId(1);
	    
	    	$this->assertTrue((1 == $ignore->getTweetId()));
	    }
	}
