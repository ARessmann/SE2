<?php
/**
 * Anaylsis Ignore
 * save Tweets that will not be analysed
 *
 * @author Andreas Ressmann
 * 27.05.2014
 */
class Core_Model_AnalysisIgnore extends Core_Model_Abstract {
	
	/* [PROPERTIES] */
    protected $filter_id;
    protected $tweet_id;
    
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
		return 'analysis_ignore';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_AnalysisIgnore');
	}
	
	/**
	 * Get the FilterId
	 */
	public function getFilterId () {
		return $this->filter_id;
	}
	
	/**
	 * Set the FilterId
	 * 
	 * @param $filterId
	 */
	public function setFilterId ($filterId) {
		$this->filter_id = $filterId;
	}
	
	/**
	 * Get the TweetId
	 */
	public function getTweetId () {
		return $this->tweet_id;
	}
	
	/**
	 * Set the TweetId
	 * 
	 * @param $tweetId
	 */
	public function setTweetId ($tweetId) {
		$this->tweet_id = $tweetId;
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
			'id'    		=> $this->id,
			'filter_id'    	=> $this->filter_id,
			'tweet_id'	    => $this->tweet_id
		);
		
		$this->data = $data;
		
		return $data;
	}
	
	/**
	 * function to load all objects of the current type
	 * 
	 * @return array<Core_Model_Event>
	 */
	public function loadAll () {
		
		$results = $this->_loadAll ();
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$obj = new Core_Model_AnalysisIgnore ();
			$obj->setValues ($result);
			
			$ret[] = $obj;
		}
		
		return $ret;
	}
	
	/**
	 * funtion to load a object of the current type
	 * 
	 * @return Core_Model_AnalysisIgnore 
	 */
	public function loadById ($id) {
		$values = $this->_loadById($id);
		$this->setValues ($values);
		return $this->getData();
	}
	
	/**
	 * function to load Analysis Ignore by Properties
	 * 
	 * @param unknown_type $properties
	 */
	public function loadByProperties ($properties) {
		$values = $this->_loadByIdProperties($properties);
		$this->setValues ($values);
		return $this;
	}
	
	/**
	 * function to save a Core_Model_AnalysisIgnore
	 * 
	 * @return inserted id
	 */
	public function save () {
		$this->id = $this->_save();
		
		return $this->id;		
	}

	/**
	 * function to update a Core_Model_AnalysisIgnore
	 */
	public function update() {
		$this->_update();
	}
	
	/**
	 * function to delete a Core_Model_AnalysisIgnore
	 */
	public function delete ($id) {
		$this->_delete($id);
	}
}