<?php
/**
 * statistics controller for this application 
 * controller for the statistics view 
 *
 * @author Andreas Ressmann
 * 30.04.2014
 */
class StatisticsController extends Core_AbstractController {
	
	/**
	 * Initialisation for the controller
	 * setting the page title
	 */
	public function init() {
	
		parent::init();
		$this->view->pageTitle = 'Twitteranalyser Map';
	}
	
	/**
	 * main action for the controller
	 */
	public function indexAction() {

    	$analysis = new Core_Model_Analysis();
    	$analysisAll = $analysis->loadAll();
    	$selectedChooseEvent = $this->_getParam('choose_event');
    	$selectedChooseFilter = $this->_getParam('choose_filter');
    	$selectedChooseAnalysis = $this->_getParam('choose_analysis');
    	$eventList[] = null;
    	$filterList[] = null;
    	$analysisList = null;
    	
    	foreach($analysisAll as $id){
    		$event = new Core_Model_Event();
    		$events = $event->loadById($id->getEventId());
    		
    		if(!in_array($events, $eventList))
    			$eventList[] = $events;
    	}
    	$eventList = array_filter($eventList);
		
		foreach($analysisAll as $id){
    		$filter = new Core_Model_Filter();
    		if ($id->getFilterId() != null)
    		{
    		$filters = $filter->loadById($id->getFilterId());
    		}
    		//var_dump ($filters);die();
    		
    		if ($filters['id'] != null)
    		{
	    		if(!in_array($filters, $filterList) && $id->getEventId() == $selectedChooseEvent && $id->getFilterId() != 0 && $id->getFilterId() != null)
	    			$filterList[] = $filter->loadById($id->getFilterId());
    		}
    	}
    	$filterList = array_filter($filterList);
		
		if(isset($selectedChooseFilter) && $selectedChooseFilter != 0 && $selectedChooseFilter != null){
			$analysisList = $analysis->loadByFilterId($selectedChooseFilter);
		}
		elseif(isset($selectedChooseEvent)) {
			$analyzesList = $analysis->loadByEventId($selectedChooseEvent);
			foreach($analyzesList as $list){
				//if($list->getFilterId() == 0 || $list->getFilterId() == null)
					$analysisList[] = $list;
			}
		}else{
			$analysisList = 0;
		}
		
		
		
		
		
        
        $this->view->events = $eventList;
        $this->view->filter = $filterList;
        $this->view->analysis = $analysisList;
        $this->view->selectedChooseEvent = $selectedChooseEvent;
        $this->view->selectedChooseFilter = $selectedChooseFilter;
        $this->view->selectedChooseAnalysis = $selectedChooseAnalysis;
	}
	
	
	
}