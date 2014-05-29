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
    
    public function setincludeAction () {
    	$filterId = $this->_getParam('filter_id');
    	$tweetId = $this->_getParam('tweet_id');
    	$flag = $this->_getParam('flag');
    	$ret = 0;
    	
    	$analysisIgnore = new Core_Model_AnalysisIgnore ();
    	
    	$analysisIgnore = $analysisIgnore->loadByProperties(array ('tweet_id' => $tweetId, 'filter_id' => $filterId));
    	
    	$analysisIgnore->setFilterId ($filterId);
    	$analysisIgnore->setTweetId ($tweetId);
    	
    	if ($analysisIgnore->getId() != null && $analysisIgnore->getId() != '' && $flag) {
    		$analysisIgnore->delete ($analysisIgnore->getId());
    		$ret = 1;
    	}
    	else {
    		$analysisIgnore->save();
    		$ret = 1;
    	}
    	
    	echo $ret;
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
    
    public function getlanguagesAction ()
    {
    	$language = new Core_Model_Language();
    	// read all languages and set it later to the sentiment object as language text
    	$result = $language->loadAll();
    	
    	return $this->apiControllerHelper->formatOutput($result);
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
    	$validation = array ($this->translator->translate('filter_name')  => 'filter_name:N:string',
    			$this->translator->translate('filter_tags')  => 'filter_tags:N:string',
    			$this->translator->translate('filter_from') => 'filter_from:N:date',
    			$this->translator->translate('filter_to') => 'filter_to:N:date',
    			$this->translator->translate('filter_location') => 'filter_location:N:string',
    			$this->translator->translate('filter_language') => 'filter_language:N:string');
    	 
    	$data = json_decode($_POST['data']);
    
    	$id = $data->id;
    	$filter_name = $data->filter_name;
    	$filter_tags = $data->filter_tags;
    	$filter_from = $data->filter_from;
    	$filter_to = $data->filter_to;
    	$filter_location = $data->filter_location;
    	$filter_language = $data->filter_language;
		$event_id = $data->event_id;
    	
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
    
    		$filter->setFilterName($filter_name);
    		$filter->setFilterTags($filter_tags);
    		$filter->setFilterFrom($filter_from);
    		$filter->setFilterTo($filter_to);
    		$filter->setFilterLanguage($filter_language);
    		$filter->setFilterLocation($filter_location);
			$filter->setEventId($event_id);
    		
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
    
    
     /**
     * function to save an analysis object
     * 
     *
     * @return json success message or a error message
     */
    public function saveanalysisAction () {
    	set_time_limit (300); //overwrite 30sec timeout optimizable -> persist asynchronly
    	 
    	$data = json_decode($_POST['data']);
  
    	$analysis_date = date("Y.m.d");
    	$event_id = $data->event_id;
    	$filter_id = $data->filter_id;
    	
    	$tweetEntry = new Core_Model_TweetEntry ();
    	$events = new Core_Model_Event();
    	$filterObject = new Core_Model_Filter(); // for filtering after tweets
    	$event = $events->loadAll();
		$selectedChooseEvent = $event_id;     

        $tweets = $tweetEntry->loadByEventId ($selectedChooseEvent);
		$tweets = $this->removeDeletedFromList ($tweets);
		
		// id of the selected filter object (listBox)
		$selectedChooseFilter = $filter_id; 
		// if the filter is set - and is also selected, load the right tweets
		if(isset($selectedChooseFilter) && $selectedChooseFilter != '' && $selectedChooseFilter != '0')
		{
			$currentSelectedFilter = new Core_Model_Filter();
			$currentSelectedFilter = $filterObject->loadFilterObjectById($selectedChooseFilter);
			/*
			 * select * from tweet_entry where tw_text like '%selectedChooseFilter->getFilterTags()%'
			 */
			$whereLike = array(
					'tw_text'    			=> $currentSelectedFilter->getFilterTags(),
					'tw_language'    		=> $currentSelectedFilter->getFilterLanguage(),
					'tw_location'	       	=> $currentSelectedFilter->getFilterLocation()
			);
			$whereEquals = array(
					'event_id'    			=> $currentSelectedFilter->getEventId()
			);
			$tweets = $tweetEntry->loadAllByProperties($whereLike, $whereEquals, "id");
		}		
		
        if (isset ($filter) && $filter != '')
            $tweets = $this->searchObjectList($tweets, $filter);


    	if($filter_id === '0')
    		$filter_id = null;
    
    	try {
    
    		$analysis = new Core_Model_Analysis();

    		$analysis->setAnalysisDate($analysis_date);
    		$analysis->setEventId($event_id);
    		$analysis->setFilterId($filter_id);
    		
    		$analysisId = $analysis->save();
    		
    		$tweetEntry = new Core_Model_TweetEntry();
    		$tweetEntrys = $tweetEntry->loadAll();
    		$analyseIgnoreList = Core_Listhelper::getAnalysisIgnoreList ($selectedChooseFilter);
    		
    		foreach($tweets as $entry){
    			
    			if (!in_array ($tweetEntry->getId(), $analyseIgnoreList)) {
	    			$analysisTweets = new Core_Model_AnalysisTweets();
					$tweetEntry = Core_Listhelper::getModelById($tweetEntrys, $entry->getId ());
	    			
	    			if (isset ($tweetEntry)) {    			
		    			$analysisTweets->setAnalysisId($analysisId);
		    			$analysisTweets->setTweetId($tweetEntry->getId());
		    			$analysisTweets->setValue($tweetEntry->getWeight());
		    			$analysisTweets->save();
	    			}
    			}
    		}
    		
    		return $this->apiControllerHelper->formatOutput(array(
    				'success'               => true,
    				'success_title'     => 'Analyse wurde erfolgreich gespeichert',
    				'success_description'   => ''
    		));
    	}
    	catch (Exception $e) {
    		
    		echo $e->getMessage();die();
    		
    		return $this->apiControllerHelper->formatOutput(array(
    				'error'             => true,
    				'error_title'       => 'Fehler beim Speichern der Analyse',
    				'error_description' => ''
    		));
    	}
    }
    
    /**
     * getting an sentiment by Id and transform it to a json string
     *
     * @return json string
     */
    public function getsentimentAction () {
    	$id = $this->_getParam('id');

    	$sentiment = new Core_Model_Sentiment();
    
    	if (isset ($id))
    	{
    		$sentiment = $sentiment->loadById ($id);
    		
    		if (isset ($sentiment))  {
    			return $this->apiControllerHelper->formatOutput($sentiment);
    		}
    	}
    }
    
    /**
     * Function to delete a sentiment by the given Id
     *
     * @return json success message or a error message
     */
    public function deletesentimentAction () {
    
    	$id = $this->_getParam('id');
    
    	try {
    		if (isset ($id)) {
    			$sentiment = new Core_Model_Sentiment();
    			$sentiment->delete ($id);
    		}
    		return $this->apiControllerHelper->formatOutput(array(
    				'success'               => true,
    				'success_title'     => 'Sentiment wurde erfolgreich gelöscht',
    				'success_description'   => ''
    		));
    	}
    	catch (Exception $e) {
    		
    		return $this->apiControllerHelper->formatOutput(array(
    				'error'             => true,
    				'error_title'       => 'Fehler beim Löschen des Sentiment',
    				'error_description' => ''
    		));
    	}
    }
    /**
     * function to save or update a sentiment object
     * the validation array includes the pattern for the validator to validate the
     * fields
     *
     * @return json success message or a error message
     */
    public function editsentimentAction () {

    	$validation = array ($this->translator->translate('sentiment_lang')  => 'sent_language:X:string',
    			$this->translator->translate('sentiment_word') => 'sent_word:X:string',
    			$this->translator->translate('sentiment_weight') => 'sent_weight:X:string');
    
    	$data = json_decode($_POST['data']);
    
    	$id = $data->id;
    
    	$sent_language = $data->sent_language;
    	$sent_word = $data->sent_word;
    	$sent_weight = $data->sent_weight;
    
    	try {
    
    		$sentiment = new Core_Model_Sentiment();
    
    		if (isset ($id) && $id != '') {
    			$sentiment->loadById ($id);
    		}
    
    		$validationResponse = Core_Validationhelper::validate ($validation, $data);
    
    		if ($validationResponse != null) {
    			return $this->apiControllerHelper->formatOutput(array(
    					'error'             => true,
    					'error_title'       => 'Eingabefehler',
    					'error_description' => $validationResponse
    			));
    		}
    
    		$sentiment->setSentimentLanguage($sent_language);
    		$sentiment->setSentimentWord($sent_word);
    		$sentiment->setSentimentWeight($sent_weight);
    
    		if (isset ($id) && $id != '') {
    			$sentiment->update ();
    		}
    		else {
    			$sentiment->save();
    		}
    
    		return $this->apiControllerHelper->formatOutput(array(
    				'success'               => true,
    				'success_title'     => 'Sentiment wurde erfolgreich gespeichert',
    				'success_description'   => ''
    		));
    	}
    	catch (Exception $e) {
    		return $this->apiControllerHelper->formatOutput(array(
    				'error'             => true,
    				'error_title'       => 'Fehler beim Speichern des Sentiment',
    				'error_description' => ''
    		));
    	}
    }
    
     /** Function to delete a Tweet by the given Id
	 *
	 * @return json success message or a error message
	 */
    public function deletetweetsAction () {
        
        $id = $this->_getParam('id');
  
        $id = explode(",", $id);
        
        try {
            if (isset ($id)) {
            	foreach($id as $tweet){
            		if($tweet != ""){
            			$tweetEntry = new Core_Model_TweetEntry ();
            			$tweetEntries = $tweetEntry->loadAll();
            			$tweetEntry = $this->getTweetEntryById($tweetEntries, $tweet);
                		$tweetEntry->setDeletedState ('1');
                		$tweetEntry->update();
            		}	
            	}
                
            }
            return $this->apiControllerHelper->formatOutput(array(
                'success'               => true,
                'success_title'     => 'Tweets wurden erfolgreich gelöscht',
                'success_description'   => ''
            ));
        }
        catch (Exception $e) {
            return $this->apiControllerHelper->formatOutput(array(
                'error'             => true,
                'error_title'       => 'Fehler beim Löschen der Tweets',
                'error_description' => ''
            ));
        }
    }
}
