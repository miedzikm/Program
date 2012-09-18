<?php
error_reporting(E_ALL|E_STRICT);
date_default_timezone_set('Europe/London');
set_include_path('.' . PATH_SEPARATOR . './library'
   . PATH_SEPARATOR . './application/models/'
   . PATH_SEPARATOR . get_include_path());

include "Zend/Loader.php";
Zend_Loader::loadClass('Zend_Controller_Front');
Zend_Loader::loadClass('Zend_Config_Ini');
Zend_Loader::loadClass('Zend_Registry'); 
Zend_Loader::loadClass('Zend_Db');
Zend_Loader::loadClass('Zend_Db_Table');
Zend_Loader::loadClass('Zend_Form');
Zend_Loader::loadClass('Zend_Auth');
Zend_Loader::loadClass('Zend_Acl');
Zend_Loader::loadClass('Zend_Application');
Zend_Loader::loadClass('Zend_Auth_Adapter_DbTable');
Zend_Loader::loadClass('Zend_Paginator');
Zend_Loader::loadClass('Application_Form_Login');

// load configuration
$config = new Zend_Config_Ini('./application/config.ini', 'general');
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
//$frontController->setBaseUrl('/zend/');
$frontController->setControllerDirectory('./application/controllers');

// run!
$frontController->dispatch();
