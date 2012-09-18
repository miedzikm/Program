<?php

class KontaktController extends Zend_Controller_Action
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
    	

    	if ($this->_request->isPost()) {
      Zend_Loader::loadClass('Zend_Filter_StripTags');
      $filter = new Zend_Filter_StripTags();

      $maill = $filter->filter($this->_request->getPost('mail'));
      $maill = trim($maill);
	  $tytul = $filter->filter($this->_request->getPost('tytul'));
      $tytul = trim($tytul);
	  $tresc = $filter->filter($this->_request->getPost('tresc'));
      $tresc = trim($tresc);
      $odp = $filter->filter($this->_request->getPost('odp'));
      $odp = trim($odp);
      $skad = $filter->filter($this->_request->getPost('skad'));
      $skad = trim($skad);
      
      if($odp == 'tak') {
      	$wysylka = "Klient czeka na odpowiedź <br/>Dowiedział się o stronie z: ".$skad."<br/>Treść wiadomości<br/>".$tresc;
      }
      else {
      	$wysylka = "Klient nie czeka na odpowiedź <br/>Dwiedział się o stronie z: ".$skad."<br/>Treść wiadomości<br/>".$tresc;
      }
      
      
      /////////////////////////////////////////////////////////// WYSYŁKA //////////////////////////////////
      $tresc = '
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>SP STUDIO</title>
	<style type="text/css">
		.div01 { width: 399px; padding: 8px; background: url(http://fontini.domimedia.com.pl/mcms/images/niania.png) top no-repeat; font-family: Tahoma; font-size: 12px; color: #686868; }
		.div02 { width: 399px; height: 72px; margin-bottom: 8px; align: center; text-align: center; }
		.div03 { width: 371px; padding: 12px; background-color: #ececec; border: 1px solid #e6e6e6; text-align: justify; }
		.zaokraglenie { -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; }
		h1 { color: #71497f; font-family: Tahoma; font-size: 12px; }
	</style>
</head>

<body>
	<div class="div01 zaokraglenie">
		<div class="div02">
			
		</div>
		<div class="div03 zaokraglenie">
			<b>Wiadomość z formularza kontaktowego:</b><br/>
			'.$wysylka.'
		</div>
	</div>
</body>
</html>
      ';
      
      //$tresc = $tytul.' <br/>'.$tresc;
        $podpis = $maill;
        $email = $maill;

		$adresat = 'biuro@domimedia.pl';

	// koniec sprawdzania, wysylamy emaila

        require_once('/homez.57/domimedi/www/portal/fontini/library/phpmailerx/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP(); // send via SMTP
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Host = "mail.miedzinski.net";
        $mail->Port  = 587;
        $mail->Mailer= "smtp";
		$SMTPDebug = true;
		//$mail->SMTPSecure = "tls";
		//$mail->SMTPSecure   = "starttls";
        $mail->Username = "mail@miedzinski.net"; // SMTP username
        $mail->Password = "mailem3"; // SMTP password
        $mail->AddReplyTo ($email, $podpis);
        $mail->From = $email;
        $mail->FromName = $podpis;
        $mail->Subject = $tytul;
        $mail->Body = $tresc;
        $mail->WordWrap = 50;
        $mail->AddAddress ($adresat);
        $mail->IsHTML (true);
        $mail->SetLanguage("pl","/homez.57/domimedi/www/portal/fontini/library/phpmailerx/language");
        $mail->CharSet = 'utf-8';

        if(!$mail->Send())
        { echo "Błąd wysyłania: " . $mail->ErrorInfo; }
        else
        { echo "Wiadomość została wysłana."; }
         

         //////////////////////////////////////////////// KONIEC WYSYŁKI //////////////////////////////
         
         
         
         
		  $this->_helper->redirector('wyslano');
         return;
    	}
    }
    
    
    
	function wyslanoAction() 
    {
    	
    	Zend_Loader::loadClass('statyczne');
    	$this->view->title = "statyczne";
    	$statyczne = new statyczne();
    	$this->view->statyczne = $statyczne->fetchAll();
    }
    

}