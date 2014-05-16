<?php
/**
 * language entity 
 * represents the language
 *
 * @author Moser Manfred
 * 15.05.2014
 */
class Core_Model_Language extends Core_Model_Abstract {
	
	/* [PROPERTIES] */
    protected $language_code;
    
    /* [CONSTRUCT] */
    /**
	 * initializing the parent
	 */
	public function __construct() {
		parent::init();
	}
	/**
	 * getting the database tablename
	 * 
	 * @return database tablename
	 */
	public function getTableName () {
		return 'language_definition';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_Language');
	}
	
	/**
	 * Get the language code
	 */
	public function getLanguageCode() {
		return $this->language_code;
	}
	
	/**
	 * Set the language code
	 * 
	 * @param $code
	 */
	public function setLanguageCode($code) {
		$this->language_code = $code;
	}
	
	/**
	 * getting attributes of this class as array
	 *
	 * @return array with attributes
	 */
    public function getData () {
    	return $this->toArray ();
    }
    
    /* [TRANSFORMERS] */
    /**
	 * transform object to array
	 * 
	 * @return array of attributes
	 */
	public function toArray() {
		
		$data = array(
			'language_code'    	=> $this->language_code
		);
		
		$this->data = $data;
		
		return $data;
	}
	
	/**
	 * function to load all objects of the current type
	 * 
	 * @return array<Core_Model_Sentiment>
	 */
	public function loadAll () {
		
		$results = $this->_loadAll ();
		$ret 	 = array(); 
		
		foreach ($results as $result)
		{
			$lang = new Core_Model_Language();
			$lang->setValues ($result);
			$ret[] = $lang->getData();
		}
		
		return $ret;
	}
}