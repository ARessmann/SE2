<?php
/**
 * Event entity 
 * represents the Event with his attributes
 *
 * @author Andreas Ressmann
 * 31.03.2014
 */
class Core_Model_Event extends Core_Model_Abstract {
	

	/* [PROPERTIES] */
    protected $date_from;
    protected $date_to;
    protected $description;
    protected $title;
    
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
		return 'event';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_Event');
	}
	
	public function getDateFrom () {
		return $this->date_from;
	}
	
	public function setDateFrom ($date) {
		$this->date_from = $date;
	}
	
	public function getDateTo () {
		return $this->date_to;
	}
	
	public function setDateTo ($date) {
		$this->date_to = $date;
	}
	
	public function getDescription () {
		return $this->description;
	}
	
	public function setDescription ($description) {
		$this->description = $description;
	}
	
	public function getTitle () {
		return $this->title;
	}
	
	public function setTitle ($title) {
		$this->title = $title;
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
			'id' 	    			=> $this->id,
            'date_from'	    		=> $this->date_from,
			'date_to'	    		=> $this->date_to,
			'description'	    	=> $this->description,
			'title'	    	    	=> $this->title,
		);
		
		$this->data = $data;
		
		return $data;
	}
	
	/**
	 * function to load all objects of the current type
	 * 
	 * @return array<Auth>
	 */
	public function loadAll () {
		
		$results = $this->_loadAll ();
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$auth = new Core_Model_Event ();
			$auth->setValues ($result);
			
			$ret[] = $auth;
		}
		
		return $ret;
	}
	
	/**
	 * funtion to load a object of the current type
	 * 
	 * @return Auth 
	 */
	public function loadById ($id) {
		$values = $this->_loadById($id);
		$this->setValues ($values);

		return $values;
	}
	
	/**
	 * function to save a Auth
	 * 
	 * @return inserted id
	 */
	public function save () {
		$this->id = $this->_save();
		
		return $this->id;		
	}

	/**
	 * function to update a Auth
	 */
	public function update() {
		$this->_update();
	}
	
	/**
	 * function to delete a Auth
	 */
	public function delete ($id) {
		$this->_delete($id);
	}
}