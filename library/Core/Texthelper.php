<?php
/**
 * core class to validate user inputs
 * 
 * @author Andreas Ressmann
 * 07.04.2014
 */
class Core_Texthelper {

	public function translate ($key) {
		
		$session = new Zend_Session_Namespace('Core');
		$lang = $session->lang;
		
		if (!isset($lang)) { 
			$lang = 'de';
		}
		
		$translate = new Zend_Translate(
				array(
						'adapter' => 'csv',
						'content' => APPLICATION_PATH.'/languages/' . $lang . '/',
						'locale'  => $lang
				)
		);
		
		return $translate->getAdapter()->translate($key);
	}
}