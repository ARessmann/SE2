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
    protected $event_title;
    protected $event_description;
    protected $event_from;
    protected $event_to;
    protected $event_tw_count;
    protected $event_state;
    protected $tweet_tags;
    
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
		return 'EVENT';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_Event');
	}
	
	/**
	 * Get the event description
	 */
	public function getEventDescription () {
		return $this->event_description;
	}
	
	/**
	 * Set the event description
	 * 
	 * @param $description
	 */
	public function setEventDescription ($description) {
		$this->event_description = $description;
	}
	
	/**
	 * Get the event title
	 */
	public function getEventTitle () {
		return $this->event_title;
	}
	
	/**
	 * Set the event title
	 * @param $title
	 */
	public function setEventTitle ($title) {
		$this->event_title = $title;
	}
	
	/**
	 * Get event start date (event from)
	 */
	public function getEventFrom () {
		return $this->event_from;
	}
	
	/**
	 * Set the event start date (event from)
	 * 
	 * @param $from
	 */
	public function setEventFrom ($from) {
		$this->event_from = $from;
	}
	
	/**
	 * Get the event end date (event to)
	 */
	public function getEventTo () {
		return $this->event_to;
	}
	
	/**
	 * Set the event end date (event to)
	 * 
	 * @param $to
	 */
	public function setEventTo ($to) {
		$this->event_to = $to;
	}
	
	/**
	 * Get the event tweet count
	 */
	public function getEventTwCount () {
		return $this->event_tw_count;
	}
	
	/**
	 * Set the event tweet count
	 * 
	 * @param $twCount
	 */
	public function setEventTwCount ($twCount) {
		$this->event_tw_count = $twCount;
	}
	
	/**
	 * Get the event current state
	 */
	public function getEventState () {
		return $this->event_state;
	}
	
	/**
	 * Set the event state
	 * 
	 * @param $state
	 */
	public function setEventState ($state) {
		$this->event_state = $state;
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
			'event_id'    			=> $this->id,
			'event_description'    	=> $this->event_description,
			'event_title'	       	=> $this->event_title,
			'event_from'    		=> $this->event_from,
			'event_to'    			=> $this->event_to,
			'event_tw_count'	    => $this->event_tw_count,
			'event_state'  			=> $this->event_state
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