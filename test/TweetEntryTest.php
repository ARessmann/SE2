<?php 

//include_once('modules/TweetEntry.php');

//require_once 'init.php';
 
class TweetEntryTest extends ControllerTestCase
{

 	public function testGetId() {

		$tweetEntry = new Core_Model_TweetEntry();

		$id = $tweetEntry->getId();

		$this->assertTrue(isset($id));
	}
    	public function testSaveEvent()
    	{
		$tweetEntry = new Core_Model_TweetEntry();

		$tweetEntry->setTweetText("Test");
		$tweetEntry->setCreationDate ("01.01.2000");
		$tweetEntry->setDeletedState ("1");
		$tweetEntry->setLanguage ("TestLang");
		$tweetEntry->setTweetUser ("TestUser");
		$tweetEntry->setLocation ("TestLoc");
		$tweetEntry->setWeight (1);
		$tweetEntry->setEventId(1);
		    	
	    	$id = $tweetEntry->save();
	    	
	    	$this->assertTrue(isset($id));
    	}
    
    	public function testToArrayContainsAttributes() 
    	{
	    	$tweetEntry = new Core_Model_TweetEntry();
	

		$tweetEntry->setTweetText("Test");
		$tweetEntry->setCreationDate ("01.01.2000");
		$tweetEntry->setDeletedState (1);
		$tweetEntry->setLanguage ("TestLang");
		$tweetEntry->setTweetUser ("TestUser");
		$tweetEntry->setLocation ("TestLoc");
		$tweetEntry->setWeight (1);
		$tweetEntry->setEventId(1);

	    	
	    	$data = $tweetEntry->toArray();
	    	
	    	$this->assertTrue(($data['tw_user' ] == "TestUser"));
	    	$this->assertTrue(($data['tw_text'] == "Test"));
	    	$this->assertTrue(($data['tw_creationdate' ] == "01.01.2000"));
	    	$this->assertTrue(($data['tw_location'] == "TestLoc"));
	    	$this->assertTrue(($data['tw_language'] == "TestLang"));
	    	$this->assertTrue(($data['tw_deleted'] == 1));
		$this->assertTrue(($data['tw_weight'] == 1));
		$this->assertTrue(($data['event_id'] == 1));
    	
    	}

	public function testGetData() 
    	{
	    	$tweetEntry = new Core_Model_TweetEntry();
	

		$tweetEntry->setTweetText("Test");
		$tweetEntry->setCreationDate ("01.01.2000");
		$tweetEntry->setDeletedState (1);
		$tweetEntry->setLanguage ("TestLang");
		$tweetEntry->setTweetUser ("TestUser");
		$tweetEntry->setLocation ("TestLoc");
		$tweetEntry->setWeight (1);
		$tweetEntry->setEventId(1);

	    	
	    	$data = $tweetEntry->getData();
	    	
	    	$this->assertTrue(($data['tw_user' ] == "TestUser"));
	    	$this->assertTrue(($data['tw_text'] == "Test"));
	    	$this->assertTrue(($data['tw_creationdate' ] == "01.01.2000"));
	    	$this->assertTrue(($data['tw_location'] == "TestLoc"));
	    	$this->assertTrue(($data['tw_language'] == "TestLang"));
	    	$this->assertTrue(($data['tw_deleted'] == 1));
		$this->assertTrue(($data['tw_weight'] == 1));
		$this->assertTrue(($data['event_id'] == 1));
    	
    	}
    
	public function testgetTableName () {

	  	$tweetEntry = new Core_Model_TweetEntry();

		$this->assertTrue(('tweet_entry' == $tweetEntry->getTableName()));

	}

	public function testgetProperties () {

	  	$tweetEntry = new Core_Model_TweetEntry();

		$this->assertTrue((count($tweetEntry->getProperties()) > 0));

	}

	public function testSetGetTweetText() {

		$tweetEntry = new Core_Model_TweetEntry();

		$tweetEntry->setTweetText("Test");

		$this->assertTrue(("Test" == $tweetEntry->getTweetText()));
	}

	public function testSetGetCreationDate() {

		$tweetEntry = new Core_Model_TweetEntry();

		$tweetEntry->setCreationDate("01.01.2000");

		$this->assertTrue(("01.01.2000" == $tweetEntry->getCreationDate()));
	}

	public function testSetDeletedState() {

		$tweetEntry = new Core_Model_TweetEntry();

		$tweetEntry->setDeletedState(1);

		$this->assertTrue((1 == $tweetEntry->getDeletedState()));
	}

	public function testSetGetLanguage() {

		$tweetEntry = new Core_Model_TweetEntry();

		$tweetEntry->setLanguage("TestLang");

		$this->assertTrue(("TestLang" == $tweetEntry->getLanguage()));
	}
	public function testSetGetTweetUser() {

		$tweetEntry = new Core_Model_TweetEntry();

		$tweetEntry->setTweetUser("TestUsr");

		$this->assertTrue(("TestUsr" == $tweetEntry->getTweetUser()));
	}
	public function testSetGetLocation() {

		$tweetEntry = new Core_Model_TweetEntry();

		$tweetEntry->setLocation("TestLoc");

		$this->assertTrue(("TestLoc" == $tweetEntry->getLocation()));
	}
	public function testSetGetWeight() {

		$tweetEntry = new Core_Model_TweetEntry();

		$tweetEntry->setWeight("TestLang");

		$this->assertTrue(("TestLang" == $tweetEntry->getWeight()));
	}

	public function testSetGetEventId() {

		$tweetEntry = new Core_Model_TweetEntry();

		$tweetEntry->setEventId(1);

		$this->assertTrue((1 == $tweetEntry->getEventId()));
	}
	
}
