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
        $this->view->events = $events;
        $this->view->menuOptions = $this->getMenu ();
    }
    
/**
	 * display the list of tweets including a filter system 
	 * and set the object to the view 
	 */    
     public function tweetsAction () {
    	$tweetEntry = new Core_Model_TweetEntry ();
    	$events = new Core_Model_Event();
    	$event = $events->loadAll();
        $filter = $this->_getParam('filter');

        $tweets = $tweetEntry->loadAll ();

        if (isset ($filter) && $filter != '')
            $tweets = $this->searchObjectList($tweets, $filter);

        $this->view->filter = $filter;
        $this->view->counter = count($tweets);
        $this->view->tweets = $tweets;
        $this->view->menuOptions = $this->getMenu ();
        $this->view->events = $event;
    }
    
    /*
     * default method to search in a objectlist
     */
    private function searchObjectList ($objectList, $filter) {
        $res = array ();
        
        foreach ($objectList as $object) {
            $objectStr = strtolower (implode (array_values( ($object->getData ())), ' '));
            
            if (strpos($objectStr, $filter) !== false) {
                $res[] = $object;
            }
        }
        
        return $res;
    }
    
}