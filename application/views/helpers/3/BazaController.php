<?php

class BazaController extends Zend_Controller_Action
{

    public function init()
	{
	$this->_helper->redirector->setUseAbsoluteUri(true);
     $this->view->baseUrl = $this->_request->getBaseUrl();
	 // $this->view->baseUrl = "http://localhost/niania/public";
	   //$this->view->baseUrl = "http://mgroup.pl/niania/public";
    }
   
   	function indexAction() 
    {
    	Zend_Loader::loadClass('blog');
		$this->view->title = "blog"; 
		$blog = new blog();
    	$this->view->blog = $blog->fetchAll();
    	
    	Zend_Loader::loadClass('radzi');
		$this->view->title = "radzi"; 
		$radzi = new radzi();
    	$this->view->radzi = $radzi->fetchAll();
    	
    	Zend_Loader::loadClass('slider');
		$this->view->title = "slider"; 
		$slider = new slider();
    	$this->view->slider = $slider->fetchAll();
    	
    	Zend_Loader::loadClass('aktualnosc');
		$this->view->title = "aktualnosc"; 
		$aktualnosc = new aktualnosc();
    	$this->view->aktualnosc = $aktualnosc->fetchAll();
    	
    Zend_Loader::loadClass('user');
		$this->view->title = "user"; 
		$user = new user();
    	$this->view->user = $user->fetchAll();
    	
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
	if (null !== $userek) {
	$l = Zend_Auth::getInstance()->getIdentity()->login;
	$this->view->moj = $user->fetchRow($user->select()->where('login = ?', $l));
	
	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
	}
	
	if ($this->_request->isPost()) {
      Zend_Loader::loadClass('Zend_Filter_StripTags');
      $filter = new Zend_Filter_StripTags();

      $miasto = $filter->filter($this->_request->getPost('miasto'));
      $miasto = trim($miasto);
	  $dzielnica = $filter->filter($this->_request->getPost('dzielnica'));
      $dzielnica = trim($dzielnica);
      $result = $user->select()->where('miasto = ?',$miasto)->where('dzielnica = ?',$dzielnica)->order("nazwisko");
   //$result2 = $glowna->select()->from(array ('glowna'))->order(array('glowna DESC'));
   //$result2 = $glowna->select()->order(id DESC);
   
    $page=$this->_getParam('page',1);
	//$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($array));
    $paginator = Zend_Paginator::factory($result);
    $paginator->setItemCountPerPage(6);
    $paginator->setCurrentPageNumber($page);

    $this->view->paginator=$paginator;
	}
	else{
   //$result = $glowna->fetchAll();
   $result = $user->select()->order("nazwisko");;
   //$result2 = $glowna->select()->from(array ('glowna'))->order(array('glowna DESC'));
   //$result2 = $glowna->select()->order(id DESC);
   
    $page=$this->_getParam('page',1);
	//$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($array));
    $paginator = Zend_Paginator::factory($result);
    $paginator->setItemCountPerPage(6);
    $paginator->setCurrentPageNumber($page);

    $this->view->paginator=$paginator;
	}
	
	
    }
	
}