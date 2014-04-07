<?php
/**
 * this class handle all ajax calls and includes also 
 * the main api calls like booking amount or getting the transaction file
 *
 * @author Andreas Ressmann
 * 31.03.2014
 */
class ApiController extends Core_AbstractController
{
	/*
	 * initialize the controller
	 * setting content type and encoding disable the zend page rendering 
	 */   
    public function init() {
        
        parent::init();
        
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        $this->view->encoding = 'UTF-8';
    }
    
    /**
     * Core function to set the application language
     */
    public function setlangAction () {
    	
    	$this->getResponse()->setHeader('Content-Type', 'text/html');
    	
    	$lang = $this->_getParam('lang');
    	$this->session->lang = $lang;

    }
    
	/**
	 * getting an Event by Id and transform it to a json string
	 *
	 * @return json string 
	 */
    public function geteventAction () {
        $id = $this->_getParam('id');
        
        $event = new Core_Model_Event ();
        
        if (isset ($id)) {
            $value = $event->loadById ($id);
            
            if (isset ($value))  {
                return $this->apiControllerHelper->formatOutput($value);
            }
        }
    }
        
	/**
	 * Function to delete a Event by the given Id
	 *
	 * @return json success message or a error message
	 */
    public function deleteeventAction () {
        
        $id = $this->_getParam('id');
        
        try {
            if (isset ($id)) {
                $event = new Core_Model_Event ();
                $event->delete ($id);
            }
            return $this->apiControllerHelper->formatOutput(array(
                'success'               => true,
                'success_title'     => 'Event wurde erfolgreich gelöscht',
                'success_description'   => ''
            ));
        }
        catch (Exception $e) {
            return $this->apiControllerHelper->formatOutput(array(
                'error'             => true,
                'error_title'       => 'Fehler beim Löschen des Events',
                'error_description' => ''
            ));
        }
    }
    
	/**
	 * function to save or update a Event object 
	 * the validation array includes the pattern for the validator to validate the 
	 * fields
	 *
	 * @return json success message or a error message
	 */
    public function editeventAction () {
        
        $data = json_decode($_POST['data']);
        
        $id = $data->id;
        $event_description = $data->event_description;
        $event_title = $data->event_title;
        $event_from = $data->event_from;
        $event_to = $data->event_to;
        $event_tw_count = $data->event_tw_count;
        $event_state = $data->event_state;
        
        try {
            
            $event = new Core_Model_Event ();
            
            if (isset ($id) && $id != '') {
                $event->loadById ($id);
            }
            
            $event->setEventDescription ($event_description);
            $event->setEventTitle ($event_title);
            $event->setEventFrom ($event_from);
            $event->setEventTo ($event_to);
            $event->setEventTwCount ($event_tw_count);
            $event->setEventState ($event_state);
            
            if (isset ($id) && $id != '') {
                $event->update ();
            }
            
            
            return $this->apiControllerHelper->formatOutput(array(
                'success'               => true,
                'success_title'     => 'Event wurde erfolgreich gespeichert',
                'success_description'   => ''
            ));
        }
        catch (Exception $e) {
            echo var_dump($e);
            
            return $this->apiControllerHelper->formatOutput(array(
                'error'             => true,
                'error_title'       => 'Fehler beim Speichern des Events',
                'error_description' => ''
            ));
        }
    }   
}