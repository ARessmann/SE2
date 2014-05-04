<?php
/**
 * this class handle all ajax calls and includes also 
 * the main api calls like event, or tweets aswo
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
     * 
     * Ajax function to retreive the descriptions for the given key
     * 
     * @param String $key name of the Dlg
     */
    public function gettranslationsAction () {
    	
    	$viewName 	= $this->_getParam('viewName');
    	
    	if (isset($viewName)) {
    		$texts = $this->translator->getTranslations($viewName);
    		
    		return $this->apiControllerHelper->formatOutput($texts);
    	}
    	
    	return $this->apiControllerHelper->formatOutput(array(
                'error'             => true,
                'error_title'       => 'Fehler beim Laden der Übersetzungen!',
                'error_description' => ''
            ));
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
    	
    	$validation = array ($this->translator->translate('event_title')  => 'event_title:X:string', 
    						 $this->translator->translate('event_from') => 'event_from:X:date', 
    						 $this->translator->translate('event_to') => 'event_to:X:date', 
    					     $this->translator->translate('event_tweet_tags') => 'event_tweet_tags:X:string', 
    						 $this->translator->translate('event_description') => 'event_description:N:string');
    	
        $data = json_decode($_POST['data']);
        
        $id = $data->id;
        
        $event_title = $data->event_title;
        $event_description = $data->event_description;
        $event_from = $data->event_from;
        $event_to = $data->event_to;
        $event_tw_count = $data->event_tw_count;
        $event_state = $data->event_state;
        $event_tweet_tags = $data->event_tweet_tags;
        
        try {
            
            $event = new Core_Model_Event ();
            
            if (isset ($id) && $id != '') {
                $event->loadById ($id);
            }
            
            $validationResponse = Core_Validationhelper::validate ($validation, $data);
            
            if ($validationResponse != null) {
            	return $this->apiControllerHelper->formatOutput(array(
            			'error'             => true,
            			'error_title'       => 'Eingabefehler',
            			'error_description' => $validationResponse
            	));
            }
            
            $event->setEventDescription ($event_description);
            $event->setEventTitle ($event_title);
            $event->setEventFrom ($event_from);
            $event->setEventTo ($event_to);
            $event->setEventTwCount ($event_tw_count);
            $event->setEventState ($event_state);
            $event->setEventTweetTags($event_tweet_tags);
            
            if (isset ($id) && $id != '') {
                $event->update ();
            }
            else {
            	$event->save();
            }
            
            return $this->apiControllerHelper->formatOutput(array(
                'success'               => true,
                'success_title'     => 'Event wurde erfolgreich gespeichert',
                'success_description'   => ''
            ));
        }
        catch (Exception $e) {
            return $this->apiControllerHelper->formatOutput(array(
                'error'             => true,
                'error_title'       => 'Fehler beim Speichern des Events',
                'error_description' => ''
            ));
        }
    }
    
    	/**
	 * getting Tweets by Event Id and transform it to a json string
	 *
	 * @return json string 
	 */
    public function gettweetsAction () {
        $id = $this->_getParam('event_id');
        
        $tweet = new Core_Model_TweetEntry ();
        
        if (isset ($id)) {
            $value = $tweet->loadByEventId ($id);
            
            if (isset ($value))  {
                return $this->apiControllerHelper->formatOutput($value);
            }
        }
    }

    /**
     * getting an Filter by Id and transform it to a json string
     *
     * @return json string
     */
    public function getfilterAction () {
    	$id = $this->_getParam('id');
    
    	$filter = new Core_Model_Filter();

    	if (isset ($id)) 
    	{
    		$value = $filter->loadById ($id);
    
    		if (isset ($value))  {
    			return $this->apiControllerHelper->formatOutput($value);
    		}
    	}
    }
    
    /**
     * Function to delete a Filter by the given Id
     *
     * @return json success message or a error message
     */
    public function deletefilterAction () {
    
    	$id = $this->_getParam('id');
    
    	try {
    		if (isset ($id)) {
    			$filter = new Core_Model_Filter();
    			$filter->delete ($id);
    		}
    		return $this->apiControllerHelper->formatOutput(array(
    				'success'               => true,
    				'success_title'     => 'Filter wurde erfolgreich gelöscht',
    				'success_description'   => ''
    		));
    	}
    	catch (Exception $e) {
    		return $this->apiControllerHelper->formatOutput(array(
    				'error'             => true,
    				'error_title'       => 'Fehler beim Löschen des Filters',
    				'error_description' => ''
    		));
    	}
    }
    
    /**
     * function to save or update a Filter object
     * the validation array includes the pattern for the validator to validate the
     * fields
     *
     * @return json success message or a error message
     */
    public function editfilterAction () {
    	$validation = array ($this->translator->translate('filter_tags')  => 'filter_tags:N:string',
    			$this->translator->translate('filter_from') => 'filter_from:X:date',
    			$this->translator->translate('filter_to') => 'filter_to:X:date',
    			$this->translator->translate('filter_location') => 'filter_location:X:string',
    			$this->translator->translate('filter_language') => 'filter_language:X:string');
    	 
    	$data = json_decode($_POST['data']);
    
    	$id = $data->id;
    	$filter_tags = $data->filter_tags;
    	$filter_from = $data->filter_from;
    	$filter_to = $data->filter_to;
    	$filter_location = $data->filter_location;
    	$filter_language = $data->filter_language;
    
    	try {
    
    		$filter = new Core_Model_Filter();

    		if (isset ($id) && $id != '') {
    			$filter->loadById ($id);
    		}
    		
    		$validationResponse = Core_Validationhelper::validate ($validation, $data);
    		
    		if ($validationResponse != null) {
    			return $this->apiControllerHelper->formatOutput(array(
    					'error'             => true,
    					'error_title'       => 'Eingabefehler',
    					'error_description' => $validationResponse
    			));
    		}
    
    		$filter->setFilterTags($filter_tags);
    		$filter->setFilterFrom($filter_from);
    		$filter->setFilterTo($filter_to);
    		$filter->setFilterLanguage($filter_language);
    		$filter->setFilterLocation($filter_location);
    		
    		if (isset ($id) && $id != '') {
    			$filter->update();
    		}
    		else {
    			$filter->save();
    		}
    
    		return $this->apiControllerHelper->formatOutput(array(
    				'success'               => true,
    				'success_title'     => 'Filter wurde erfolgreich gespeichert',
    				'success_description'   => ''
    		));
    	}
    	catch (Exception $e) {
    		
    		echo $e->getMessage();die();
    		
    		return $this->apiControllerHelper->formatOutput(array(
    				'error'             => true,
    				'error_title'       => 'Fehler beim Speichern des Filters',
    				'error_description' => ''
    		));
    	}
    }
}