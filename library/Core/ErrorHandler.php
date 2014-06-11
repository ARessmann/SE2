<?php
/**
 * core class for Error handling
 * 
 * @author Andreas Ressmann
 * 22.03.2014
 */
class Core_ErrorHandler {
	
	/**
	 * function to send errormail and log error after getting one
	 */
	public static function registerError($subject, $exception, $user = null, $request = null, $logfile = true, $sendMail = true) {
		
		if($logfile) self::logToFile($subject, $exception, $user, $request);
		
	}
	
	/**
	 * function to log information to logfile
	 */
	public static function info($subject, $body = null) {
		self::logToFile($subject, $body, null, null, false);
	}
	
	/**
	 * function to log the message to a logfile
	 */
	public static function logToFile($subject, $exception, $user, $request, $error = true) {
		
		/*
		$writer = new Zend_Log_Writer_Stream('log/error_' . date("Ymd") . '.log');
		$logger = new Zend_Log($writer);
		
		$exception = is_object($exception) ? $exception->__toString() : $exception;
		
		if($error) {
			$logger->log($subject."\n".$exception."\n", Zend_Log::ERR);
		} else {
			$body = $subject;
			if($exception) {
				$body .= "\n".$exception;
			}
			$logger->log($body."\n", Zend_Log::INFO);
		}
		*/
	}
	
	/**
	 * function to get a detailed error string
	 * 
	 * @return errormessage
	 */
	public static function getErrorDetailed($exception, $user, $request) {
		if(is_object($exception)) {
			$body = '<strong>Message:</strong> ' . $exception->getMessage().'<br/>';
			$body .= '<strong>File:</strong> ' . $exception->getFile().'<br/>';
			$body .= '<strong>Code:</strong> ' . $exception->getCode().'<br/>';
			$body .= '<strong>Line:</strong> ' . $exception->getLine().'<br/>';
			//$body .= '<strong>Trace:</strong> ' . $exception->var_export($exception->getTraceAsString(), true).'<br/><br/>';
			$body .= '<strong>Exception:</strong> ' . str_replace("\n", '<br/>', $exception->__toString()).'<br/><br/>';
		} else {
			$body = $exception;
		}
		
		if($request != null) {
			$body .= '<hr/><strong>Request:</strong> ' . $request;
		}
		
		if($user != null) {
			$body .= '<hr/><strong>User:</strong> ' . var_export($user->toArray(), true);
		}
		
		return $body;
	}
}