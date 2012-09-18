<?php

class NewsletterController extends Zend_Controller_Action
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
    	
    	if ($this->_request->isPost()) {
    		Zend_Loader::loadClass('Zend_Filter_StripTags');
    		$filter = new Zend_Filter_StripTags();
    	
    		$maill = $filter->filter($this->_request->getPost('mail'));
    		$maill = trim($maill);
    		$podpis = $filter->filter($this->_request->getPost('podpis'));
    		$podpis = trim($podpis);
    		$radio = $filter->filter($this->_request->getPost('radio'));
    		$radio = trim($radio);
    		$skad = $filter->filter($this->_request->getPost('skad'));
    		$skad = trim($skad);
    	
    		Zend_Loader::loadClass('newsletterbaza');
    		$this->view->title = "newsletterbaza";
    		$newsletterbaza = new newsletterbaza();
    		$this->view->newsletterbaza = $newsletterbaza->fetchAll();
    		
    		if($radio == 1){
    		if ($maill != " && $skad != ") {
    			$zrzut = array(
    					'mail' => $maill,
    					'podpis' => $podpis,
    					'skad' => $skad,
    			);
    			$newsletterbaza->insert($zrzut);
    		}
    		}
    		if($radio == 0){
    			$id = 0;
    			for($i=0;$i<count($this->view->newsletterbaza);$i++){
    				if($this->view->newsletterbaza[$i]->mail == $maill)
    					$id = $this->view->newsletterbaza[$i]->id;
    			}
    			
    			$where = 'id = ' . $id;
    			$rows_affected = $newsletterbaza->delete($where);
    		}
    		 
    		$this->_helper->redirector('wyslano');
    		return;
    	}
    }
    
    function wyslanoAction()
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