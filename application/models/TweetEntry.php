<?php
/**
 * TweetEntry entity 
 * represents the twitter tweets entries belongs to an event
 *
 * @author Moser Manfred
 * 08.04.2014
 */
class Core_Model_TweetEntry extends Core_Model_Abstract {
	
	/* [PROPERTIES] */
    protected $tw_text;
    protected $tw_creationdate;
    protected $tw_user;
    protected $tw_location;
    protected $tw_language;
    protected $tw_deleted;
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
		return 'TWEET_ENTRY';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_TweetEntry');
	}
	
	/**
	 * Get the text of the current tweet entry
	 */
	public function getTweetText() {
		return $this->tw_text;
	}
	
	/**
	 * Set the text of the current tweet entry
	 * 
	 * @param $tweetText
	 */
	public function setTweetText($tweetText) {
		$this->tw_text = $tweetText;
	}
	
	/**
	 * Get the tweet entry creation date
	 */
	public function getCreationDate () {
		return $this->tw_creationdate;
	}
	
	/**
	 * Set the tweet entry creation date
	 * 
	 * @param $creationDate
	 */
	public function setCreationDate ($creationDate) {
		$this->tw_creationdate = $creationDate;
	}
	
	/**
	 * Get the tweet entry deleted state
	 */
	public function getDeletedState () {
		return $this->tw_deleted;
	}
	
	/**
	 * Set the tweet entry deleted state
	 * 
	 * @param $newDeletedState
	 */
	public function setDeletedState ($newDeletedState) {
		$this->tw_deleted = $newDeletedState;
	}
	
	/**
	 * Get the language of the current tweet entry
	 */
	public function getLanguage () {
		return $this->tw_language;
	}
	
	/**
	 * Set the current tweet entry language
	 * 
	 * @param $language
	 */
	public function setLanguage ($language) {
		$this->tw_language = $language;
	}
	
	/**
	 * Get the current tweet entry user
	 */
	public function getTweetUser() {
		return $this->tw_user;
	}
	
	/**
	 * Set the event tweet count
	 * 
	 * @param $twCount
	 */
	public function setTweetUser ($tweetUser) {
		$this->tw_user = $tweetUser;
	}
	
	/**
	 * Get the current tweet entry location
	 */
	public function getLocation() {
		return $this->tw_location;
	}
	
	/**
	 * Set the current tweet entry location
	 * 
	 * @param $location
	 */
	public function setLocation ($location) {
		$this->tw_location = $location;
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
	public function setEventId($eventId)
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
			'id'    			=> $this->id,
			'tw_user'    		=> $this->tw_user,
			'tw_text'	       	=> $this->tw_text,
			'tw_creationdate' 	=> $this->tw_creationdate,
			'tw_location'    	=> $this->tw_location,
			'tw_language'	    => $this->tw_language,
			'tw_deleted'  		=> $this->tw_deleted,
			'event_id'			=> $this->event_id
		);
		
		$this->data = $data;
		
		return $data;
	}
	
	/**
	 * function to load all objects of the current type
	 * 
	 * @return array<Core_Model_TweetEntry>
	 */
	public function loadAll () {
		
		$results = $this->_loadAll ();
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$event = new Core_Model_TweetEntry ();
			$event->setValues ($result);
			
			$ret[] = $event;
		}
		
		return $ret;
	}
	
	/**
	 * funtion to load a object of the current type
	 * 
	 * @return Core_Model_TweetEntry 
	 */
	public function loadById ($id) {
		$values = $this->_loadById($id);
		$this->setValues ($values);
		return $this->getData();
	}
	
	/**
	 * function to save a Event
	 * 
	 * @return inserted id
	 */
	public function save () {
		$this->id = $this->_save();
		
		return $this->id;		
	}

	/**
	 * function to update a Event
	 */
	public function update() {
		$this->_update();
	}
	
	/**
	 * function to delete a Event
	 */
	public function delete ($id) {
		$this->_delete($id);
	}
	
		/**
	 * funtion to load a object of the current type
	 * 
	 * @return Core_Model_TweetEntry 
	 */
	public function loadByEventId ($id) {
		$results = $this->_loadByProperty('event_id', $id);
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$event = new Core_Model_TweetEntry ();
			$event->setValues ($result);
			
			$ret[] = $event;
		}
		
		return $ret;
	}
}