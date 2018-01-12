<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Impresiones_controller extends CI_Controller {
 
  public function __construct()  {   	
  	parent::__construct();        
        if (!isset($_SESSION['logeado'])){      
      redirect();     
    }
  }// fin del constructor   
  public function index(){
    echo 'index';
  } 
  /***************************************************************/
  
  public function generar_oficio_remesa(){ // debe generar un oficio remesa
    $RespData = array();
    if (!$this->input->is_ajax_request()) { 
      $RespData['STATUS'] = 'ERROR';
      $RespData['MSG_ERROR'] = 'No direct script access allowed';      
    }else {
      //var data = { enc:{'id_programa':id_programa,'id_componente': id_componente,'id_ddr':id_ddr},det:[]}

      $enc = isset($_POST['enc']) ? $_POST['enc'] : false; //condicion si existe que tome la variable si no lo 
      $det = isset($_POST['det']) ? $_POST['det'] : false;  

      if ($enc && $det) {

        $id_programa    = $enc['id_programa'];
        $id_componente  = $enc['id_componente'];
        $id_ddr         = $enc['id_ddr'];

        // buscando exista plantilla
        $this->db->select('*');
        $this->db->from('enc_plantillas');
        $this->db->join('correos_plantilla','enc_plantillas.id_enc_plantilla = correos_plantilla.id_enc_plantilla','left');
        $this->db->where('id_programa',$id_programa);
        $this->db->where('id_componente',$id_componente);
        $this->db->where('id_ddr',$id_ddr);
        $qryTmp = $this->db->get()->row();

        if ($this->db->affected_rows()>0){
          $RespData['STATUS'] = 'OK';
          $RespData['PLANTILLA'] =  $qryTmp->plantilla_enc_plantilla;
          $RespData['NOMBRE_PLANTILLA'] = $qryTmp->nombre_enc_plantilla;
        }else{        
          $RespData['STATUS'] = 'ERROR';
          $RespData['MSG_ERROR'] = 'consulta no arrojo resultados';  
        }


      }else{        
        $RespData['STATUS'] = 'ERROR';
        $RespData['MSG_ERROR'] = 'información llego incompleta';     
      }
    }
    header('Content-type: application/json; charset=utf-8');    
    echo json_encode($RespData); 
    //echo $RespData['PLANTILLA'];
  }
  /***********************************************************************************/
  public function generar_oficio_remesa2(){
    $RespData = array();
    $RespData['STATUS'] = 'ERROR';
    $RespData['MSG_ERROR'] = 'información llego incompleta';
    header('Content-type: application/json; charset=utf-8');    
    echo json_encode($RespData); 
  }
  /**************************************************************************************/
  public function correo_prueba(){ // una funcion para probar la utileria de enviar correos.
    //enviar_correo_general( $email_from, $email_to, $email_bcc, $email_bco,$email_titulo,$email_msg,$email_file = null){
    //enviar_correo_general(                               $email_from,          $email_to, $email_bcc=null, $email_bco=null,$email_titulo='Correo',$email_msg='Mensaje',$email_file = null){
     //$this->utilerias->enviar_correo_general( 'sisep.sagarpa@laria.mx','sistemas@laria.mx',                ,                ,   'Titulo del Correo','Mensaje del Correo');
    $cRet = $this->utilerias->enviar_correo_general( 'sisep.sagarpa@laria.mx','sistemas@laria.mx');
    var_dump($cRet);

  }
  /****************************************************************************************/
  public function procesaygenera_oficio_remesa(){

    $this->load->library('pdf');
    $this->pdf = new pdf( 'prueba de encabvezado' ); 


    $this->pdf->AddPage('P','letter'); //l landscape o P normal
    $this->pdf->SetFillColor(237, 237, 237);
    $this->pdf->AliasNbPages();

    $this->pdf->SetFont('Arial','',8);
    $cHtml = '<p>prueba de un parrafo HTML</p>';
    $cHtml .= '<br />';
    $cHtml .= '<div id="prueba"><p>esto es un div especial </p></div>';



    
    //$this->pdf->cellHtml(60,20,$cHtml,1,'C' ,1 );
    $this->pdf->WriteHTML($cHtml);


    $this->pdf->SetDisplayMode('fullpage','single');
    $cNombreArchivo = date('y')."-".'oficio_remesa';
    $this->pdf->Output($cNombreArchivo,'I');



  }

} // fin del impresiones_controller