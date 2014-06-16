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
    	
    	if(strlen($value) > 0){
    		return true;
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
    