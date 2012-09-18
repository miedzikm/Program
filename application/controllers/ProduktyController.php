<?php

class ProduktyController extends Zend_Controller_Action
{

    public function init()
	{
	$this->_helper->redirector->setUseAbsoluteUri(true);
     $this->view->baseUrl = $this->_request->getBaseUrl();
    }
   
   	function indexAction() 
    {
    	
    	Zend_Loader::loadClass('statyczne');
    	$this->view->title = "statyczne";
    	$statyczne = new statyczne();
    	$this->view->statyczne = $statyczne->fetchAll();
    	
    	Zend_Loader::loadClass('produkty');
    	$this->view->title = "produkty";
    	$produkty = new produkty();
    	$this->view->produkty = $produkty->fetchAll();
    	
    	Zend_Loader::loadClass('aktualnosci');
    	$this->view->title = "aktualnosci";
    	$aktualnosci = new aktualnosci();
    	$this->view->aktualnosci = $aktualnosci->fetchAll();
    }
    
    function produktAction()
    {
    	Zend_Loader::loadClass('produkty');
    	$this->view->title = "produkty";
    	$produkty = new produkty();
    	$this->view->produkty = $produkty->fetchAll();
    	
    	Zend_Loader::loadClass('aktualnosci');
    	$this->view->title = "aktualnosci";
    	$aktualnosci = new aktualnosci();
    	$this->view->aktualnosci = $aktualnosci->fetchAll();
    	
    	Zend_Loader::loadClass('statyczne');
    	$this->view->title = "statyczne";
    	$statyczne = new statyczne();
    	$this->view->statyczne = $statyczne->fetchAll();
    	
   
	 $this->view->title = "myk"; 
		$myk = new produkty();
		

      $idd = $this->_request->getParam('id');

		 $this->view->myk = $produkty->fetchRow($produkty->select()->where('id = ?', $idd)); 
  
    	
    }
	
}