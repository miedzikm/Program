<?php

class GaleriaController extends Zend_Controller_Action
{

    public function init()
	{
	$this->_helper->redirector->setUseAbsoluteUri(true);
     $this->view->baseUrl = $this->_request->getBaseUrl();
    }
   
   	function indexAction() 
    {
    	Zend_Loader::loadClass('galerie');
    	$this->view->title = "galerie";
    	$galerie = new galerie();
    	$this->view->galerie = $galerie->fetchAll();
    	
    	
 
	 $this->view->title = "myk"; 
		$myk = new galerie();
		$idd = $this->_request->getParam('id');
		if ($idd != null) {

		 $this->view->myk = $galerie->fetchRow($galerie->select()->where('id = ?', $idd));
		 } else {
		 	$idd = 1;
		 	$this->view->myk = $galerie->fetchRow($galerie->select()->where('id = ?', $idd));
		 	}
		 
    }
	
}