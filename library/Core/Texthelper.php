<?php
/**
 * core class to validate user inputs
 * 
 * @author Andreas Ressmann
 * 07.04.2014
 */
class Core_Texthelper {

	public function translate ($key) {
		return $this->getTranslationAdapter()->translate($key);
	}
	
	public function getTranslations ($tag) {
		$texts = $this->getTranslationAdapter()->getMessages();
		$ret = array ();
		
		foreach ($texts as $key => $val) {
			if (strpos($key, $tag) !== false) {
				$ret[$key] = $val;
			}
		}

		return $ret;
	}
	
	private function getTranslationAdapter () {
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
		
		return $translate->getAdapter();
	}
}