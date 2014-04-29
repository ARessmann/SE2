<?php
/**
 * map controller for this application 
 * controller for the map view 
 *
 * @author Andreas Ressmann
 * 31.03.2014
 */
class MapController extends Core_AbstractController {
	
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