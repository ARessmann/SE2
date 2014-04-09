<?php 

class EventTest extends PHPUnit_Framework_TestCase
{
	
    public function testExceptionIsRaisedForInvalidConstructorArguments()
    {
        new Core_Model_Event('1');
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
    	$event->setEventFrom(01.01.2000);
    	$event->setEventTo(02.02.2002);
    	$event->setEventTwCount("1");
    	$event->setEventState("running");
    	$event->setEventTweetTags("TestTag");
    	
    	$data = $event->toArray;
    	
    	$this->assertEqual($data['event_title'], "Test");
    	$this->assertEqual($data['event_description'], "Test");
    	$this->assertEqual($data['event_from'], 01.01.2000);
    	$this->assertEqual($data['event_to'], 02.02.2002);
    	$this->assertEqual($data['event_state'], "running"];
    	$this->assertEqual($data['event_tw_count'], "TestTag"];
    	
    }
    
    
    public function testSetGetEventTitle()
    {
       	$event = new Core_Model_Event();
       	
       	$event->setEventTitle("test");
    
    	$this->assertEqual("test", $event->getEventTitle);
    }
    
    public function testSetGetEventDescription()
    {
    	$event = new Core_Model_Event();
    
    	$event->setEventDescription("test");
    
    	$this->assertEqual("test", $event->getEventDescription);
    }
    
    public function testSetGetEventTo()
    {
    	$event = new Core_Model_Event();
    
    	$event->setEventTo(01.01.2000);
    
    	$this->assertEqual(01.01.2000, $event->getEventTo);
    }
    
    public function testSetGetEventFrom()
    {
    	$event = new Core_Model_Event();
    
    	$event->setEventFrom(01.01.2000);
    
    	$this->assertEqual(01.01.2000, $event->getEventFrom);
    }
    
    public function testSetGetEventTwCount()
    {
    	$event = new Core_Model_Event();
    
    	$event->setEventTwCount("1");
    
    	$this->assertEqual("1", $event->getEventTwCount);
    }
    
    public function testSetGetEventState()
    {
    	$event = new Core_Model_Event();
    
    	$event->setEventState("running");
    
    	$this->assertEqual("running", $event->getEventState);
    }
    
    public function testSetGetTweetTags()
    {
    	$event = new Core_Model_Event();
    
    	$event->setTweetTags("running");
    
    	$this->assertEqual("running", $event->getTweetTags);
    }
}