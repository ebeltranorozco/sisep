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
    
   
    require_once (APPPATH."/third_party/html2pdf/vendor/autoload.php");    
    $html2pdf = new Spipu\Html2Pdf\Html2Pdf(); 

    if (isset($_GET['no'])){
      $nOficio = $_GET['no'];       
      // obtener de seguimiento el ddr porque el programa y componente ya lo se
      $qryDDR = $this->db->query( "select id_programa, id_componente,id_ddr from seguimientos where  no_oficio_remesa_seguimiento = '".$nOficio."'")->row();
      $idPrograma     = $qryDDR->id_programa;
      $idComponente   = $qryDDR->id_componente;
      $idDDR          = $qryDDR->id_ddr;     

      $qryPlantilla = $this->db->query('select plantilla_enc_plantilla,consulta_sql_plantilla from enc_plantillas where id_programa ='.$idPrograma.' and id_componente ='. $idComponente. ' and id_ddr ='. $idDDR)->row();
      if ($qryPlantilla){
        $cHtml = $qryPlantilla->plantilla_enc_plantilla;
        $cConsultaSQL = trim($qryPlantilla->consulta_sql_plantilla). " where no_oficio_remesa_seguimiento ='".$nOficio."'";  
        
        //VIENE AHORA LA COSULTA A LA BASE DE DATOS..!
        $consulta = $this->db->query( $cConsultaSQL )->result_array(); //nos traemos los join necesarios

        // VIENE LA PARTE DE TRADUCCION DE LOS CAMPOS DE LA PLANTILLA 
        
        if ($consulta){          
          // EMPIEZA LO BUENO...
          $nAparicion = 0;
          $nPosParentesisAbre   = strpos($cHtml, '((',$nAparicion);
          $nPosParentesisCierra   = strpos($cHtml, '))',$nAparicion);          
          $aCpo         = array();
          $aCpoVacios       = array();
          while( $nPosParentesisAbre ) {
            
            // posicion del campo a buscar
            if (!$nPosParentesisCierra) {               
              $cHtml='No se encontraron llaves de cierre';break;
            }

            $cCpo = substr($cHtml,$nPosParentesisAbre+2,$nPosParentesisCierra-$nPosParentesisAbre-2);
            $cCpoDecodificado = null;
            if (isset($consulta[0][$cCpo])){
              $cCpoDecodificado = $consulta[0][$cCpo];  
            }           

            // vamos a buscar el CPO en el query de la consulta y hacer la transformacion
            
            if (!empty($cCpoDecodificado)){
              $aCpo[] = array( $cCpo => $cCpoDecodificado );
              $cHtml = substr( $cHtml , 0,$nPosParentesisAbre).  strtoupper($cCpoDecodificado). substr( $cHtml,$nPosParentesisCierra+2); // AQUI SE HACE LA MAGIA
            }else{
              $aCpoVacios = array( $cCpo => 'Verificar en BD');
            }
            
            $nAparicion++;
            $nPosParentesisAbre = strpos($cHtml, '((',$nAparicion);
            $nPosParentesisCierra = strpos($cHtml, '))',$nAparicion);
          } // FIN DEL while




        }else { // CUANDO NOS MARCA ERROR LA CONSULTA JOIN if ($consulta){
          $RespData['STATUS'] = 'ERROR';
          $RespData['MSG_ERROR'] = 'Error al realizar la consulta ['. $cConsultaSQL.']';
          $cHtml = '<p>ERROR</p>'. $RespData['MSG_ERROR'];
        }
      } else {
        $cHtml = 'Plantilla Inexistente para el DDR ['. $idDDR.']';
      }

    } else { // no llego parametro --> if (isset($_GET['id'])){
      $RespData['STATUS'] = 'ERROR';
      $RespData['MSG_ERROR'] = 'parametro no encontrado';
      $cHtml = '<p>ERROR</p>'. $RespData['MSG_ERROR'];
    }

    $html2pdf->writeHTML( $cHtml);
    $html2pdf->output(); 


  }


} // fin del impresiones_controller