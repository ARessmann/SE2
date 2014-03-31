<?php
/**
 * this class handle the application errors 
 *
 * @author Andreas Ressmann
 * 23.01.2014
 */
class ErrorController extends Core_AbstractController
{
	/**
	 * initialisation of the controller
	 */
	public function init() {
		parent::init();
	}

	/**
	 * main action of the controller
	 */
    public function indexAction() {
    }

	/**
	 * action to handle different types of errors
	 * if there is a log present the error will be logged
	 */
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        
        if (!$errors) {
            $this->view->message = 'You have reached the error page';
            return;
        }
        
        $e = $errors->exception;
        if(strpos($e->getMessage(), 'favicon.ico') == null) {
        	$request = '<br/>URI: ' . $_SERVER["REQUEST_URI"] . '<br/>GET: ' . var_export($_GET, true) . '<br/>POST: ' . var_export($_POST, true);
        	$this->errorHandler->registerError($e->getMessage(), $e, null, $request);	
        }
		switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
        
				// 404 error -- controller or action not found
                $this->_forward('error-not-found');
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->message = 'Application error';
				$this->view->exception = $errors->exception;
                break;
        }
        
        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $log->crit($this->view->message, $errors->exception);
        }
        
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }
        
        $this->view->request   = $errors->request;
    }
    
    /**
     * 
     * Displays an 404 Error Response
     */
    public function errorNotFoundAction() {
    	$this->getResponse()->setHttpResponseCode(404);
        $this->view->message = 'Page not found';
    }

	/**
	 * getting the Error-Log
	 */
    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }
	
	/**
	 * setting the page layout path if the user has no access
	 */
    public function noaccessAction() {
    	$this->_helper->layout->setLayoutPath(APPLICATION_PATH.'/layouts/scripts');
    }

}

