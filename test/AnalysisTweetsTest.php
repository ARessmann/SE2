<?php 

//include_once('modules/AnalysisTweets.php');

//require_once 'init.php';
 
class AnalysisTweetsTest extends ControllerTestCase
{
       
	public function testGetId() {

		$analysis = new Core_Model_AnalysisTweets();

		$id = $analysis->getId();

		$this->assertTrue(isset($id));
	}
	public function testSaveEvent(){

		$analysis = new Core_Model_AnalysisTweets();

		$analysis->setAnalysisId (1);
		$analysis->setTweetId(1);
		$analysis->setValue(1);
		
		$id = $analysis->save();

		$this->assertTrue(isset($id));
	}
	

    	public function testToArrayContainsAttributes() 
    	{
		$analysis = new Core_Model_AnalysisTweets();

		$analysis->setAnalysisId (1);
		$analysis->setTweetId(1);
		$analysis->setValue(1);
	    	
	    	$data = $analysis->toArray();

	    	$this->assertTrue(($data['analysis_id' ] == 1));
	    	$this->assertTrue(($data['tweet_id'] == 1));
	    	$this->assertTrue(($data['value' ] == 1));
    	
    	}

	public function testgetData() 
    	{
		$analysis = new Core_Model_AnalysisTweets();

		$analysis->setAnalysisId (1);
		$analysis->setTweetId(1);
		$analysis->setValue(1);
	    	
	    	$data = $analysis->getData();

	    	$this->assertTrue(($data['analysis_id' ] == 1));
	    	$this->assertTrue(($data['tweet_id'] == 1));
	    	$this->assertTrue(($data['value' ] == 1));
    	
    	}
    
	public function testgetTableName () {

	  	$analysis = new Core_Model_AnalysisTweets();

		$this->assertTrue(('analysis_tweets' == $analysis->getTableName()));

	}

	public function testgetProperties () {

	  	$analysis = new Core_Model_AnalysisTweets();

		$this->assertTrue((count($analysis->getProperties()) > 0));

	}


	public function testSetGetAnalysisId() {

		$analysis = new Core_Model_AnalysisTweets();

		$analysis->setAnalysisId(1);

		$this->assertTrue((1 == $analysis->getAnalysisId()));
	}

	public function testSetGetTweetId() {

		$analysis = new Core_Model_AnalysisTweets();

		$analysis->setTweetId(1);

		$this->assertTrue((1 == $analysis->getTweetId()));

	}

	public function testSetGetValue() {

		$analysis = new Core_Model_AnalysisTweets();

		$analysis->setValue(1);

		$this->assertTrue((1 == $analysis->getValue()));
	}
}
