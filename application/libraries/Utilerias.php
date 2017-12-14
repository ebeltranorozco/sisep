<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Utilerias{

   function index(){

   }
   function Personaliza_ID_MUESTRA( $__cIdMuestra = null){
   	$cRet = $__cIdMuestra;
   		if (!is_null($__cIdMuestra)) {			
      		$nValNumerico  =preg_replace("/[^0-9]/", "", $__cIdMuestra);      	
			$cRet = substr( $__cIdMuestra,0,3 ) . str_pad($nValNumerico,4,'0',STR_PAD_LEFT);			
		}
	return $cRet;   		
   }
   
   function generateRandomString($length = 10) {
	    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	return $randomString;
	}   
   ////////////////////////////////////////////////////
   // FUNCION PERMISO DE ACCESO A TODO EL SISTEMA
   ////////////////////////////////////////////////////
   function permiso( $cMod, $cPer) {
      $_lRet = false;
      if ($_SESSION['user_tipo']=='A') { //si es un administrador
         $_lRet = true;
      }else {
         $_cId = $_SESSION['user_id'];
         $CI =& get_instance();

         $CI->load->model('seguridad_model');
         $_lRet = $CI->seguridad_model->getPermiso($_cId,$cMod,$cPer);
         
      }
      return $_lRet;
   }
   
   ////////////////////////////////////////////////////
   //Convierte fecha de mysql a español
   ////////////////////////////////////////////////////
   function fecha_mysql_a_espanol($fecha){
      ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
      $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
      return $lafecha;
   }

   ////////////////////////////////////////////////////
   //Convierte fecha de español a mysql
   ////////////////////////////////////////////////////
   function fecha_espanol_a_mysql($fecha){
      ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
      $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
      return $lafecha;
   } 

   function prueba(){
      return 'ya chinge';
   }
   /***************************************************************/
   function conv_cadena_float( $cNumero = null){
      //$string = str_replace(".","",$string); //borro los separadores de miles, si hay 
      $string = str_replace(",","",$cNumero); //borro los separadores de miles, si hay 
      settype($string,"float"); // lo convierto en un número 
      return $string;
   }
   /***************************************************************/
   public function divide_cadena( $_cCadena = null,$_nLen) { //debe regresar un arreglo con el total de filas devueltas por el arreglo
	      $mRet = array();
	      $cCad = "";
	      
	      if ($_cCadena) {
	         $_mCadena = explode(' ',$_cCadena);
	         if (strlen($_mCadena[0])<$_nLen) {                       
	            foreach ($_mCadena as $element ){                
	               if (strlen($cCad)+strlen($element)<=$_nLen){ //lo metemos a la variable                   
	                  $cCad = $cCad ." ".$element;
	               }else { //brincamor renglon
	                  array_push($mRet, trim($cCad) );
	                  $cCad = $element;
	               }
	            } // fin del for echar
	            array_push($mRet, trim($cCad) ); // que tal si la cadena es muy corta o es una fraccionada
	         } // fin del if len
	      } // fin del if _mcadena
	      return $mRet;
	   }// fin de la function 
	/***************************************************************/
   
   function separa_cadena( $_cCadena = null,$_nLen) { //debe regresar un arreglo con el total de filas devueltas por el arreglo, se usa en el multicelda del pdf
      $mRet = array();
      $cCad = "";
      
      if ($_cCadena) {
         $_mCadena = explode(' ',$_cCadena);
         if (strlen($_mCadena[0])<$_nLen) {                       
            foreach ($_mCadena as $element ){                
               if (strlen($cCad)+strlen($element)<=$_nLen){ //lo metemos a la variable                   
                  $cCad = $cCad ." ".$element;
               }else { //brincamor renglon
                  array_push($mRet, trim($cCad) );
                  $cCad = $element;
               }
            } // fin del for echar
            array_push($mRet, trim($cCad) ); // que tal si la cadena es muy corta o es una fraccionada
         } // fin del if len
      } // fin del if _mcadena
      return $mRet;
   }// fin de la function 
   /************************************* 2017-12-06 *********************************/
   public function email() {

      $config = Array(
         'protocol' => 'smtp',
         'smtp_host' => 'smtp.gmail.com',
         'smtp_user' => 'sisep.sagarpa', //Su Correo de Gmail Aqui
         'smtp_pass' => 'sagarpa2018', // Su Password de Gmail aqui
         'smtp_port' => '465', //587
         'smtp_crypto' => 'ssl', //tls
         'mailtype' => 'html',
         'wordwrap' => TRUE,
         'charset' => 'utf-8'
      );
      
      $CI = & get_instance();
      //$CI->load->helper('url');
      //$CI->load->library('session');
      $CI->config->item('base_url');

      $CI->load->library('email',$config);

      $subject = 'Bienvenido a mi app';

      $msg = 'Mensaje de prueba';

      $CI->email
         ->from('sisep.sagarpa@gmail.com')
         ->to('sistemas@laria.mx')
         ->subject($subject)
         ->message($msg)
         ->send();

      echo $CI->email->print_debugger();

   } 
   /**************************************************************************/
   public function enviar_correo_general( $email_from, $email_to, $email_bcc=NULL, $email_bco=NULL,$email_titulo='Correo',$email_msg='Mensaje',$email_file = NULL){
   $RespData =  array();


   /*
$ci = get_instance();
$ci->load->library('email');
$config['protocol'] = "smtp";
$config['smtp_host'] = "ssl://smtp.gmail.com";
$config['smtp_port'] = "465";
$config['smtp_user'] = "blablabla@gmail.com"; 
$config['smtp_pass'] = "yourpassword";
$config['charset'] = "utf-8";
$config['mailtype'] = "html";
$config['newline'] = "\r\n";

$ci->email->initialize($config);

$ci->email->from('blablabla@gmail.com', 'Blabla');
$list = array('xxx@gmail.com');
$ci->email->to($list);
$this->email->reply_to('my-email@gmail.com', 'Explendid Videos');
$ci->email->subject('This is an email test');
$ci->email->message('It is working. Great!');
$ci->email->send();
   */
   $config2 = array(
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
   $config = array(
             'protocol' => 'smtp',
             'smtp_timeout' => '60',
             'smtp_host' => 'smtp.googlemail.com',
             'smtp_user' => 'ebeltran@laria.mx', //Su Correo de Gmail Aqui
             'smtp_pass' => 'inf61010', // Su Password de Gmail aqui
             'smtp_port' => '465', //587
             'smtp_crypto' => 'ssl', //tls
             'mailtype' => 'html',
             'wordwrap' => TRUE,
             'charset' => 'utf-8',
             'newline' => "\r\n",
             'crlf' => "\r\n"
          );


   

   if ( $email_from && $email_to){


     //phpinfo();


      $CI = & get_instance();
      //$CI->load->library('email',$config);
      $CI->load->library('email');
      $CI->email->initialize($config);
      
      $CI->email
         ->from('sisep.sagarpa@gmail.com')
         ->to('sistemas@laria.mx')
         ->subject('prueba de un correo')
         ->message('prueba de un mensaje')
         ->send();

      echo $CI->email->print_debugger();
/*      
      //$CI->email->initialize($config);
      $CI->email->set_newline("\r\n");
      $CI->email->from($email_from);
      $CI->email->to($email_to);
      if ($email_bcc) { $CI->email->bcc( $email_bcc); }
      if ($email_bco) { $CI->email->subject($email_titulo); }
      $CI->email->message($email_msg);
      if ($email_file){ $CI->email->attach( $email_file); }

      if (!$CI->email->send() ){         
            $RespData['STATUS'] = 'ERROR';
            $RespData['MSG_ERROR'] = 'Ocurrio un Error al Enviar el Correo \n Volver a Intentar mas Tarde \n Sentimos los inconvenientes';         
            //log_message( 'debug',$CI->email->print_debugger());
            $cRet = $CI->email->print_debugger(array('headers')); //headers, subject, body.
            $RespData['ERROR_CORREO'] = $cRet;
            
         }else {
            $RespData['STATUS'] = 'OK';
         }
*/         
      }else {
         $RespData['STATUS'] = 'ERROR';
         $RespData['MSG_ERROR'] = 'Falta de Parametros';
      }
      

      header('Content-type: application/json; charset=utf-8');
      echo json_encode($RespData);
   } // fin del enviar email_generar function
   /**************************************************************************/
}

