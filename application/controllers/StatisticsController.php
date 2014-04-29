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
	
	}
	
}