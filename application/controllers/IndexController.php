<?php
/**
 * main controller for this application 
 * in this controller all views will be handled and the user role for
 * the current user will be checked in each function 
 *
 * @author Julius Wukoutz
 * 23.01.2014
 */
class IndexController extends Core_AbstractController {
	
	/**
	 * Initialisation for the controller
	 * setting the page title
	 */
	public function init() {
		
		parent::init();
		$this->view->pageTitle = 'Creditserver';
	}
    
	/**
	 * main action for the controller 
	 * handling the manu options and checking the current user role
	 */
    public function indexAction() {
        
        $menuOptions = $this->getMenu ();
        
        $firstPoint = null;
        
        if($this->session->auth_role !== Core_Plugin_Acl::ROLE_GUEST) {
            foreach($menuOptions as $m) {
                if($this->session->auth_role == $m[2]) {
                    $firstPoint = 'index/' . $m[1];
                    break;
                }
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
    public function accountmanagersAction () {
        
        if ($this->session->auth_role != Core_Plugin_Acl::ROLE_ADMIN) {
            $this->messenger('Sie haben kein Recht diese Ansicht zu öffnen!', 'e');
            $this->_redirect('index/index');
        }
        
    	$accountmanager = new Core_Model_AccountManager ();
        $filter = $this->_getParam('filter');
        
        $accountmanagers = $accountmanager->loadAll ();
        
        if (isset ($filter) && $filter != '')
            $accountmanagers = $this->searchObjectList($accountmanagers, $filter);
        
        $this->view->filter = $filter;
        $this->view->counter = count($accountmanagers);
        $this->view->accountmanagers = $accountmanagers;
        $this->view->menuOptions = $this->getMenu ();
    }
    
	/**
	 * showing for a given customer all informations like the amount 
	 * or all transactions  
	 */
    public function amountAction () {
        if ($this->session->auth_role != Core_Plugin_Acl::ROLE_CUSTOMER) {
            $this->messenger('Sie haben kein Recht diese Ansicht zu öffnen!', 'e');
            $this->_redirect('index/index');
        }
        
        $id = $this->session->auth->getId ();
        
        $transaction = new Core_Model_Transaction ();
        $customer    = new Core_Model_Customer ();
        
        $customer->loadById ($id);
        
        $userTransactions = array ();
        $transactions = $transaction->loadAll ();
        
        foreach ($transactions as $transaction) {
            if ($id == $transaction->getTargetId ()) {
                $userTransactions[] = $transaction;
            }
        }
        
        $this->view->amount = $customer->getAmount ();
        $this->view->counter = count ($transactions);
        $this->view->transactions = $userTransactions;
    }
    
	/**
	 * display all customers with filter handling
	 * setting the objects to the view
	 */
    public function customerAction () {
        if ($this->session->auth_role != Core_Plugin_Acl::ROLE_ACCOUNT_MANAGER) {
            $this->messenger('Sie haben kein Recht diese Ansicht zu öffnen!', 'e');
            $this->_redirect('index/index');
        }
        
        $customer = new Core_Model_Customer ();
        $filter = $this->_getParam('filter');
        
        $customers = $customer->loadAll ();
        
        if (isset ($filter) && $filter != '')
            $customers = $this->searchObjectList($customers, $filter);
        
        $this->view->filter = $filter;
        $this->view->counter = count($customers);
        $this->view->customers = $customers;
        $this->view->menuOptions = $this->getMenu ();
    }
    
	/**
	 * display all customers for showing the amount of each one
	 */
    public function amountoverviewAction () {
        if ($this->session->auth_role != Core_Plugin_Acl::ROLE_ACCOUNT_MANAGER) {
            $this->messenger('Sie haben kein Recht diese Ansicht zu öffnen!', 'e');
            $this->_redirect('index/index');
        }
        
        $customer = new Core_Model_Customer ();
        
        $this->view->counter = $customer->_count ();
        $this->view->customers = $customer->loadAll ();
        $this->view->menuOptions = $this->getMenu ();
    }
    
	/**
	 * display all customers to book a new amount to the customer
	 */
    public function bookamountAction () {
        if ($this->session->auth_role != Core_Plugin_Acl::ROLE_ACCOUNT_MANAGER) {
            $this->messenger('Sie haben kein Recht diese Ansicht zu öffnen!', 'e');
            $this->_redirect('index/index');
        }
        
        $customer = new Core_Model_Customer ();
        
        $this->view->counter = $customer->_count ();
        $this->view->customers = $customer->loadAll ();
        $this->view->menuOptions = $this->getMenu ();
    }
    
	/**
	 * display the full list of transactions
	 */
    public function transactionAction () {
        if ($this->session->auth_role != Core_Plugin_Acl::ROLE_ACCOUNT_MANAGER) {
            $this->messenger('Sie haben kein Recht diese Ansicht zu öffnen!', 'e');
            $this->_redirect('index/index');
        }
        
        $transaction = new Core_Model_Transaction ();
        
        $this->view->transactions = $transaction->loadAll ();
        $this->view->menuOptions = $this->getMenu ();
    }
    
	/**
	 * display all devices by using a filter
	 * setting the objects to the view
	 */
    public function devicesAction () {
        if ($this->session->auth_role != Core_Plugin_Acl::ROLE_ADMIN) {
            $this->messenger('Sie haben kein Recht diese Ansicht zu öffnen!', 'e');
            $this->_redirect('index/index');
        }
        
        $device = new Core_Model_Device ();
        $filter = $this->_getParam('filter');
        
        $devices = $device->loadAll ();
        
        if (isset ($filter) && $filter != '')
            $devices = $this->searchObjectList($devices, $filter);
        
        $this->view->filter = $filter;
        $this->view->counter = count($devices);
        $this->view->devices = $devices;
        $this->view->menuOptions = $this->getMenu ();
    }
    
	/**
	 * function to use the filter that function 
	 * searches in objects transformed to a string
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