<?php

/**
 * abstract base class for all model classes
 *
 * @author Andreas Ressmann
 * 23.01.2014
 */
abstract class Core_Model_Abstract {
	
	/* [PROPERTIES] */
	private $dbAdapter;
	protected $data;
	protected $errorHandler;
    protected $session;

	protected $id; //id is required for every model

	/**
	 * initilializing the class setting the session, errorhandler and the dbAdapter
	 */
	public function init() {
		$this->errorHandler = new Core_ErrorHandler();
        $this->session = new Zend_Session_Namespace('Core');
		$this->dbAdapter = Zend_Registry::getInstance()->dbAdapter;
	}

	/* [GETTERS/SETTERS] */
	public function getId() {
		return $this->id;
	}
	
    public function getData () {
        return $this->data;
    }
    
	/* [FUNCTIONS] */
	/**
	 * base function to load all elements from the database
	 */
	public function _loadAll () {
		
		$results =  $this->dbAdapter->select()->from($this->getTableName ())
                    ->query()
                    ->fetchAll();
                    
        return $results;
		
	}
	
	/**
	 * base function to load elements from the database by a given property with a value
	 * it is also possible to order the result
	 */
	public function _loadByProperty($propertyName, $propertyValue, $order = 'id') {

		if (isset($propertyValue) && $propertyValue != 0 && $propertyValue != '0') {
	        $results =  $this->dbAdapter->select()->from($this->getTableName())
	                    ->where($propertyName . ' = ' . $propertyValue)
	                    ->order($order)
	                    ->query()
	                    ->fetchAll();
		}
		else {
			$results = $this->_loadAll();
		}

        return $results;
	}
	
	/**
	 * base function to load a object by a given id
	 */
	public function _loadById($id) {

		$result =  $this->dbAdapter->select()->from($this->getTableName())
                    ->where('id = ?', $id)
                    ->query()
                    ->fetch();
		
		return $result;
	}
	
	/**
	 * base function to count all elements of a table
	 */
    public function _count() {

        $result =   $this->dbAdapter->select()
                    ->from($this->getTableName(), array("count"=>"COUNT(*)"))
                    ->query()
                    ->fetch();

        return $result['count'];
    }
    
	/**
	 * base function to delete a object from the database
	 */
    public function _delete($id) {
    	$where = $this->dbAdapter->quoteInto('id = ?', $id);
 		return $this->dbAdapter->delete($this->getTableName(), $where);
    }

	/**
	 * base funtion to persist a new object
	 */
	public function _save() {

        $this->toArray();

		$result = $this->dbAdapter->insert($this->getTableName(), $this->data);
		//check result throw Exception
		
        return $this->dbAdapter->lastInsertId();
	}
	
	/**
	 * base function to update a object
	 */
	public function _update() {
		
		$this->toArray();
		
		$where = $this->dbAdapter->quoteInto('id = ?', $this->id);
		$result = $this->dbAdapter->update($this->getTableName(), $this->data, $where);
		//check result throw Exception
	}

	/**
	 * polymorphism workarround -> getting the parent class and setting
	 * the attributes of the class
	 */
	public function getParent () {
		
		$parent			= get_parent_class($this);
		$parent 		= new $parent;

		foreach ($parent->getProperties() as $key => $val) {
			if (isset($key)) {
				$parent->$key = $this->$key;
			}
		}
		return $parent;
	}
	
	/**
	 * setting class attributes by a given array
	 */
	public function setValues ($properties) {
		
		foreach ($properties as $key => $val) {
			if (isset($key)) {
				$this->$key = $val;
			}
		}
	}
	
	/**
	 * Execute a select statement with given tableName and where condition
	 */
	public function _selectFor($tableName, $idName, $id)
	{
		return $result =  $this->dbAdapter->select()->from($tableName)
		->where($idName.' = ?', $id)
		->query()
		->fetchAll();
	}
	
	/**
	 * Fetch all entries from table with wherCondition = propertyName.
	 * 
	 * @param unknown $propertyLike all like conditions in the where clause
	 * @param unknown $propertyEqual all equals (=) conditions in the where clause
	 * @param string $order
	 * @return unknown
	 */
	public function _loadAllByProperties($propertyLike, $propertyEqual, $order = 'id')
	{	
		if (isset($propertyLike) || isset($propertyEqual))
		{
			$whereCondition = null;
			foreach ($propertyLike as $key => $val)
			{
				if($val != "" && $val != null)
					$whereCondition .= $key . ' like \'%' . $val . '%\' AND ';
			}
			
			foreach ($propertyEqual as $key => $val)
			{
				if($val != "" && $val != null)
					$whereCondition .= $key . ' = ' . $val . ' AND ';
			}
			if($whereCondition != "")
				$whereCondition = substr($whereCondition, 0, -5); // remove the AND
			 
			$results =  $this->dbAdapter->select()->from($this->getTableName())
			->where($whereCondition)
			->order($order)
			->query()
			->fetchAll();
		}
		else {
			$results = $this->_loadAll();
		}
	
		return $results;
	}
	
	/**
	 * base function to load elements from the database with a order by clause
	 */
	public function _loadAllOrderBy($order) {
	
		$results =  $this->dbAdapter->select()->from($this->getTableName ())
		->order($order)
		->query()
		->fetchAll();
		
		return $results;
	}
}