<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Impresiones_controller extends CI_Controller {
 
  public function __construct()  {   	
  	parent::__construct();        
        if (!isset($_SESSION['logeado'])){      
      redirect();     
    }
  }// fin del constructor    
  /***************************************************************/
  public function idr_microbiologia( $idDetalleMuestra = null) {
  	// lo primero es obtener los datos necesarios ..!
  	$this->db->select('*');
  	$this->db->from('detalle_muestras');
  	$this->db->join('recepcion_muestras','detalle_muestras.ID_RECEPCION_MUESTRA = recepcion_muestras.ID_RECEPCION_MUESTRA');
  	$this->db->join('clientes','recepcion_muestras.ID_CLIENTE = clientes.ID_CLIENTE');
  	$this->db->join('estudios','detalle_muestras.ID_ESTUDIO = estudios.ID_ESTUDIO');
  	$this->db->join('idr_microbiologia','detalle_muestras.ID_METODOLOGIA = idr_microbiologia.ID_METODOLOGIA');
	  $this->db->join('usuarios','idr_microbiologia.ID_USUARIO_SIGNATARIO = usuarios.ID_USUARIO');   	  	
    $this->db->where('detalle_muestras.ID_DETALLE_MUESTRA',$idDetalleMuestra);   
    
    $query = $this->db->get();    
  	$data = $query->result();
  	
  	// fin de la obtencion de los datos necesarios ..!
  	  	 
  	if (count($data)== 0) {
        echo '<script>alert("Error Folio ['.$idDetalle_Muestra.' ] Inexistente" );</script>';
        exit();        
    }
          	
    //$IDR                = $data[0]->ID_RECEPCION_MUESTRA;
    $dFechaEmision      = date('Y-m-d h:m:s');
    $IDR				= $data[0]->ID_IDR;
    $idMuestra          = $data[0]->ID_MUESTRA;
    //$cFolioSolicitud	= $data[0]->FOLIO_SOLICITUD;
    
    
    
    // EMPEZAMOS EL PDF
    $this->load->library('pdf');
    $this->pdf = new pdf( $cMetodoValidado ); //  
  } // fin del informe de micro borrar temporal
  /****************************************************************/
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
        }else{        
          $RespData['STATUS'] = 'ERROR';
          $RespData['MSG_ERROR'] = 'consulta no arrojo resultados';  
        }


        /*
        $detallado = $det[0];
        for ($nPos=0;$nPos<count($detallado);$nPos+=2){
          
          $id_padron_beneficiario   = $detallado[$nPos];
          $data[] = $datos_detallado;
          
        } // fin del for
        */

        /*
        $qryTmp = $this->db->update_batch('seguimientos',$data,'id_padron_beneficiario');
        $cSql = $this->db->last_query();
        $RespData['SQL'] = ' tabla seguimientos:['.$cSql."] ";
        $RespData['RESULTADO_DET'] = $this->db->affected_rows();
        
        
        if ($this->db->affected_rows()>0){
          $RespData['STATUS'] = 'OK';
          $RespData['CONSULTA'] = $qryTmp;
        }else{
          $RespData['STATUS'] = 'ERROR';
          $RespData['MSG_ERROR'] = 'No hay registros';     
        }
        */
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

} // fin del impresiones_controller