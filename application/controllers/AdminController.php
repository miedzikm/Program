<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
	{
	$this->_helper->redirector->setUseAbsoluteUri(true);
     $this->view->baseUrl = $this->_request->getBaseUrl();
     $this->_redirector = $this->_helper->getHelper('Redirector');
    }
   
   	function indexAction() 
    {
    
    	
    }
    
public function loginAction()
    {
		
        $form = new Application_Form_Login();
        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {

			Zend_Loader::loadClass('Zend_Filter_StripTags');
      		$filter = new Zend_Filter_StripTags();

      		$login = $filter->filter($this->_request->getPost('login'));
      		$login = trim($login);
			$haslo = $filter->filter($this->_request->getPost('haslo'));
      		$haslo = trim($haslo);
			if($login == null || $haslo == null) $this->_helper->redirector('nic');
			
						$adapter = new Zend_Auth_Adapter_DbTable($db);
                    $adapter->setTableName('paski');
                    $adapter->setIdentityColumn('login');
                    $adapter->setCredentialColumn('haslo');
                    $adapter->setIdentity($login);
                    $adapter->setCredential($haslo);
                            
                    $auth = Zend_Auth::getInstance();
                    $result = $auth->authenticate($adapter);
                
                    if ($result->isValid()) {
                    $auth->getStorage()->write($adapter->getResultRowObject(null, 'haslo'));
                    Zend_Session::start();
					$this->_helper->redirector('edytujglowna');
                    } else {
                               $this->_helper->redirector('index');
                            }
            }
        }

        $this->view->loginForm = $form;
    }
    
    public function logoutAction()
    {
    	Zend_Auth::getInstance()->clearIdentity();
    	Zend_Session::destroy();
    	$this->_helper->redirector('index');
    }
    
	function edytujonasAction() 
    {
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    	
    	Zend_Loader::loadClass('statyczne');
		$this->view->title = "onas"; 
		$onas = new statyczne();
    	$this->view->onas = $onas->fetchAll();
    	
    	
    if ($this->_request->isPost()) {
      Zend_Loader::loadClass('Zend_Filter_StripTags');
      $filter = new Zend_Filter_StripTags(); 

	  $tresc = $this->_request->getPost('tresc');
	  $id=2;
	  $data = array(
               'tresc'	=> $tresc,
            );
			
            $where = 'id = ' . $id;
            $onas->update($data, $where);
			//echo 'zrobione';
			$this->_helper->redirector('edytujonas');
			
    }
    	
    }
    
    function edytujprojektanciAction()
    {
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    	 
    	Zend_Loader::loadClass('statyczne');
    	$this->view->title = "onas";
    	$onas = new statyczne();
    	$this->view->onas = $onas->fetchAll();
    	 
    	 
    	if ($this->_request->isPost()) {
    		Zend_Loader::loadClass('Zend_Filter_StripTags');
    		$filter = new Zend_Filter_StripTags();
    
    		$tresc = $this->_request->getPost('tresc');
    		$id=5;
    		$data = array(
    				'tresc'	=> $tresc,
    		);
    		$where = 'id = ' . $id;
    		$onas->update($data, $where);
    		//echo 'zrobione';
    		$this->_helper->redirector('edytujprojektanci');
    			
    	}
    	 
    }
    
    function edytujproduktyAction()
    {
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    	 
    	Zend_Loader::loadClass('statyczne');
    	$this->view->title = "onas";
    	$onas = new statyczne();
    	$this->view->onas = $onas->fetchAll();
    	 
    	 
    	if ($this->_request->isPost()) {
    		Zend_Loader::loadClass('Zend_Filter_StripTags');
    		$filter = new Zend_Filter_StripTags();
    
    		$tresc = $this->_request->getPost('tresc');
    		$id=3;
    		$data = array(
    				'tresc'	=> $tresc,
    		);
    			
    		$where = 'id = ' . $id;
    		$onas->update($data, $where);
    		//echo 'zrobione';
    		$this->_helper->redirector('edytujprodukty');
    			
    	}
    	 
    }
    
    function edytujglownaAction()
    {
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    	 
    	Zend_Loader::loadClass('statyczne');
    	$this->view->title = "onas";
    	$onas = new statyczne();
    	$this->view->onas = $onas->fetchAll();
    	 
    	 
    	if ($this->_request->isPost()) {
    		Zend_Loader::loadClass('Zend_Filter_StripTags');
    		$filter = new Zend_Filter_StripTags();
    
    		$tresc = $this->_request->getPost('tresc');
    		$id=1;
    		$data = array(
    				'tresc'	=> $tresc,
    		);
    			
    		$where = 'id = ' . $id;
    		$onas->update($data, $where);
    		//echo 'zrobione';
    		$this->_helper->redirector('edytujglowna');
    			
    	}
    	 
    }
    
    function edytujdolaczAction()
    {
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    
    	Zend_Loader::loadClass('statyczne');
    	$this->view->title = "onas";
    	$onas = new statyczne();
    	$this->view->onas = $onas->fetchAll();
    
    
    	if ($this->_request->isPost()) {
    		Zend_Loader::loadClass('Zend_Filter_StripTags');
    		$filter = new Zend_Filter_StripTags();
    
    		$tresc = $this->_request->getPost('tresc');
    		$id=3;
    		$data = array(
    				'tresc'	=> $tresc,
    		);
    		 
    		$where = 'id = ' . $id;
    		$onas->update($data, $where);
    		//echo 'zrobione';
    		$this->_helper->redirector('edytujdolacz');
    		 
    	}
    
    }
    
    function edytujgaleriaAction()
    {
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    
    	Zend_Loader::loadClass('statyczne');
    	$this->view->title = "onas";
    	$onas = new statyczne();
    	$this->view->onas = $onas->fetchAll();
    
    
    	if ($this->_request->isPost()) {
    		Zend_Loader::loadClass('Zend_Filter_StripTags');
    		$filter = new Zend_Filter_StripTags();
    
    		$tresc = $this->_request->getPost('tresc');
    		$id=4;
    		$data = array(
    				'tresc'	=> $tresc,
    		);
    		 
    		$where = 'id = ' . $id;
    		$onas->update($data, $where);
    		//echo 'zrobione';
    		$this->_helper->redirector('edytujgaleria');
    		 
    	}
    
    }
    
    function edytujzespolAction()
    {
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    
    	Zend_Loader::loadClass('statyczne');
    	$this->view->title = "onas";
    	$onas = new statyczne();
    	$this->view->onas = $onas->fetchAll();
    
    
    	if ($this->_request->isPost()) {
    		Zend_Loader::loadClass('Zend_Filter_StripTags');
    		$filter = new Zend_Filter_StripTags();
    
    		$tresc = $this->_request->getPost('tresc');
    		$id=5;
    		$data = array(
    				'tresc'	=> $tresc,
    		);
    		 
    		$where = 'id = ' . $id;
    		$onas->update($data, $where);
    		//echo 'zrobione';
    		$this->_helper->redirector('edytujzespol');
    		 
    	}
    
    }
    
    function edytujkontaktAction()
    {
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    
    	Zend_Loader::loadClass('statyczne');
    	$this->view->title = "onas";
    	$onas = new statyczne();
    	$this->view->onas = $onas->fetchAll();
    
    
    	if ($this->_request->isPost()) {
    		Zend_Loader::loadClass('Zend_Filter_StripTags');
    		$filter = new Zend_Filter_StripTags();
    
    		$tresc = $this->_request->getPost('tresc');
    		$id=4;
    		$data = array(
    				'tresc'	=> $tresc,
    		);
    		 
    		$where = 'id = ' . $id;
    		$onas->update($data, $where);
    		//echo 'zrobione';
    		$this->_helper->redirector('edytujkontakt');
    		 
    	}
    
    }
    
    function edytujpromocjeAction()
    {
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    
    	Zend_Loader::loadClass('statyczne');
    	$this->view->title = "onas";
    	$onas = new statyczne();
    	$this->view->onas = $onas->fetchAll();
    
    
    	if ($this->_request->isPost()) {
    		Zend_Loader::loadClass('Zend_Filter_StripTags');
    		$filter = new Zend_Filter_StripTags();
    
    		$tresc = $this->_request->getPost('tresc');
    		$id=7;
    		$data = array(
    				'tresc'	=> $tresc,
    		);
    		 
    		$where = 'id = ' . $id;
    		$onas->update($data, $where);
    		//echo 'zrobione';
    		$this->_helper->redirector('edytujpromocje');
    		 
    	}
    
    }
 
    function produktylistaAction()
    {
    
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////

    	Zend_Loader::loadClass('produkty');
    	$this->view->title = "produkty";
    	$produkty = new produkty();
    	$this->view->produkty = $produkty->fetchAll();
    }
    
