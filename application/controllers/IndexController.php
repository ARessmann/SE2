<?php
/**
 * main controller for this application 
 * in this controller all views will be handled and the user role for
 * the current user will be checked in each function 
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
	}
    
	/**
	 * main action for the controller 
	 * handling the manu options and checking the current user role
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
        
        $this->view->menuOptions = $this->getMenu ();
    }
    
	/**
	 * display the list of accountmanagers including a filter system 
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
        $this->view->accountmanagers = $events;
        $this->view->menuOptions = $this->getMenu ();
    }
    
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