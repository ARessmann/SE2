<?php
/**
 * Filter entity 
 * represents the Filter for tweets with its attributes
 *
 * @author Johannes Kammel
 * 01.05.2014
 */
class Core_Model_Filter extends Core_Model_Abstract {
	
	/* [PROPERTIES] */
    protected $filter_name;
    protected $filter_tags;
    protected $filter_location;
    protected $filter_language;
    protected $event_id;
    
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
		return 'filter';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_Filter');
	}
	
	/**
	 *  * Get the filter name
	 */
	public function getFilterName () {
		return $this->filter_name;
	}
	
	/**
	 * Set the filter name
	 * 
	 * @param $tags
	 */
	public function setFilterName ($name) {
		$this->filter_name = $name;
	}
	
	/**
	 * Get the filter tags
	 */
	public function getFilterTags () {
		return $this->filter_tags;
	}
	
	/**
	 * Set the filter tags
	 * 
	 * @param $tags
	 */
	public function setFilterTags ($tags) {
		$this->filter_tags = $tags;
	}
	
	/**
	 * Get the filter location
	 */
	public function getFilterLocation () {
		return $this->filter_location;
	}
	
	/**
	 * Set the filter location
	 * 
	 * @param $location
	 */
	public function setFilterLocation ($location) {
		$this->filter_location = $location;
	}
	
	/**
	 * Get the filter language
	 */
	public function getFilterLanguage () {
		return $this->filter_language;
	}
	
	/**
	 * Set the filter language
	 * 
	 * @param $lang
	 */
	public function setFilterLanguage ($lang) {
		$this->filter_language = $lang;
	}
	
	/**
	 * Get the linked (parent) event identifier
	 */
	public function getEventId()
	{
		return $this->event_id;
	}
	
	/**
	 * Set the linked event identifier
	 * 
	 * @param $eventId
	 */
	public function setEventId($event_id)
	{
		$this->event_id = $event_id;
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
			'id'    				=> $this->id,
			'filter_name'    		=> $this->filter_name,
			'filter_tags'    		=> $this->filter_tags,
			'filter_location'    	=> $this->filter_location,
			'filter_language'	    => $this->filter_language,
			'event_id'  			=> $this->event_id,
		);
		
		$this->data = $data;
		
		return $data;
	}
	
	/**
	 * function to load all objects of the current type
	 * 
	 * @return array<Core_Model_Filter>
	 */
	public function loadAll () {
		
		$results = $this->_loadAll ();
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$filter = new Core_Model_Filter ();
			$filter->setValues ($result);
			
			$ret[] = $filter;
		}
		
		return $ret;
	}
	
	/**
	 * funtion to load a object of the current type
	 * 
	 * @return Core_Model_Filter 
	 */
	public function loadById ($id) {
		$values = $this->_loadById($id);
		$this->setValues ($values);
		return $this->getData();
	}
	
	/**
	 * function to save a Filter
	 * 
	 * @return inserted id
	 */
	public function save () {
		$this->id = $this->_save();
		
		return $this->id;		
	}

	/**
	 * function to update a Filter
	 */
	public function update() {
		$this->_update();
	}
	
	/**
	 * function to delete a Filter
	 */
	public function delete ($id) {
		$this->_delete($id);
	}
	
	/**
	 * funtion to load a object of the current type by parent ID
	 * 
	 * @return Core_Model_Filter 
	 */
	public function loadByEventId ($id) {
		$results = $this->_loadByProperty('event_id', $id);
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$filter = new Core_Model_Filter ();
			$filter->setValues ($result);
			
			$ret[] = $filter;
		}
		
		return $ret;
	}
	
	/**
	 * Load a filter object by an object id - return the real filter object
	 * 
	 * @param unknown $id
	 * @return Core_Model_Filter
	 */
	public function loadFilterObjectById ($id)
	{
		$results = $this->_loadByProperty('id', $id);
		$filter = new Core_Model_Filter ();
	
		foreach ($results as $result)
		{
			$filter->setValues ($result);
		}
	
		return $filter;
	}
}