<?php
/**
 * Customer entity is a User
 * represents a Customer with his attributes
 *
 * @author Andreas Ressmann
 * 23.01.2014
 */
class Core_Model_Customer extends Core_Model_User {
	

	/* [PROPERTIES] */
    protected $amount;
    protected $stamp;
    
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
		return 'user_customer';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_Customer');
	}
	
	/* [GETTERS/SETTERS] */
	/**
	 * @return amount of customer
	 */
    public function getAmount() {
    	return $this->amount;
    }
    
	/**
	 * setting the amount for the customer
	 */
    public function setAmount($amount) {
		$this->amount = $amount;    	
    }
    
	/**
	 * @return last amount change stamp
	 */
    public function getStamp() {
        return $this->stamp;
    }
    
	/**
	 * setting the last amount change stamp
	 */
    public function setStamp($stamp) {
        $this->stamp = $stamp;        
    }
    /**
	 * getting attributes of this class as array
	 *
	 * @return array with attributes
	 */
    public function getData () {
        return array_merge($this->toArray (), $this->getParent ()->getData());
    }
    
    /* [TRANSFORMERS] */
    /**
	 * transform object to array
	 * 
	 * @return array of attributes
	 */
	public function toArray() {
		
		$data = array(
			'id'				=> $this->id,
			'amount'            => $this->amount,
            'stamp'	    		=> $this->stamp,
		);
		
		$this->data = $data;
		
		return $data;
	}
	/**
	 * function to load all objects of the current type
	 * 
	 * @return array<Customer>
	 */
	public function loadAll () {
		
		$results = $this->_loadAll ();
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$user = new Core_Model_Customer ();
			$values = array_merge($user->getParent ()->loadById($result['id']), $result);
			$user->setValues ($values);
			
			$ret[] = $user;
		}
		
		return $ret;
	}
	/**
	 * funtion to load a object of the current type
	 * 
	 * @return Customer 
	 */
	public function loadById ($id) {
		$values = array_merge($this->getParent ()->loadById($id), $this->_loadById($id));
		$this->setValues ($values);

		return $values;		
	}
	/**
	 * function to save a Customer
	 * 
	 * @return inserted id
	 */
	public function save () {
		$this->id = $this->getParent ()->save();
		$this->_save();
		
		return $this->id;
	}
	/**
	 * function to update a Customer
	 */
	public function update () {
		$this->getParent ()->update();
		$this->_update();
	}
	/**
	 * function to delete a Customer
	 */
	public function delete ($id) {
		$this->getParent ()->delete ($id);
		$this->_delete($id);
	}
}