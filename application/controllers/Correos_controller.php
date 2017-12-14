<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Correos_controller extends CI_Controller {
 
  public function __construct()  {   	
  	parent::__construct();        
        if (!isset($_SESSION['logeado'])){      
      redirect();     
    }
  }// fin del constructor 
  /************************************************************************************/
  public function enviar_correo_general( $email_from, $email_to, $email_cco, $email_bco,$email_titulo,$email_body,$email_file = null){

  	$config = array(
	 	'protocol' => 'smtp',
	 	'smtp_host' => 'smtp.gmail.com',
	 	'smtp_user' => 'sisep.sagarpa@gmail.com', //Su Correo de Gmail Aqui
	 	'smtp_pass' => 'sagarpa2018', // Su Password de Gmail aqui
	 	'smtp_port' => '465', //587
	 	'smtp_crypto' => 'ssl', //tls
		'mailtype' => 'html',
		'wordwrap' => TRUE,
		'charset' => 'utf-8'
	);
	$this->load->library('email', $config);
	$this->email->set_newline("\r\n");
/*
	
		

        
		
		$this->email->from('cotizaciones@laria.mx','Cotizacion de Ensayos');

		$cMsg .= '<a href="'.base_url().'/recotizar?id='.$idConsulta_Cotizacion.'" >Volver a Cotizar</a>';
		
		$this->email->subject('Aportación de Servicios Generada');	  
		$this->email->message($cMsg);
		$this->email->to($correo,'SRM LARIA en Linea');
		$copia = array ( 'sistemas@laria.mx','vescobar@laria.mx','amenchaca@laria.mx');
		$this->email->bcc( $copia);
		$this->email->attach( $cFile);

		$cFile = 'Cot_'.str_pad( $nidCotizacion,5,'0',STR_PAD_LEFT).'.pdf';
	    $this->pdf->Output($cFile, 'F'); // AQUI ME QUEDE.	    
	    $this->pdf->close();
	    $Resp_data = array();
	    $Resp_data['FILE_COTIZACION'] = $cFile;
*/
	} // fin del enviar email_generar function

  /************************************************************************************/

  /************************************************************************************/

  /************************************************************************************/

  /************************************************************************************/

  /************************************************************************************/

  /************************************************************************************/

  /************************************************************************************/

} // fin del controller
