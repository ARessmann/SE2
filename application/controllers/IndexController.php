<?php
/**
 * main controller for this application 
 *
 * @author Andreas Ressmann
 * 31.03.2014
 */
class IndexController extends Core_AbstractController {
	
	/**
	 * Initialisation for the controller
	 * setting the page title
	 */
	public function init() {
		
		parent::init();
		$this->view->pageTitle = 'Twitteranalyser';
		$this->view->lang = $this->session->lang;

	}
    
	/**
	 * main action for the controller 
	 */
    public function indexAction() {
        
        $menuOptions = $this->getMenu ();
        
        $firstPoint = null;
        
		foreach($menuOptions as $m) {
        	if($this->session->auth_role == $m[2]) {
            	$firstPoint = 'index/' . $m[1];
                break;
			}
		}
        
        if (isset ($firstPoint)) {
            $this->_redirect($firstPoint);
        }
        
        $this->view->menuOptions = $menuOptions;
    }
    
	/**
	 * display the list of events including a filter system 
	 * and set the object to the view 
	 */
    public function eventAction () {
    	$event = new Core_Model_Event ();
        $filter = $this->_getParam('filter');
        
        $events = $event->loadAll ();
        
        if (isset ($filter) && $filter != '')
            $events = $this->searchObjectList($events, $filter);
        
        $this->view->filter = $filter;
        $this->view->counter = count($events);
        $this->view->menuOptions = $this->getMenu ();
        
        $this->view->events = $this->getPagedElements($events);
    }
    
	/**
	 * display the list of tweets including a filter system 
	 * and set the object to the view 
	 */    
     public function tweetsAction () {
    	$tweetEntry = new Core_Model_TweetEntry ();
    	$events = new Core_Model_Event();
    	$filterObject = new Core_Model_Filter(); // for filtering after tweets
    	$event = $events->loadAll();
        $filter = $this->_getParam('filter');
		$selectedChooseEvent = $this->_getParam('choose_event');     

        $tweets = $tweetEntry->loadByEventId ($selectedChooseEvent);
		$tweets = $this->removeDeletedFromList ($tweets);
		
		$filters = null; // all filterObjects from the selected Event
		if($selectedChooseEvent != null && $selectedChooseEvent != '0')
			$filters = $filterObject->loadByEventId($selectedChooseEvent);
		
		// id of the selected filter object (listBox)
		$selectedChooseFilter = $this->_getParam('choose_filter'); 
		// if the filter is set - and is also selected, load the right tweets
		if(isset($selectedChooseFilter) && $selectedChooseFilter != '' && $selectedChooseFilter != '0' && $selectedChooseEvent != '0')
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

        $this->view->filter = $filter;
        $this->view->counter = count($tweets);
        $this->view->menuOptions = $this->getMenu ();
        $this->view->events = $event;
        $this->view->filterObject = $filters;
        
        $this->view->selectedChooseEvent = $selectedChooseEvent;
       	$this->view->selectedChooseFilter = $selectedChooseFilter;
       	
       	$this->view->tweets = $this->getPagedElements($tweets);
    }
    
    public function analysisAction () {
    	$tweetEntry = new Core_Model_TweetEntry ();
    	$events = new Core_Model_Event();
    	$event = $events->loadAll();
        $filter = $this->_getParam('filter');
		$selectedChooseEvent = $this->_getParam('choose_event'); 

        $tweets = $tweetEntry->loadByEventId ($selectedChooseEvent);
		$tweets = $this->removeDeletedFromList ($tweets);
        
        if (isset ($filter) && $filter != '')
            $tweets = $this->searchObjectList($tweets, $filter);

        $this->view->filter = $filter;
        $this->view->counter = count($tweets);
        $this->view->menuOptions = $this->getMenu ();
        $this->view->events = $event;
        
        $this->view->selectedChooseEvent = $selectedChooseEvent;
        
        $this->view->tweets = $this->getPagedElements($tweets);
    }
}