function produktyAction() 
    {
    
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    if ($this->_request->isPost()) {
    	//$this->_helper->redirector('index');
    	Zend_Loader::loadClass('produkty');
    	$this->view->title = "produkty";
    	$produkty = new produkty();
      $nazwa = $this->_request->getPost('nazwa');
	  $tresc = $this->_request->getPost('tresc');
      if ($nazwa != " && $tresc != ") {
         $zrzut = array(
           'nazwa' => $nazwa,
         		'tresc' => $tresc,
         );
         $produkty->insert($zrzut);
         $this->_helper->redirector('produktylista');
         return;
      }
   }
   // set up an "empty" album
   $this->view->dodaj = new stdClass();
   $this->view->dodaj->id = null;
   $this->view->dodaj->nazwa = "";
   $this->view->dodaj->rodzaj = "";

   // additional view fields required by form
   $this->view->action = 'add';
   $this->view->buttonText = 'Add';
		
    }
    
function produktyeditAction() 
    {
    
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    	Zend_Loader::loadClass('produkty');
    	$this->view->title = "produkty";
    	$produkty = new produkty();
    	$this->view->title = "myk";
    	$myk = new produkty();
    	
		if ($this->_request->isPost()) {
			//$this->_helper->redirector('index');
      Zend_Loader::loadClass('Zend_Filter_StripTags');
      $filter = new Zend_Filter_StripTags(); 
	   $id = (int)$this->_request->getPost('id');
	 $nazwa = $this->_request->getPost('nazwa');
	  $tresc = $this->_request->getPost('tresc');
	  
      if ($id !== false) {
        if ($nazwa != " && $tresc != ") {
         $zrzut = array(
           'nazwa' => $nazwa,
         		'tresc' => $tresc,
         );
			
            $where = 'id = ' . $id;
            $myk->update($zrzut, $where);
			$this->_helper->redirector('produktylista');
            return;
         } else {
			$this->_helper->redirector('produktylista');
         }
      }
   } else {
      $id = (int)$this->_request->getParam('id', 0);
      if ($id > 0) {
         $this->view->myk = $produkty->fetchRow('id='.$id);
		 }
   }
   $this->view->action = 'edit';
   $this->view->buttonText = 'Edytuj profil';
		
    }
    
    function produktydelAction() {
	
    	///////////////////////////////////////////// LOGOWANIE //////////////////////////
    	$userek = Zend_Auth::getInstance()->getIdentity();
    	if (null !== $userek) {
    		$l = Zend_Auth::getInstance()->getIdentity()->login;
    	}
    	if($l != 'admin')  $this->_helper->redirector('index');
    	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
    	Zend_Loader::loadClass('produkty');
    	$this->view->title = "produkty";
    	$produkty = new produkty();
   if ($this->_request->isPost()) {
   	//$this->_helper->redirector('index');
      Zend_Loader::loadClass('Zend_Filter_Alpha');
      $filter = new Zend_Filter_Alpha(); 

      $id = (int)$this->_request->getPost('id');
      $del = $filter->filter($this->_request->getPost('del'));
      if ($del == 'Tak' && $id > 0) {
         $where = 'id = ' . $id;
         $rows_affected = $produkty->delete($where);
      }
   } else {
      $id = (int)$this->_request->getParam('id');
      if ($id > 0) {
         // only render if we have an id and can find the album.
         $this->view->produkty = $produkty->fetchRow('id='.$id);
         if ($this->view->produkty->id > 0) {
            // render template automatically
            return;
         }
      }
   }
   $this->_helper->redirector('produktylista');
   }
   
   //////////////////////////// GALERIE //////////////////////////
   
   function galerielistaAction()
   {
   
   	///////////////////////////////////////////// LOGOWANIE //////////////////////////
   	$userek = Zend_Auth::getInstance()->getIdentity();
   	if (null !== $userek) {
   		$l = Zend_Auth::getInstance()->getIdentity()->login;
   	}
   	if($l != 'admin')  $this->_helper->redirector('index');
   	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
   
   	Zend_Loader::loadClass('galerie');
   	$this->view->title = "galerie";
   	$galerie = new galerie();
   	$this->view->galerie = $galerie->fetchAll();
   }
   
   function galerieAction()
   {
   
   	///////////////////////////////////////////// LOGOWANIE //////////////////////////
   	$userek = Zend_Auth::getInstance()->getIdentity();
   	if (null !== $userek) {
   		$l = Zend_Auth::getInstance()->getIdentity()->login;
   	}
   	if($l != 'admin')  $this->_helper->redirector('index');
   	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
   	if ($this->_request->isPost()) {
   		//$this->_helper->redirector('index');
   		Zend_Loader::loadClass('galerie');
   		$this->view->title = "galerie";
   		$galerie = new galerie();
   		$nazwa = $this->_request->getPost('nazwa');
   		$tresc = $this->_request->getPost('tresc');
   		if ($nazwa != " && $tresc != ") {
   			$zrzut = array(
   					'nazwa' => $nazwa,
   					'tresc' => $tresc,
   			);
   			$galerie->insert($zrzut);
   			$this->_helper->redirector('galerielista');
   			return;
   		}
   	}
   	// set up an "empty" album
   	$this->view->dodaj = new stdClass();
   	$this->view->dodaj->id = null;
   	$this->view->dodaj->nazwa = "";
   	$this->view->dodaj->rodzaj = "";
   
   	// additional view fields required by form
   	$this->view->action = 'add';
   	$this->view->buttonText = 'Add';
   
   }
   
   function galerieeditAction()
   {
   
   	///////////////////////////////////////////// LOGOWANIE //////////////////////////
   	$userek = Zend_Auth::getInstance()->getIdentity();
   	if (null !== $userek) {
   		$l = Zend_Auth::getInstance()->getIdentity()->login;
   	}
   	if($l != 'admin')  $this->_helper->redirector('index');
   	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
   	Zend_Loader::loadClass('galerie');
   	$this->view->title = "galerie";
   	$galerie = new galerie();
   	$this->view->title = "myk";
   	$myk = new galerie();
   	 
   	if ($this->_request->isPost()) {
   		//$this->_helper->redirector('index');
   		Zend_Loader::loadClass('Zend_Filter_StripTags');
   		$filter = new Zend_Filter_StripTags();
   		$id = (int)$this->_request->getPost('id');
   	 $nazwa = $this->_request->getPost('nazwa');
   	 $tresc = $this->_request->getPost('tresc');
   	  
   	 if ($id !== false) {
   	 	if ($nazwa != " && $tresc != ") {
   	 		$zrzut = array(
   	 				'nazwa' => $nazwa,
   	 				'tresc' => $tresc,
   	 		);
   	 			
   	 		$where = 'id = ' . $id;
   	 		$myk->update($zrzut, $where);
   	 		$this->_helper->redirector('galerielista');
   	 		return;
   	 	} else {
   	 		$this->_helper->redirector('galerielista');
   	 	}
   	 }
   	} else {
   		$id = (int)$this->_request->getParam('id', 0);
   		if ($id > 0) {
   			$this->view->myk = $galerie->fetchRow('id='.$id);
   		}
   	}
   	$this->view->action = 'edit';
   	$this->view->buttonText = 'Edytuj profil';
   
   }
   
   function galeriedelAction() {
   
   	///////////////////////////////////////////// LOGOWANIE //////////////////////////
   	$userek = Zend_Auth::getInstance()->getIdentity();
   	if (null !== $userek) {
   		$l = Zend_Auth::getInstance()->getIdentity()->login;
   	}
   	if($l != 'admin')  $this->_helper->redirector('index');
   	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
   	Zend_Loader::loadClass('galerie');
   	$this->view->title = "galerie";
   	$galerie = new galerie();
   	if ($this->_request->isPost()) {
   		//$this->_helper->redirector('index');
   		Zend_Loader::loadClass('Zend_Filter_Alpha');
   		$filter = new Zend_Filter_Alpha();
   
   		$id = (int)$this->_request->getPost('id');
   		$del = $filter->filter($this->_request->getPost('del'));
   		if ($del == 'Tak' && $id > 0) {
   			$where = 'id = ' . $id;
   			$rows_affected = $galerie->delete($where);
   		}
   	} else {
   		$id = (int)$this->_request->getParam('id');
   		if ($id > 0) {
   			// only render if we have an id and can find the album.
   			$this->view->galerie = $galerie->fetchRow('id='.$id);
   			if ($this->view->galerie->id > 0) {
   				// render template automatically
   				return;
   			}
   		}
   	}
   	$this->_helper->redirector('galerielista');
   }
  
 //////////////////////////////// AKTUALNOSCI
 
   function aktualnoscilistaAction()
   {
   
   	///////////////////////////////////////////// LOGOWANIE //////////////////////////
   	$userek = Zend_Auth::getInstance()->getIdentity();
   	if (null !== $userek) {
   		$l = Zend_Auth::getInstance()->getIdentity()->login;
   	}
   	if($l != 'admin')  $this->_helper->redirector('index');
   	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
   
   	Zend_Loader::loadClass('aktualnosci');
   	$this->view->title = "aktualnosci";
   	$aktualnosci = new aktualnosci();
   	$this->view->aktualnosci = $aktualnosci->fetchAll();
   }
   
   function aktualnosciAction()
   {
   
   	///////////////////////////////////////////// LOGOWANIE //////////////////////////
   	$userek = Zend_Auth::getInstance()->getIdentity();
   	if (null !== $userek) {
   		$l = Zend_Auth::getInstance()->getIdentity()->login;
   	}
   	if($l != 'admin')  $this->_helper->redirector('index');
   	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
   	if ($this->_request->isPost()) {
   		//$this->_helper->redirector('index');
   		Zend_Loader::loadClass('aktualnosci');
   		$this->view->title = "aktualnosci";
   		$aktualnosci = new aktualnosci();
   		$nazwa = $this->_request->getPost('nazwa');
   		$tresc = $this->_request->getPost('tresc');
   		if ($nazwa != " && $tresc != ") {
   			$zrzut = array(
   					'tytul' => $nazwa,
   					'tresc' => $tresc,
   					'data' => date("Y-m-d"),
   					'czas' => date("H:i:s"),
   			);
   			$aktualnosci->insert($zrzut);
   			$this->_helper->redirector('aktualnoscilista');
   			return;
   		}
   	}
   	// set up an "empty" album
   	$this->view->dodaj = new stdClass();
   	$this->view->dodaj->id = null;
   	$this->view->dodaj->nazwa = "";
   	$this->view->dodaj->rodzaj = "";
   
   	// additional view fields required by form
   	$this->view->action = 'add';
   	$this->view->buttonText = 'Add';
   
   }
   
   function aktualnoscieditAction()
   {
   
   	///////////////////////////////////////////// LOGOWANIE //////////////////////////
   	$userek = Zend_Auth::getInstance()->getIdentity();
   	if (null !== $userek) {
   		$l = Zend_Auth::getInstance()->getIdentity()->login;
   	}
   	if($l != 'admin')  $this->_helper->redirector('index');
   	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
   	Zend_Loader::loadClass('aktualnosci');
   	$this->view->title = "aktualnosci";
   	$aktualnosci = new aktualnosci();
   	$this->view->title = "myk";
   	$myk = new aktualnosci();
   	 
   	if ($this->_request->isPost()) {
   		//$this->_helper->redirector('index');
   		Zend_Loader::loadClass('Zend_Filter_StripTags');
   		$filter = new Zend_Filter_StripTags();
   		$id = (int)$this->_request->getPost('id');
   	 $nazwa = $this->_request->getPost('nazwa');
   	 $tresc = $this->_request->getPost('tresc');
   	 $widoczne = $this->_request->getPost('widoczne');
   	 if($widoczne == null) $widoczne = 0;
   	  
   	 if ($id !== false) {
   	 	if ($nazwa != " && $tresc != ") {
   	 		$zrzut = array(
   	 				'tytul' => $nazwa,
   	 				'tresc' => $tresc,
   	 				'widoczne' => $widoczne,
   	 		);
   	 			
   	 		$where = 'id = ' . $id;
   	 		$myk->update($zrzut, $where);
   	 		$this->_helper->redirector('aktualnoscilista');
   	 		return;
   	 	} else {
   	 		$this->_helper->redirector('aktualnoscilista');
   	 	}
   	 }
   	} else {
   		$id = (int)$this->_request->getParam('id', 0);
   		if ($id > 0) {
   			$this->view->myk = $aktualnosci->fetchRow('id='.$id);
   		}
   	}
   	$this->view->action = 'edit';
   	$this->view->buttonText = 'Edytuj profil';
   
   }
   
   function aktualnoscidelAction() {
   
   	///////////////////////////////////////////// LOGOWANIE //////////////////////////
   	$userek = Zend_Auth::getInstance()->getIdentity();
   	if (null !== $userek) {
   		$l = Zend_Auth::getInstance()->getIdentity()->login;
   	}
   	if($l != 'admin')  $this->_helper->redirector('index');
   	///////////////////////////////////////////// END LOGOWANIE //////////////////////////
   	Zend_Loader::loadClass('aktualnosci');
   	$this->view->title = "aktualnosci";
   	$aktualnosci = new aktualnosci();
   	if ($this->_request->isPost()) {
   		//$this->_helper->redirector('index');
   		Zend_Loader::loadClass('Zend_Filter_Alpha');
   		$filter = new Zend_Filter_Alpha();
   
   		$id = (int)$this->_request->getPost('id');
   		$del = $filter->filter($this->_request->getPost('del'));
   		if ($del == 'Tak' && $id > 0) {
   			$where = 'id = ' . $id;
   			$rows_affected = $aktualnosci->delete($where);
   		}
   	} else {
   		$id = (int)$this->_request->getParam('id');
   		if ($id > 0) {
   			// only render if we have an id and can find the album.
   			$this->view->aktualnosci = $aktualnosci->fetchRow('id='.$id);
   			if ($this->view->aktualnosci->id > 0) {
   				// render template automatically
   				return;
   			}
   		}
   	}
   	$this->_helper->redirector('aktualnoscilista');
   }

}