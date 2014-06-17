<?php 

//include_once('modules/Sentiment.php');

//require_once 'init.php';
 
class SentimentTest extends ControllerTestCase
{

	public function testGetId() {

		$sentiment = new Core_Model_Sentiment();

		$id = $sentiment->getId();

		$this->assertTrue(isset($id));
	}
	public function testSaveEvent()
    	{
	    	$sentiment = new Core_Model_Sentiment();
	    	
	    	$sentiment->setSentimentLanguage("TestLang");
	    	$sentiment->setSentimentWord("TestWord");
	    	$sentiment->setSentimentWeight(1);
	    	$sentiment->setLangTxt("TestTxt");
	    	    	
	    	$id = $sentiment->save();
	    	
	    	$this->assertTrue(isset($id));
	    }
	    
	public function testToArrayContainsAttributes() 
	    {
		$sentiment = new Core_Model_Sentiment();
	    	
	    	$sentiment->setSentimentLanguage("TestLang");
	    	$sentiment->setSentimentWord("TestWord");
	    	$sentiment->setSentimentWeight(1);
	    	$sentiment->setLangTxt("TestTxt");
	    	
	    	$data = $sentiment->toArray();
	    	
	    	$this->assertTrue(($data['sent_language'] == "TestLang"));
	    	$this->assertTrue(($data['sent_word'] == "TestWord"));
	    	$this->assertTrue(($data['sent_weight'] == 1));
	    	$this->assertTrue(($data['sent_langTxt'] == "TestTxt"));
	    	
	    }

	public function testGetData() 
	    {
		$sentiment = new Core_Model_Sentiment();
	    	
	    	$sentiment->setSentimentLanguage("TestLang");
	    	$sentiment->setSentimentWord("TestWord");
	    	$sentiment->setSentimentWeight(1);
	    	$sentiment->setLangTxt("TestTxt");
	    	
	    	$data = $sentiment->getData();
	    	
	    	$this->assertTrue(($data['sent_language'] == "TestLang"));
	    	$this->assertTrue(($data['sent_word'] == "TestWord"));
	    	$this->assertTrue(($data['sent_weight'] == 1));
	    	$this->assertTrue(($data['sent_langTxt'] == "TestTxt"));
	    	
	    }

	public function testgetTableName () {

	  	$sentiment = new Core_Model_Sentiment();

		$this->assertTrue(('sentiment_definition' == $sentiment->getTableName()));

	}

	public function testgetProperties () {

	  	$sentiment = new Core_Model_Sentiment();

		$this->assertTrue((count($sentiment->getProperties()) > 0));

	}
	    
	public function testSetGetSentimentLanguage()
	    {
	       	$sentiment = new Core_Model_Sentiment();
	       	
	       	$sentiment->setSentimentLanguage("TestLang");
	    
	    	$this->assertTrue(("TestLang" == $sentiment->getSentimentLanguage()));
	    }
	    
	public function testSetGetSentimentWord()
	    {
	       	$sentiment = new Core_Model_Sentiment();
	       	
	       	$sentiment->setSentimentWord("TestWord");
	    
	    	$this->assertTrue(("TestWord" == $sentiment->getSentimentWord()));
	    }
	public function testSetGetSentimentWeight()
	    {
	       	$sentiment = new Core_Model_Sentiment();
	       	
	       	$sentiment->setSentimentWeight(1);
	    
	    	$this->assertTrue((1 == $sentiment->getSentimentWeight()));
	    }
	public function testSetGetLangTxt()
	    {
	       	$sentiment = new Core_Model_Sentiment();
	       	
	       	$sentiment->setLangTxt("TestTxt");
	    
	    	$this->assertTrue(("TestTxt" == $sentiment->getLangTxt()));
	    }
	}
