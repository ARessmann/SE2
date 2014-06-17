<?php 

//include_once('modules/Event.php');

//require_once 'init.php';
 
class EventTest extends ControllerTestCase
{

	public function testGetId() {

		$event = new Core_Model_Event();

		$id = $event->getId();

		$this->assertTrue(isset($id));
	}
	public function testSaveEvent()
    	{
	    	$event = new Core_Model_Event();
	    	
	    	$event->setEventTitle("Test");
	    	$event->setEventDescription("Test");
	    	$event->setEventFrom("01.01.2000");
	    	$event->setEventTo("02.02.2002");
	    	$event->setEventTwCount("1");
	    	$event->setEventState("running");
	    	$event->setEventTweetTags("TestTag");
	    	    	
	    	$id = $event->save();
	    	
	    	$this->assertTrue(isset($id));
	    }
	    
	public function testToArrayContainsAttributes() 
	    {
		$event = new Core_Model_Event();

	    	$event->setEventTitle("Test");
	    	$event->setEventDescription("Test");
	    	$event->setEventFrom("01.01.2000");
	    	$event->setEventTo("02.02.2002");
	    	$event->setEventTwCount("1");
	    	$event->setEventState("running");
	    	$event->setEventTweetTags("TestTag");
	    	
	    	$data = $event->toArray();
	    	
	    	$this->assertTrue(($data['event_title'] == "Test"));
	    	$this->assertTrue(($data['event_description'] == "Test"));
	    	$this->assertTrue(($data['event_from'] == "01.01.2000"));
	    	$this->assertTrue(($data['event_to'] == "02.02.2002"));
	    	$this->assertTrue(($data['event_state'] == "running"));
	    	$this->assertTrue(($data['event_tweet_tags'] == "TestTag"));
	    	
	    }

	public function testGetData() 
	    {
		$event = new Core_Model_Event();

	    	$event->setEventTitle("Test");
	    	$event->setEventDescription("Test");
	    	$event->setEventFrom("01.01.2000");
	    	$event->setEventTo("02.02.2002");
	    	$event->setEventTwCount("1");
	    	$event->setEventState("running");
	    	$event->setEventTweetTags("TestTag");
	    	
	    	$data = $event->getData();
	    	
	    	$this->assertTrue(($data['event_title'] == "Test"));
	    	$this->assertTrue(($data['event_description'] == "Test"));
	    	$this->assertTrue(($data['event_from'] == "01.01.2000"));
	    	$this->assertTrue(($data['event_to'] == "02.02.2002"));
	    	$this->assertTrue(($data['event_state'] == "running"));
	    	$this->assertTrue(($data['event_tweet_tags'] == "TestTag"));
	    	
	    }

	public function testgetTableName () {

	  	$event = new Core_Model_Event();

		$this->assertTrue(('event' == $event->getTableName()));

	}

	public function testgetProperties () {

	  	$event = new Core_Model_Event();

		$this->assertTrue((count($event->getProperties()) > 0));

	}
	    
	public function testSetGetEventTitle()
	    {
	       	$event = new Core_Model_Event();
	       	
	       	$event->setEventTitle("test");
	    
	    	$this->assertTrue(("test" == $event->getEventTitle()));
	    }
	    
	public function testSetGetEventDescription()
	    {
	    	$event = new Core_Model_Event();
	    
	    	$event->setEventDescription("test");
	    
	    	$this->assertTrue(("test" == $event->getEventDescription()));
	    }
	    
	public function testSetGetEventTo()
	    {
	    	$event = new Core_Model_Event();
	    
	    	$event->setEventTo("01.01.2000");
	    
	    	$this->assertTrue(("01.01.2000" == $event->getEventTo()));
	    }
	    
	public function testSetGetEventFrom()
	    {
	    	$event = new Core_Model_Event();
	    
	    	$event->setEventFrom("01.01.2000");
	    
	    	$this->assertTrue(("01.01.2000" == $event->getEventFrom()));
	    }
	    
	public function testSetGetEventTwCount()
	    {
	    	$event = new Core_Model_Event();
	    
	    	$event->setEventTwCount("1");
	    
	    	$this->assertTrue(("1" == $event->getEventTwCount()));
	    }
	    
	public function testSetGetEventState()
	    {
	    	$event = new Core_Model_Event();
	    
	    	$event->setEventState("running");
	    
	    	$this->assertTrue(("running" == $event->getEventState()));
	    }
	    
	public function testSetGetTweetTags()
	    {
	    	$event = new Core_Model_Event();
	    
	    	$event->setEventTweetTags("running");
	    
	    	$this->assertTrue(("running" == $event->getEventTweetTags()));
	    }
	}
