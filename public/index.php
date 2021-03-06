<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment

if(!defined('APPLICATION_ENV')) {
	switch($_SERVER['HTTP_HOST']) {
		default:
			$env = 'development';
			break;
	}
	
	define('APPLICATION_ENV', $env);
}

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';


// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
Zend_Session::start();
$application->bootstrap()
            ->run();