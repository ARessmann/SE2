<?php
/**
 * core class to upload CSV
 * 
 * @author Andreas Ressmann
 * 03.06.2014
 */
class Core_Uploadhelper {
	
	/*
	 * Handle file Upload set Destination folder
	 */
	public function doFileUpload () {
    	$adapter    	= new Zend_File_Transfer_Adapter_Http();
		$data			= array();
		$destination 	= 'upload';
		
    	$adapter->setDestination($destination);
    	
    	$filebase = $adapter->getFileName();
    	
    	if (is_string ($filebase) && strlen($filebase) > 0) {
    		$filename   = basename($filebase);
    		$fullPath	= $destination . '/' . $filename;
    		 
    		if (file_exists ($fullPath))
    			unlink ($fullPath);
    	
    		$adapter->receive();
    	
    		if ($adapter->isValid())
    		{
    			if (($handle = fopen($fullPath, "r")) !== FALSE) {
    	
    				while (($row = fgetcsv($handle, 1000, ';')) !== FALSE) {
    					$data[] = $row;
    				}
    	
    				fclose($handle);
    	
    				if(file_exists ($fullPath))
    					unlink ($fullPath);
    			}
    		}
    	
    		return $this->addImportToDb($data);
    	}
    	
    	return null;
    }
    
    /*
     * Add Import to Database
     */
    private function addImportToDb ($data) {
    	
    	if ($this->checkData($data)) {
    		foreach ($data as $entry) {
	    		$sentiment = new Core_Model_Sentiment();
	    		
	    		$sentiment->setSentimentLanguage($entry['0']);
	    		$sentiment->setSentimentWord($entry['1']);
	    		$sentiment->setSentimentWeight($entry['2']);
	    		
	    		$sentiment->save();
    		}
    		
    		return true;
    	}
    	else return false;
    }
    
    /*
     * Validate CSV Information 
     */
    private function checkData ($data) {
    	
    	$ret = false;
    	
    	foreach ($data as $entry) {
    		if (isset ($entry[0]) && isset ($entry[1]) && isset ($entry[2])) {
	    		$lang 	= $entry[0];
	    		$word 	= $entry[1];
	    		$weight = $entry[2];
	    		
	    		if ((strlen($lang) == 2) && is_string($word) 
	    				&& is_numeric($weight) && ($weight < 5 && $weight > -5))
	    			$ret = true;
	    		else break;
    		}
    	}
    	
    	return $ret;
    }
}