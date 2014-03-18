<?php
/**
 * Device entity is a Auth
 * represents a Device with his attributes
 *
 * @author Andreas Ressmann
 * 23.01.2014
 */
class Core_Model_Device extends Core_Model_Auth {
	

	/* [PROPERTIES] */
    protected $devicenr;
    protected $description;
    protected $type;
    
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
		return 'auth_device';
	}
	/**
	 * getting the class variables of the current class
	 * 
	 * @return class properties
	 */
	public function getProperties () {
		return get_class_vars('Core_Model_Device');
	}
	
	/* [GETTERS/SETTERS] */
	/**
	 * @return devicenr
	 */
    public function getDeviceNr() {
    	return $this->devicenr;
    }
    
	/**
	 * setting the devicenr
	 */
    public function setDeviceNr($deviceNr) {
		$this->devicenr = $deviceNr;    	
    }
    
	/**
	 * @return description of device
	 */
	public function getDescription() {
    	return $this->description;
    }
    
	/**
	 * setting the device description
	 */
    public function setDescription($description) {
    	$this->description = $description;
    }
    
	/**
	 * @return type of device
	 */
	public function getType() {
    	return $this->type;
    }
    
	/**
	 * setting the device type
	 */
    public function setType($type) {
    	$this->type = $type;
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
			'id'					=> $this->id,
            'devicenr'	    		=> $this->devicenr,
			'description'	    	=> $this->description,
			'type'	    		    => $this->type,
		);
		
		$this->data = $data;
		
		return $data;
	}
	/**
	 * function to load all objects of the current type
	 * 
	 * @return array<Device>
	 */
	public function loadAll () {
		
		$results = $this->_loadAll ();
		$ret 	 = array (); 
		
		foreach ($results as $result) {
			$user = new Core_Model_Device ();
			$values = array_merge($user->getParent ()->loadById($result['id']), $result);
			$user->setValues ($values);
			
			$ret[] = $user;
		}
		
		return $ret;
	}
	/**
	 * funtion to load a object of the current type
	 * 
	 * @return Device 
	 */
	public function loadById ($id) {
		$values = array_merge($this->getParent ()->loadById($id), $this->_loadById($id));
		$this->setValues ($values);

		return $values;		
	}
	/**
	 * function to save a Device
	 * 
	 * @return inserted id
	 */
	public function save () {
		$this->id = $this->getParent ()->save();
		$this->_save();
		
		return $this->id;
	}
	/**
	 * function to update a Device
	 */
	public function update () {
		$this->getParent ()->update();
		$this->_update();
	}
	/**
	 * function to delete a Device
	 */
	public function delete ($id) {
		$this->getParent ()->delete ($id);
		$this->_delete($id);
	}
}