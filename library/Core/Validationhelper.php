<?php
/**
 * core class to validate user inputs
 * 
 * @author Andreas Ressmann
 * 07.04.2014
 */
class Core_Validationhelper {
 
 	/**
	 * validation function validating different types by a given pattern
	 * 
	 * @return errormessages
	 */
    public static function validate ($validation, $data) {
        
        $ret = null;
        
        foreach ($validation as $text => $item) {
            
            $validationItem = explode (':', $item);
            $field          = $validationItem[0];
            $allowNull      = ($validationItem[1] == 'N') ? true : false;
            $type           = $validationItem[2];

            $linebr			= '<br>';
            
            if (!$allowNull) {
                switch ($type) {
                    case 'int':
                        if (!self::validateInt($data->$field)) {
                           $ret .= $text . ': (z.B. 1)' . $linebr;
                        }
                        break;
                    case 'mail':
                        if (!self::validateMail($data->$field)) {
                            $ret .= ' ' . $text . ': (z.B. name@server.com)' . $linebr;
                        }
                        break;
                    case 'double':
                        if (!self::validateDouble($data->$field)) {
                            $ret .= ' ' . $text . ': (z.B. 1.1)' . $linebr;
                        }
                        break;
                    case 'string':
                        if (!self::validateString($data->$field)) {
                            $ret .= ' ' . $text . ': (z.B. Text)' . $linebr;
                        }
                        break;
                   	case 'date':
                    	if (!self::validateDate($data->$field)) {
                        	$ret .= ' ' . $text . ': (z.B. 01.01.2014)' . $linebr;
                        }
                        break;
                }
            }
        }

        return $ret;
    }       
    
    public static function validateDate ($value) {
    	
    	$format = 'dd.mm.yyyy';
    	
    	if(strlen($value) >= 6){
    	
    		// find separator. Remove all other characters from $format
    		$separator_only = str_replace(array('m','d','y'),'', $format);
    		$separator = $separator_only[0]; // separator is first character
    	
    		if($separator && strlen($separator_only) == 2){
    			// make regex
    			$regexp = str_replace('mm', '(0?[1-9]|1[0-2])', $format);
    			$regexp = str_replace('dd', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp);
    			$regexp = str_replace('yyyy', '(19|20)?[0-9][0-9]', $regexp);
    			$regexp = str_replace($separator, "\\" . $separator, $regexp);
    			if($regexp != $value && preg_match('/'.$regexp.'\z/', $value)){
    	
    				// check date
    				$arr 	= explode($separator, $value);
    				$day 	= $arr[0];
    				$month 	= $arr[1];
    				$year 	= $arr[2];
    				
    				if(@checkdate($month, $day, $year))
    					return true;
    			}
    		}
    	}
    	return false;
    }
        
	/**
	 * validate integer
	 * @return true or false
	 */
    private static function validateInt ($value) {
        if(is_numeric($value))
            return true;
        
        return false;
    }
    
	/**
	 * validate mail
	 * @return true or false
	 */
    private static function validateMail($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    
	/**
	 * validate double
	 * @return true or false
	 */
    private static function validateDouble ($value) {
        if(is_numeric($value) && strpos($value, ".") !== false)
            return true;
        
        return false;
    }
    
	/**
	 * validate string
	 * @return true or false
	 */
    private static function validateString ($value) {
        if (is_string ($value) && $value != '') 
            return true;
        
        return false;
    }
}
    