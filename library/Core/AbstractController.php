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
	public $mailer;
	public $session;
	public $version;
	
	/**
	 * initialisation of the class
	 * setting default attributes like session, error, config, version, etc
	 * 
	 * redirechting to authentication if the currentuser is guest
	 */
	public function init() {
		
		$this->config = Zend_Registry::get('config');
		$this->errorHandler = new Core_ErrorHandler();
        $this->apiControllerHelper = new Core_ApiControllerHelper();
		$this->mailer = new Core_Mailer();
		$this->session = new Zend_Session_Namespace('Core');
		$this->version = Zend_Registry::get('version-app');
		self::setViewProperties();
		
		if($this->authRole() == Core_Plugin_Acl::ROLE_GUEST 
			&& (Zend_Controller_Front::getInstance()->getRequest()->getControllerName() != 'auth' )
				&& Zend_Controller_Front::getInstance()->getRequest()->getControllerName() != 'assets'
                && Zend_Controller_Front::getInstance()->getRequest()->getControllerName() != 'api') {
				$this->_redirect('/auth');
			}
	}
	
	/**
	 * setting default view properties like controller, action, version, authentication
	 */
	public function setViewProperties() {
		$this->view->controller = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
		$this->view->action = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
		$this->view->version = $this->config->app->version;
		self::setAuthProperties();
	}
    
	/**
	 * navigation menu with view and right for the menupoint
	 * 
	 * @return the navicationmenu
	 */
    public function getMenu () {
        $menuOptions = array(
            array('Guthaben', 'amount', 2),
            array('Transaktionen', 'transactions', 2),
            
            //no menupoints for device 3

            array('Endkunden anlegen', 'customer', 4),
            array('Guthabenübersicht', 'amountoverview', 4),
            array('Guthaben aufbuchen', 'bookamount', 4),
            array('Transaktionen', 'transaction', 4),
            
            array('Kundenbetreuer anlegen', 'accountmanagers', 5),
            array('Endgeräte anlegen', 'devices', 5),
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
	
	/**
	 * @return current authentication
	 */
	public function auth() {
		return $this->session->auth;
	}
	
	/**
	 * @return current authentication role
	 */
	public function authRole($role = null) {
		
		if($this->session->auth_role == null)
			$this->session->auth_role = Core_Plugin_Acl::ROLE_GUEST;
		
		if($role !== null)
			$this->session->auth_role = $role;
			
		return $this->session->auth_role;
	}
	
	/**
	 * setting authentication informations for the view
	 */
	private function setAuthProperties() {
		
		if($this->auth() != null) {
			$this->view->auth = $this->auth();
			$this->view->authName = $this->auth() != null ? $this->auth()->getIdentity() : '';
			
		}
		$this->view->authRole = $this->authRole();
	}
}