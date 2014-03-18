<?php
/**
 * Transaction entity
 * represents the Transaction with stamp, source, target and information
 *
 * @author Andreas Ressmann
 * 23.01.2014
 */
class Core_Model_Transaction extends Core_Model_Abstract {
	

	/* [PROPERTIES] */
    protected $stamp;
    protected $source_id;
    protected $target_id;
    protected $info;
    
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
		return 'transaction';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_Transaction');
	}
	
	/* [GETTERS/SETTERS] */
	/**
	 * @return stamp date
	 */
    public function getStamp() {
        return $this->stamp;
    }

	/**
	 * setting stamp
	 */
    public function setStamp($stamp) {
        $this->stamp = $stamp;
    }
    
	/**
	 * @return sourceId
	 */
    public function getSourceId() {
    	return $this->source_id;
    }
    
	/**
	 * setting sourceId
	 */
    public function setSourceId($sourceId) {
        $this->source_id = $sourceId;
    }
    
	/**
	 * @return targetId
	 */
	public function getTargetId() {
    	return $this->target_id;
    }
    
	/**
	 * setting the targetId
	 */
    public function setTargetId($targetId) {
        $this->target_id = $targetId;
    }
    
	/**
	 * setting the information
	 */
    public function setInfo($info) {
    	$this->info = $info;
    }
    
	/**
	 * @return info
	 */
	public function getInfo() {
    	return $this->info;
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
			'id' 	    		=> $this->id,
            'stamp'	    		=> $this->stamp,
			'source_id'	    	=> $this->source_id,
			'target_id'	    	=> $this->target_id,
			'info'	    	    => $this->info
		);
		
		$this->data = $data;
		
		return $data;
	}
	/**
	 * function to load all objects of the current type
	 * 
	 * @return array<Transaction>
	 */
	public function loadAll () {
		
		$results = $this->_loadAll ();
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$auth = new Core_Model_Transaction ();
			$auth->setValues ($result);
			
			$ret[] = $auth;
		}
		
		return $ret;
	}
	/**
	 * funtion to load a object of the current type
	 * 
	 * @return Transaction 
	 */
	public function loadById ($id) {
		$values = $this->_loadById($id);
		$this->setValues ($values);
		
		return $values;
	}
	/**
	 * function to save a Transaction
	 * 
	 * @return inserted id
	 */
	public function save () {
		$this->id = $this->_save();
		
		return $this->id;		
	}
	/**
	 * function to update a Transaction
	 */
	public function update() {
		$this->_update();
	}
	/**
	 * function to delete a Transaction
	 */
	public function delete ($id) {
		$this->_delete($id);
	}
}