<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
	{
	$this->_helper->redirector->setUseAbsoluteUri(true);
     $this->view->baseUrl = $this->_request->getBaseUrl();
    }
   
   	function indexAction() 
    {
    	Zend_Loader::loadClass('produkty');
    	$this->view->title = "produkty";
    	$produkty = new produkty();
    	$this->view->produkty = $produkty->fetchAll();
    	
    	Zend_Loader::loadClass('aktualnosci');
    	$this->view->title = "aktualnosci";
    	$aktualnosci = new aktualnosci();
    	$this->view->aktualnosci = $aktualnosci->fetchAll();
	
    	
    }
    

}