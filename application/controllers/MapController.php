<?php
/**
 * main controller for this application 
 * in this controller all views will be handled and the user role for
 * the current user will be checked in each function 
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