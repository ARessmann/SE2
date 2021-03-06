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
    protected $tw_weight;
    protected $event_id;
    protected $tw_longitude;
    protected $tw_latitude;
    
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
		return 'tweet_entry';
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
	 * Get the current tweet entry weight
	 */
	public function getWeight() {
		return $this->tw_weight;
	}
	
	/**
	 * Set the current tweet entry weight
	 * 
	 * @param $location
	 */
	public function setWeight ($weight) {
		$this->tw_weight = $weight;
	}
	
	
			/**
	 * Get the current tweet entry longitude
	 */
	public function getLongitude() {
		return $this->tw_longitude;
	}
	
	/**
	 * Set the current tweet entry longitude
	 * 
	 * @param $location
	 */
	public function setLongitude ($longitude) {
		$this->tw_longitude = $longitude;
	}
	
	
				/**
	 * Get the current tweet entry latitude
	 */
	public function getLatitude() {
		return $this->tw_latitude;
	}
	
	/**
	 * Set the current tweet entry latitude
	 * 
	 * @param $location
	 */
	public function setLatitude ($latitude) {
		$this->tw_latitude = $latitude;
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
			'tw_weight'			=> $this->tw_weight,
			'event_id'			=> $this->event_id,
			'tw_longitude'		=> $this->tw_longitude,
			'tw_latitude'		=> $this->tw_latitude
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
		$entry = new Core_Model_TweetEntry ();
		$entry->setValues ($values);
		return $entry;
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
	
	/**
	 * Load all tweets by given properties
	 * TODO This must be changed to handle a set of where conditions
	 */
	public function loadAllByProperties ($propertyLike, $propertyEqual, $id)
	{
		$results = $this->_loadAllByProperties($propertyLike, $propertyEqual, $id);
		$ret 	 = array ();
	
		foreach ($results as $result)
		{
			$tw = new Core_Model_TweetEntry ();
			$tw->setValues ($result);
				
			$ret[] = $tw;
		}
	
		return $ret;
	}
	

	
	
	
	
}