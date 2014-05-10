<?php
/**
 * Analysis entity 
 * represents the Analysis with its attributes
 *
 * @author Johannes Kammel
 * 01.05.2014
 */
class Core_Model_Analysis extends Core_Model_Abstract {
	
	/* [PROPERTIES] */
    protected $analysis_date;
    protected $event_id;
    protected $filter_id;
    
    
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
		return 'analysis';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_Analysis');
	}
	
	/**
	 * Get the analysis date
	 */
	public function getAnalysisDate () {
		return $this->analysis_date;
	}
	
	/**
	 * Set the analysis date
	 * 
	 * @param $date
	 */
	public function setAnalysisDate ($analysis_date) {
		$this->analysis_date = $analysis_date;
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
	 * @param $event_id
	 */
	public function setEventId($event_id)
	{
		$this->event_id = $event_id;
	}
	
	/**
	* Get the linked (parent) filter identifier
	*/
	public function getFilterId()
	{
		return $this->filter_id;
	}
	
	/**
	 * Set the linked filter identifier
	 * 
	 * @param $filter_id
	 */
	public function setFilterId($filter_id)
	{
		$this->filter_id = $filter_id;
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
			'analysis_date'    		=> $this->analysis_date,
			'event_id'	       		=> $this->event_id,
			'filter_id'    			=> $this->filter_id
		);
		
		$this->data = $data;
		
		return $data;
	}
	
	/**
	 * function to load all objects of the current type
	 * 
	 * @return array<Core_Model_Analysis>
	 */
	public function loadAll () {
		
		$results = $this->_loadAll ();
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$analysis = new Core_Model_Analysis ();
			$analysis->setValues ($result);
			
			$ret[] = $analysis;
		}
		
		return $ret;
	}
	
	/**
	 * funtion to load a object of the current type
	 * 
	 * @return Core_Model_Analysis 
	 */
	public function loadById ($id) {
		$values = $this->_loadById($id);
		$this->setValues ($values);
		return $this->getData();
	}
	
	/**
	 * function to save a Analysis
	 * 
	 * @return inserted id
	 */
	public function save () {
		$this->id = $this->_save();
		
		return $this->id;		
	}

	/**
	 * function to update a Analysis
	 */
	public function update() {
		$this->_update();
	}
	
	/**
	 * function to delete a Analysis
	 */
	public function delete ($id) {
		$this->_delete($id);
	}
	
	/**
	 * funtion to load a object of the current type by parent event ID
	 * 
	 * @return Core_Model_Analysis 
	 */
	public function loadByEventId ($id) {
		$results = $this->_loadByProperty('event_id', $id);
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$analysis = new Core_Model_Analysis ();
			$analysis->setValues ($result);
			
			$ret[] = $analysis;
		}
		
		return $ret;
	}
	
		/**
	 * funtion to load a object of the current type by parent filter ID
	 * 
	 * @return Core_Model_Analysis 
	 */
	public function loadByFilterId ($id) {
		$results = $this->_loadByProperty('filter_id', $id);
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$analysis = new Core_Model_Analysis ();
			$analysis->setValues ($result);
			
			$ret[] = $analysis;
		}
		
		return $ret;
	}
	
	/**
	 * Load a filter object by an object id - return the real analysis object
	 * 
	 * @param unknown $id
	 * @return Core_Model_Analysis
	 */
	public function loadFilterObjectById ($id)
	{
		$results = $this->_loadByProperty('id', $id);
		$analysis = new Core_Model_Analysis ();
	
		foreach ($results as $result)
		{
			$analysis->setValues ($result);
		}
	
		return $analysis;
	}
}