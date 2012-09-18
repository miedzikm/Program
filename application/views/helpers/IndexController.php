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
	
	Zend_Loader::loadClass('glowna'); 
    $this->view->title = "glowna"; 
	 $glowna = new glowna();
   $this->view->glowna = $glowna->fetchAll();


 Zend_Loader::loadClass('poczekalnia');
   $poczekalnia = new poczekalnia();
   //$result = $glowna->fetchAll();
   $result = $glowna->select()->order("id desc");;
   //$result2 = $glowna->select()->from(array ('glowna'))->order(array('glowna DESC'));
   //$result2 = $glowna->select()->order(id DESC);
   
    $page=$this->_getParam('page',1);
	//$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($array));
    $paginator = Zend_Paginator::factory($result);
    $paginator->setItemCountPerPage(3);
    $paginator->setCurrentPageNumber($page);

    $this->view->paginator=$paginator;
    }
	

	
	
}