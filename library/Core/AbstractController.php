<?php
/**
 * core class for all Controllers
 * 
 * @author Andreas Ressmann
 * 23.01.2014
 */
class Core_AbstractController extends Zend_Controller_Action {
	
	public $config;
    public $apiControllerHelper;
	public $errorHandler;
	public $session;
	public $version;
	public $translator;
	
	/**
	 * initialisation of the class
	 * setting default attributes like session, error, config, version, etc
	 */
	public function init() {
		
		$this->config = Zend_Registry::get('config');
		$this->errorHandler = new Core_ErrorHandler();
        $this->apiControllerHelper = new Core_ApiControllerHelper();
		$this->session = new Zend_Session_Namespace('Core');
		$this->version = Zend_Registry::get('version-app');
		$this->translator = new Core_Texthelper();
		self::setViewProperties();
	}
	
	/**
	 * setting default view properties like controller, action, version, authentication
	 */
	public function setViewProperties() {
		$this->view->controller = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
		$this->view->action = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
		$this->view->translator = $this->translator;
		$this->view->version = $this->config->app->version;
	}
    
	/**
	 * navigation menu with view and right for the menupoint
	 * 
	 * @return the navicationmenu
	 */
    public function getMenu () {
        $menuOptions = array(
            array('Veranstaltung anlegen', 'event'),
        	array('Tweets ansehen', 'tweets'),
        	array('Sentiment Analyse', 'analysis'),
        );
        
        return $menuOptions;
    }
	
	/**
	 * default messenger for the view, so display error, success, etc
	 */
	public function messenger($title, $text = '', $type = '') {
		
		if($type !== '') {
			switch ($type) {
				case 'e':
					$type = 'error';
					break;
				case 'i':
					$type = 'info';
					break;
				case 's':
					$type = 'success';
					break;
			}
		}
		
		$this->view->messenger = true;
		$this->view->messenger_title = $title;
		$this->view->messenger_text = $text;
		$this->view->messenger_type = $type;
		
	}
	
	/*
	 * default method to remove deleted elements from a list
	*/
	public function removeDeletedFromList ($objectList) {
		$res = array ();
		 
		foreach ($objectList as $object) {
			$objectData = $object->getData ();
			$keys = array_keys($objectData);
	
			foreach ($keys as $key) {
				if (strpos($key, 'deleted') !== false) {
					if ($objectData[$key] != 1) {
						$res[] = $object;
					}
				}
			}
		}
		 
		return $res;
	}
	
	/*
	 * default method to search in a objectlist
	*/
	public function searchObjectList ($objectList, $filter) {
		$res = array ();
	
		foreach ($objectList as $object) {
			$objectStr = strtolower (implode (array_values($object->getData ()), ' '));
	
			if (strpos($objectStr, $filter) !== false) {
				$res[] = $object;
			}
		}
	
		return $res;
	}
	
	/*
	 * function to add pagination to a list
	 */
	public function getPagedElements ($elements) {
		$pagination = $this->_getParam('pagination');
		
		$pagination = (!isset($pagination) || $pagination == 0) ? 1 : $pagination;
		
		$this->view->page = $pagination;
		$this->view->total = count($elements);
		
		return array_slice($elements, ($pagination - 1) * 25, 25);
	}
}