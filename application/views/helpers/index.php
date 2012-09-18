<?php
error_reporting(E_ALL|E_STRICT);
date_default_timezone_set('Europe/London');
set_include_path('.' . PATH_SEPARATOR . '/home/familyc1/public_html/library'
   . PATH_SEPARATOR . '/home/familyc1/public_html/application/models/'
   . PATH_SEPARATOR . get_include_path());

include "Zend/Loader.php";
Zend_Loader::loadClass('Zend_Controller_Front');
Zend_Loader::loadClass('Zend_Config_Ini');
Zend_Loader::loadClass('Zend_Registry'); 
Zend_Loader::loadClass('Zend_Db');
Zend_Loader::loadClass('Zend_Db_Table');
Zend_Loader::loadClass('Zend_Auth');
Zend_Loader::loadClass('Zend_Acl');
Zend_Loader::loadClass('Zend_Application');
Zend_Loader::loadClass('Zend_Form');
Zend_Loader::loadClass('Application_Form_Login');
Zend_Loader::loadClass('Zend_Paginator');

/** Zend_Application */
require_once 'Zend/Application.php';

// load configuration
$config = new Zend_Config_Ini('/home/familyc1/public_html/application/config.ini', 'general');
$registry = Zend_Registry::getInstance();
$registry->set('config', $config); 

// setup database 
$db = Zend_Db::factory(	$config->db->adapter,
$config->db->config->toArray() );
Zend_Db_Table::setDefaultAdapter($db);
$db->query('SET NAMES utf8');
$db->query('SET CHARACTER SET utf8');

// setup controller
$frontController = Zend_Controller_Front::getInstance();
$frontController->throwExceptions(true);
$frontController->setParam( 'useDefaultControllerAlways', true );
//$frontController->setBaseUrl('/zend/dupa');
$frontController->setControllerDirectory('/home/familyc1/public_html/application/controllers');

// run!
//$frontController->dispatch();
// Create application, bootstrap, and run
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/home/familyc1/public_html/application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
$application = new Zend_Application(
    APPLICATION_ENV,
    '/home/familyc1/public_html/application/configs/application.ini'
);
$application->bootstrap()
            ->run();