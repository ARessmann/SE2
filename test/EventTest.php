<?php 

class EventTest extends PHPUnit_Framework_TestCase
{
	//for example
    public function testExceptionIsRaisedForInvalidConstructorArguments()
    {
        new Core_Model_Event('1');
    }

    public function testSaveEvent()
    {
    	$event = new Core_Model_Event();
    	
    	//... add attributes
    	
    	$id = $event->save();
    	
    	$this->assertTrue(isset($id));
    }
}