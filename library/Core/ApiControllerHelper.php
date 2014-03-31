<?php
/**
 * core class for the Api Controller
 * 
 * @author Andreas Ressmann
 * 23.01.2014
 */
class Core_ApiControllerHelper {
	
	private $config;
	private $outputType;
	private $session;
	
	/**
	 * initializing the helper 
	 * setting outputtype session, user, etc
	 */
	public function __construct() {
		
		$this->config = Zend_Registry::get('config');
		$this->outputType = 'json';
		$this->session = new Zend_Session_Namespace('Core');
	}
	
	/**
	 * @return Returns the result as the given type (now just json is supported)
	 */
	public function formatOutput($input) {
		
		if($this->outputType == 'json') {
			$retVal = json_encode($input);
		}

		echo $retVal;
	}
	
	/**
	 * setting the outputtype of the controller
	 */
	public function setOutputType($outputType) {
		if($outputType == 'json')
			$this->outputType = $outputType;
	}
	
}