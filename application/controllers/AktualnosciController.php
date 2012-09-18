<?php

class AktualnosciController extends Zend_Controller_Action
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
    
    function newsAction()
    {
    	Zend_Loader::loadClass('produkty');
    	$this->view->title = "produkty";
    	$produkty = new produkty();
    	$this->view->produkty = $produkty->fetchAll();
    	
    	Zend_Loader::loadClass('aktualnosci');
    	$this->view->title = "aktualnosci";
    	$aktualnosci = new aktualnosci();
    	$this->view->aktualnosci = $aktualnosci->fetchAll();
    	
   
	 $this->view->title = "myk"; 
		$myk = new aktualnosci();
		

      $idd = $this->_request->getParam('id');

		 $this->view->myk = $aktualnosci->fetchRow($aktualnosci->select()->where('id = ?', $idd)); 
  
    	
    }
	
}