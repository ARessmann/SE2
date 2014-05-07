<?php
/**
 * AnalysisTweets entity 
 * represents the tweets of an analysis with its attributes
 *
 * @author Johannes Kammel
 * 01.05.2014
 */
class Core_Model_AnalysisTweets extends Core_Model_Abstract {
	
	/* [PROPERTIES] */
    protected $analysis_id;
    protected $tweet_id;
    protected $value;
    
    
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
		return 'analysis_tweets';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_AnalysisTweets');
	}
	
	/**
	 * Get the linked (parent) analysis identifier
	 */
	public function getAnalysisId () {
		return $this->analysis_id;
	}
	
	/**
	 * Set the linked analysis identifier
	 * 
	 * @param $analysis_id
	 */
	public function setAnalysisId ($analysis_id) {
		$this->analysis_id = $analysis_id;
	}
	
	
	/**
	 * Get the linked (parent) tweet identifier
	 */
	public function getTweetId()
	{
		return $this->tweet_id;
	}
	
	/**
	 * Set the linked tweet identifier
	 * 
	 * @param $tweet_id
	 */
	public function setTweetId($tweet_id)
	{
		$this->tweet_id = $tweet_id;
	}
	
	/**
	* Get the value of a tweet
	*/
	public function getValue()
	{
		return $this->value;
	}
	
	/**
	 * Set the value of a tweet
	 * 
	 * @param $value
	 */
	public function setFilterId($value)
	{
		$this->value = $value;
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
			'analysis_id'    		=> $this->analysis_id,
			'tweet_id'	       		=> $this->tweet_id,
			'value'    				=> $this->value,
		);
		
		$this->data = $data;
		
		return $data;
	}
	
	/**
	 * function to load all objects of the current type
	 * 
	 * @return array<Core_Model_AnalysisTweets>
	 */
	public function loadAll () {
		
		$results = $this->_loadAll ();
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$analysisTweets = new Core_Model_AnalysisTweets ();
			$analysisTweets->setValues ($result);
			
			$ret[] = $analysisTweets;
		}
		
		return $ret;
	}
	
	/**
	 * funtion to load a object of the current type
	 * 
	 * @return Core_Model_AnalysisTweets 
	 */
	public function loadById ($id) {
		$values = $this->_loadById($id);
		$this->setValues ($values);
		return $this->getData();
	}
	
	/**
	 * function to save a AnalysisTweets
	 * 
	 * @return inserted id
	 */
	public function save () {
		$this->id = $this->_save();
		
		return $this->id;		
	}

	/**
	 * function to update a AnalysisTweets
	 */
	public function update() {
		$this->_update();
	}
	
	/**
	 * function to delete a AnalysisTweets
	 */
	public function delete ($id) {
		$this->_delete($id);
	}
	
	/**
	 * funtion to load a object of the current type by parent analysis ID
	 * 
	 * @return Core_Model_AnalysisTweets 
	 */
	public function loadByEventId ($id) {
		$results = $this->_loadByProperty('analysis_id', $id);
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$analysisTweets = new Core_Model_AnalysisTweets ();
			$analysisTweets->setValues ($result);
			
			$ret[] = $analysisTweets;
		}
		
		return $ret;
	}
	
		/**
	 * funtion to load a object of the current type by parent tweet ID
	 * 
	 * @return Core_Model_AnalysisTweets 
	 */
	public function loadByFilterId ($id) {
		$results = $this->_loadByProperty('tweet_id', $id);
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$analysisTweets = new Core_Model_AnalysisTweets ();
			$analysisTweets->setValues ($result);
			
			$ret[] = $analysisTweets;
		}
		
		return $ret;
	}
	
	/**
	 * Load a filter object by an object id - return the real analysisTweets object
	 * 
	 * @param unknown $id
	 * @return Core_Model_AnalysisTweets
	 */
	public function loadFilterObjectById ($id)
	{
		$results = $this->_loadByProperty('id', $id);
		$analysisTweets = new Core_Model_AnalysisTweets ();
	
		foreach ($results as $result)
		{
			$analysisTweets->setValues ($result);
		}
	
		return $analysisTweets;
	}
}