<?php
/**
 * Sentiment entity 
 * represents the sentiment word
 *
 * @author Moser Manfred
 * 14.05.2014
 */
class Core_Model_Sentiment extends Core_Model_Abstract {
	
	/* [PROPERTIES] */
    protected $sent_language;
    protected $sent_word;
    protected $sent_weight;
    protected $sent_langTxt;
    
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
		return 'sentiment_definition';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_Sentiment');
	}
	
	/**
	 * Get the sentiment language
	 */
	public function getSentimentLanguage() {
		return $this->sent_language;
	}
	
	/**
	 * Set the sentiment language
	 * 
	 * @param $language
	 */
	public function setSentimentLanguage($language) {
		$this->sent_language = $language;
	}
	
	/**
	 * Get the sentiment word
	 */
	public function getSentimentWord() {
		return $this->sent_word;
	}
	
	/**
	 * Set the sentiment word
	 * @param $word
	 */
	public function setSentimentWord($word) {
		$this->sent_word = $word;
	}
	
	/**
	 * Get sentiment weight
	 */
	public function getSentimentWeight() {
		return $this->sent_weight;
	}
	
	/**
	 * Set the sentiment weight
	 * 
	 * @param $weight
	 */
	public function setSentimentWeight($weight) {
		$this->sent_weight = $weight;
	}
	
	/**
	 * Get sentiment weight
	 */
	public function getLangTxt() {
		return $this->sent_langTxt;
	}
	
	/**
	 * Set the sentiment weight
	 *
	 * @param $weight
	 */
	public function setLangTxt($langTxt) {
		$this->sent_langTxt = $langTxt;
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
			'sent_language'    	=> $this->sent_language,
			'sent_word'	       	=> $this->sent_word,
			'sent_weight'    	=> $this->sent_weight
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
		// load all with a order by clause
		$results = $this->_loadAllOrderBy("sent_language");
		$ret 	 = array (); 
		
		$language = new Core_Model_Language();
		// read all languages and set it later to the sentiment object as language text 
		$languages = $language->_loadAllOrderBy("language_code");
		
		foreach ($results as $result)
		{
			$sentiment = new Core_Model_Sentiment();
			$sentiment->setValues ($result);
			foreach ($languages as $test)
			{
				if($test['language_code'] == $sentiment->getSentimentLanguage())
				{
					$sentiment->setLangTxt("lang_".$test['language_code']);
					break;
				}
			}
			$ret[] = $sentiment;
		}
		
		return $ret;
	}
	
	/**
	 * funtion to load a object of the current type
	 * 
	 * @return Core_Model_Sentiment
	 */
	public function loadById ($id)
	{
		$values = $this->_loadById($id);
		$this->setValues ($values);
		return $this->getData();
	}
	
	/**
	 * function to save a sentiment
	 * 
	 * @return inserted id
	 */
	public function save () {
		$this->id = $this->_save();
		
		return $this->id;		
	}

	/**
	 * function to update a sentiment
	 */
	public function update() {
		$this->_update();
	}
	
	/**
	 * function to delete a sentiment
	 */
	public function delete ($id) {
		$this->_delete($id);
	}
}