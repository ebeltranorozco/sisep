<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Seguimiento_controller extends CI_Controller {
 
	 public function __construct() {
 		parent::__construct();        
    	if (!isset($_SESSION['logeado'])){      
      		redirect();     
 		}
 	}
 	/****************************************************************************/
 	public function apertura(){ // INDICA QUE SE VA A REALIZAR UN NUEVO OFICIO DE APERTURA o SE VA A VISUALIZAR NADA MAS
 		$data = new stdClass();
		$data->menu_activo = 'tercero';		
		$data->accion = 'ALTA';
		$data->panel_title = 'Listado de Autorizaciones (Oficios de Apertura)';
		$data->page_title = 'SISEP';

 		$accion = 'ALTA'; 		
 		$cNoOficioAperturaSeguimiento = "99999999999999";
 		if (isset($_GET['id'])){
 			$id_seguimiento=$_GET['id']; 			
 			$data->accion = 'VISUALIZACION'; 			

 			//2017-12-27 con el id_seguimiento obtenemos el numero de oficio deseado..!
 			$qryOficios = $this->db->query('select no_oficio_apertura_seguimiento,fecha_oficio_apertura_seguimiento,fecha_acuse_apertura_seguimiento from seguimientos where id_seguimiento = '.$id_seguimiento)->row();
 			$cNoOficioAperturaSeguimiento = $qryOficios->no_oficio_apertura_seguimiento;
 			$data->oficios = $qryOficios; //--> para la parte de los encabezados de la vista individual
 		} 		

 		$this->load->library('table');
 		
 		//<table id="table_id_componente" class="table table-striped table-bordered" cellspacing="0" width="100%">
 		//'table_open'          => '<table border="0" class="table table-condensed" cellpadding="4" cellspacing="0" id="idTablaTmpDetalleSeguimiento">',
 		$template = array (
            'table_open'          => '<table border="0" class="table table-striped table-bordered" cellpadding="4" cellspacing="0" id="idTablaTmpDetalleSeguimiento">'
      	);	

		
 		$this->table->set_template($template);	

 		//$this->db->select('id_seguimiento,folio_interno_seguimiento,folio_suri_seguimiento,concepto_seguimiento,sistema_producto_seguimiento,,aportacion_federal_seguimiento,aportacion_productor_seguimiento,""');
 		$this->table->set_heading('ID','Nombre','SURI','ID Concepto','Concepto','DDR','HAS','Apoyo','Aportacion','Acciones');

 		$this->db->select('id_padron_beneficiario,nombre_beneficiario_seguimiento,folio_suri_seguimiento,seguimientos.id_concepto,nombre_concepto,id_ddr,has_seguimiento,aportacion_federal_seguimiento,aportacion_productor_seguimiento');
		$this->db->from('seguimientos');
		$this->db->join('conceptos_inversion','seguimientos.id_concepto = conceptos_inversion.id_concepto','LEFT');			
		$this->db->where('no_oficio_apertura_seguimiento',$cNoOficioAperturaSeguimiento);

		$cCad = $this->db->get_compiled_select();
		$qryBeneficiarios = $this->db->query($cCad)->result_array();		
		if($data->accion == 'VISUALIZACION'){
			$data->no_oficio_apertura_seguimiento =  $cNoOficioAperturaSeguimiento;
		}
		$data->consulta = $qryBeneficiarios;// proviene del detallado de resultados..!
		$data->sql = $cCad; // CONOCER LA CONSULTA QUE LO ESTA EJECUTANDO..!
		// GENERANDO EL DROP DE EL CONCEPTO
		
		//function listData($table,$name,$value,$orderBy=null, $where_nombre_campo=null, $where_variable=null) {
		//function listData($table,$name,$value,$orderBy=null, $where_nombre_campo=null, $where_variable=null) {
		$data->ConceptosFederalesCombo = listData('conceptos_inversion','nombre_concepto', 'id_concepto'); 		

 		$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		
		$this->load->view('seguimiento/v_apertura_individual',$data);
		$this->load->view('plantillas/footer',$data);
 	}
 	/****************************************************************************/
 	public function listado_autorizaciones(){

		$data = new stdClass();
		$data->menu_activo = 'tercero';		
		$data->accion = 'ALTA';
		$data->panel_title = 'Listado de Autorizaciones (Oficios de Apertura)';
		$data->page_title = 'SISEP';
		$id = 2; // temporal		
		
		$qryOficios = $this->db->query('select * from seguimientos');// filtrar por componente		
		$data->oficios_apertura=$qryOficios->result();	 	

	 	$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		
		$this->load->view('seguimiento/v_apertura_global',$data);
		$this->load->view('plantillas/footer',$data);	 	
 	}
 	/******************************************************/
 	public function buscar_beneficiarios(){  // BUEN SCRIPT AJAX REQUEST
 		$RespData = array();
 		if (isset($_POST['nombre']) ){
 			$nombre = $_POST['nombre'];
 			$qryConsulta = $this->db->query('select * from siseppadronbeneficiarios where id_componente ='.$_SESSION['id_componente'].' and	nombre_solicitante like "'.$nombre.'%"')->result_array();
 			if ($this->db->affected_rows()>0){
 				$RespData['CONSULTA'] = $qryConsulta;
 				$RespData['STATUS'] = 'OK';
 			}else { 
 				$RespData['STATUS'] = 'ERROR';
 				$RespData['ERROR'] = 'modifique criterio de busqueda ';
 			} 		

 		}else{	$RespData['ERROR'] = 'no es un scrip ajax'; $RespData['STATUS']= 'ERROR';}
 		
 		header('Content-type: application/json; charset=utf-8');
 		echo json_encode($RespData);    
 	}
 	/***************************************************************/
 	public function graba_oficio_apertura(){
 		$RespData = array();
 		if (!$this->input->is_ajax_request()) {
 			$RespData['STATUS'] = 'ERROR';
 			$RespData['MSG_ERROR'] = 'No direct script access allowed';
 		  	//exit('No direct script access allowed');
		}else {
			//captando las variables
			$enc = isset($_POST['enc']) ? $_POST['enc'] : false;
			$det = isset($_POST['det']) ? $_POST['det'] : false;	
			//$enc = $this->input->post( 'enc');
			//$det = $this->input->post( 'det');
			if ($enc && $det)	{
				$this->db->trans_begin();

				$detallado = $det[0];
				for ($nPos=0;$nPos<count($detallado);$nPos+=9){

					$id_padron_beneficiario  = $detallado[$nPos];
                    $nombre_beneficiario     = $detallado[$nPos+1];
                    $folio_suri              = $detallado[$nPos+2];
                    $id_concepto             = $detallado[$nPos+3];
                    $concepto                = $detallado[$nPos+4];
                    $ddr                     = $detallado[$nPos+5];
                    $haz                     = $detallado[$nPos+6];
                    $apoyo                   = $detallado[$nPos+7];
                    $aportacion              = $detallado[$nPos+8];

                    $data =  array(
						'id_padron_beneficiario'			=> $id_padron_beneficiario,
						'id_programa'						=> $_SESSION['id_programa'],
						'id_componente'						=> $_SESSION['id_componente'],
						'id_ddr'							=> $ddr,
						'id_concepto'						=> $id_concepto,
						'folio_suri_seguimiento' 			=> $folio_suri,
						'nombre_beneficiario_seguimiento' 	=> $nombre_beneficiario,
						'has_seguimiento'					=> $haz,
						'aportacion_federal_seguimiento'	=> $apoyo,
						'aportacion_productor_seguimiento'	=> $aportacion,
						'no_oficio_apertura_seguimiento'	=> $enc['no_oficio'],
						'fecha_oficio_apertura_seguimiento'	=> $enc['fecha_oficio'],
						'fecha_acuse_apertura_seguimiento'	=> $enc['fecha_acuse']
					);
					// buscando con el folio suri y el id_componente la accion a ajercer
					$this->db->select('*');
					$this->db->from('seguimientos');
					$this->db->where( 'id_componente', $_SESSION['id_componente']);
					$this->db->where( 'nombre_beneficiario_seguimiento', $nombre_beneficiario);
					$qryTmp = $this->db->get()->row();
					$RespData['SQL_ACCION'] = $this->db->last_query();
					$RespData['QUERY_SEGUIMIENTO'] = $qryTmp;
					$accion = 'ALTA';
					if (!is_null($qryTmp)){ $accion = 'EDICION'; $id_seguimiento=$qryTmp->id_seguimiento;}

					if ($accion == 'EDICION') {						
						//$this->db->where( 'id_seguimiento', $id_seguimiento);
						$cSql = $this->db->set($data)->get_compiled_update('seguimientos');
					}else {
						$cSql = $this->db->set($data)->get_compiled_insert('seguimientos');
					}

					$this->db->query( $cSql) ;
					$RespData['SQL']  = $cSql;
					if ($this->db->trans_status() === FALSE) {	break; }

				}// fin del for de la tabla que graba el oficio de apertura

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					$RespData['STATUS'] = 'ERROR';
					$RespData['MSG_ERROR'] = $this->db->_error_message();			        	
			    } else {        
			       	$this->db->trans_commit();
			       	$RespData['STATUS'] = 'OK';    
			       	 

			    }
				
			}else {
				$RespData['STATUS'] = 'ERROR';
				$RespData['MSG_ERROR'] = 'información recibida esta incompleta; verifique parametros enviados';
			}
		} 
		header('Content-type: application/json; charset=utf-8');
 		//header('Content-type: application/json;');
 		echo json_encode($RespData); 
 	}
 	/***********************************************************************/
 	public function enviar_correo_oficio_apertura(){ // se trata de generar el correo e indicar las cartas de autorizacion que vienen
 		$RespData = array();

 		$this->load->library('utilerias'); 	
 		
 		if (!$this->input->is_ajax_request()) {
 			$RespData['STATUS'] = 'ERROR';
 			$RespData['MSG_ERROR'] = 'No direct script access allowed';
 		  	//exit('No direct script access allowed');
		}else {
			//captando las variables
			$enc = isset($_POST['enc']) ? $_POST['enc'] : false;
			$det = isset($_POST['det']) ? $_POST['det'] : false;	
			
			if ($enc && $det)	{

				$msg_correo = '';
				$msg_correo .= 'SAGARPA';
				$msg_correo .= '<br/>';
				$msg_correo .= 'SISEP';
				$msg_correo .= '<br/>';
				$msg_correo .= 'Listado de Autorizaciones (oficio de aperturas)';				
				$msg_correo .= '<br/>';
				$msg_correo .= 'Oficio: '.$enc['no_oficio'];						
				$msg_correo .= '<br/>';
				$msg_correo .= 'Fecha del Oficio: '.$enc['fecha_oficio'];
				$msg_correo .= '<br/>';
				$msg_correo .= 'Cartas de Autorización Recibidas<br/>';	
				$msg_correo .= '<br/>';
				$msg_correo .= '<table><thead>';
				$msg_correo .= '<tr>';
				$msg_correo .= '<th>Nombre</th>';
				$msg_correo .= '<th>SURI</th>';
				$msg_correo .= '<th>Concepto</th>';
				$msg_correo .= '<th>DDR</th>';
				$msg_correo .= '<th>HAS</th>';
				$msg_correo .= '<th>Apoyo</th>';
				$msg_correo .= '<th>Aportacion</th>';
				$msg_correo .= '</tr>';
				$msg_correo .= '</thead><tbody>';		
				

				$detallado = $det[0];
				for ($nPos=0;$nPos<count($detallado);$nPos+=9){

					$id_padron_beneficiario  = $detallado[$nPos];
                    $nombre_beneficiario     = $detallado[$nPos+1];
                    $folio_suri              = $detallado[$nPos+2];
                    $id_concepto             = $detallado[$nPos+3];
                    $concepto                = $detallado[$nPos+4];
                    $ddr                     = $detallado[$nPos+5];
                    $haz                     = $detallado[$nPos+6];
                    $apoyo                   = $detallado[$nPos+7];
                    $aportacion              = $detallado[$nPos+8];

                    $msg_correo .= '<tr>';                    
                    $msg_correo .= '<td>'.$nombre_beneficiario.'</td>';
                    $msg_correo .= '<td>'.$folio_suri.'</td>';
                    $msg_correo .= '<td>'.$concepto.'</td>';
                    $msg_correo .= '<td>'.$ddr.'</td>';
                    $msg_correo .= '<td>'.$haz.'</td>';
                    $msg_correo .= '<td>'.$apoyo.'</td>';
                    $msg_correo .= '<td>'.$aportacion.'</td>';
                    $msg_correo .= '</tr>';

				}// fin del for de la tabla que graba el oficio de apertura
				$msg_correo .= '</tbody></table>';

				//buscando en las plantillas a quien debe ir ese correo --> 2017-12-27
				$this->db->select('to_correo_plantilla,cc_correo_plantilla,cco_correo_plantilla,titulo_correo_plantilla');
				$this->db->from('correos_plantilla');
				$this->db->join('enc_plantillas','correos_plantilla.id_enc_plantilla = enc_plantillas.id_enc_plantilla');
				$this->db->where('nombre_enc_plantilla','CORREO CONFIRMACION OFICIO APERTURA');
				$qryCorreos = $this->db->get()->row();

				if ($qryCorreos){
					$email_to = $qryCorreos->to_correo_plantilla;
					//$RespData['EMAIL_TO'] = $email_to;					
					$email_cco =  $qryCorreos->cc_correo_plantilla;					
					$email_bco = $qryCorreos->cco_correo_plantilla;
					$email_subject = 'oficio de apertura recibido';
					if ($qryCorreos->titulo_correo_plantilla<>""){
						$email_subject = $qryCorreos->titulo_correo_plantilla;	
					}
					//$RespData['SUBJECT_CORREO'] = $qryCorreos->titulo_correo_plantilla;
					

					$this->load->library('utilerias');
			       	$cResp_Correo = $this->utilerias->enviar_correo_general($email_to,$email_subject,$msg_correo,$email_cco,$email_bco);
			       	
			       	//$RespData['EMAIL_CCO'] = $email_cco;

			       	if ($cResp_Correo<>'OK'){
			       		$RespData['STATUS'] = 'ERROR';
			       		$RespData['MSG_ERROR'] = $cResp_Correo;
			       	}else {
			       		$RespData['STATUS'] = 'OK';
			       	}



				}


				// ahora si mandando el correo
			    
		       	//( $email_from = 'sisep.sagarpa@gmail.com', $email_to, $email_subject='Correo SISEP',$email_msg='Sin cuerpo en el Mensaje',$email_bcc=NULL, $email_bco=NULL,$email_file = NULL){   
		       	
			    
				
			}else {
				$RespData['STATUS'] = 'ERROR';
				$RespData['MSG_ERROR'] = 'información recibida esta incompleta; verifique parametros enviados';
			}
		} 
		
		header('Content-type: application/json; charset=utf-8'); 		
 		echo json_encode($RespData); 
 	}

 	/***********************************************************************/
 	public function enviar_correo(){

 	}
 	/***********************************************************************/
 	public function registro_cartas_autorizacion(){ // segunda opcion de menu alta de cartas de aceptacion indivual


 		////////////////////////////////////////////////////////////////////////////
 		$data = new stdClass();
		$data->menu_activo = 'tercero';		
		$data->accion = 'ALTA';
		$data->panel_title = 'Registro de Cartas de Autorizacion';
		$data->page_title = 'SISEP';
		$id_ddr = 133; // temporal		
		
		$cNoOficioRemesaSeguimiento = "99999999999999";
 		if (isset($_GET['id'])){
 			$id_seguimiento=$_GET['id']; 			
 			$data->accion = 'VISUALIZACION'; 			

 			//2017-12-27 con el id_seguimiento obtenemos el numero de oficio deseado..!
 			$qryOficios = $this->db->query('select no_oficio_remesa_seguimiento,fecha_oficio_remesa_seguimiento,fecha_acuse_remesa_seguimiento from seguimientos where id_seguimiento = '.$id_seguimiento)->row();
 			$cNoOficioAperturaSeguimiento = $qryOficios->no_oficio_remesa_seguimiento;
 			$data->oficios = $qryOficios; //--> para la parte de los encabezados de la vista individual
 		}


 		/*
		$this->load->library('table'); 		

 		$template = array (
            'table_open'          => '<table id="idTablaTmpDetalleCartasAperturaDDR" border="0" class="table table-condensed table-bordered" cellpadding="4" cellspacing="0" >'
      	);		
 		$this->table->set_template($template);

 		$this->table->set_heading('ID','Nombre','SURI','ID Concepto','Concepto','DDR','HAS','Apoyo','Aportacion','Acciones');
		
 		$cCpo = 'id_padron_beneficiario,nombre_beneficiario_seguimiento,folio_suri_seguimiento,seguimientos.id_concepto,nombre_concepto,id_ddr,has_seguimiento,aportacion_federal_seguimiento,aportacion_productor_seguimiento';
		$cCpo .= ',';			
		$cBtn = '"<button type=button name=btnSelecionaCartaApertura  class="'.'"btn btn-info btn-xs"'.'"   onclick="'.'"SeleccionaRowDetalladoCartasApertura(this,0)"'.'" >Seleccionar"';
		$cBtn .= '"</button>"';
		$cCpo .= $cBtn;
		$this->db->select( $cCpo);
		*/	
		
		$this->db->select( '*');
 		$this->db->from('seguimientos');
 		$this->db->join('conceptos_inversion','seguimientos.id_concepto = conceptos_inversion.id_concepto','LEFT');
 		if ($data->accion=='VISUALIZACION'){
 			$this->db->where ('id_seguimiento',$id_seguimiento);
 		}
 		$cSql = $this->db->get_compiled_select();
		$qryCartas = $this->db->query($cSql)->result();	
		//$data->cartas_aceptacionTmp=$qryCartas;
		$data->cartas_aceptacion = $qryCartas;
		$data->sql = $cSql;

		/*
		$template2 = array (
            'table_open'          => '<table id="idTablaDetalleCartasAperturaDDR" border="0" class="table table-condensed table-bordered" cellpadding="4" cellspacing="0" >'
      	);		
 		$this->table->set_template($template2);
 		$this->table->set_heading('ID','Nombre','SURI','ID Concepto','Concepto','DDR','HAS','Apoyo','Aportacion','Acciones');		
		*/

		$data->DDRCombo = listData('ddrs_federales','nombre_ddr', 'id_ddr'); 				

	 	$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		
		$this->load->view('seguimiento/v_registro_cartas_aceptacion_individual',$data);
		$this->load->view('plantillas/footer',$data);	
 	}
 	/*************************************************************************/
 	public function listado_cartas_autorizacion(){ // segunda opcion de menu  --> oficio remesa

 		$data = new stdClass();
		$data->menu_activo = 'tercero';		
		$data->accion = 'ALTA';
		$data->panel_title = 'Listado de Cartas de Autorizaciones (Oficios de Remesa)';
		$data->page_title = 'SISEP';		
		
		$qryOficios = $this->db->query("select * from seguimientos where no_oficio_remesa_seguimiento <> '' and id_componente = ". $_SESSION['id_componente']);		// quizas deba limitar a 3 campos oficio_remesa_seguimiento // acuse / ty otra fecha
		$data->oficios_remesa=$qryOficios->result();	 	

	 	$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		
		$this->load->view('seguimiento/v_registro_cartas_aceptacion_global',$data);
		$this->load->view('plantillas/footer',$data);
 	}
 	/*************************************************************************/
 	public function obtener_cartas_apertura(){ // is ajax, retorna las cartas de un ddr que no han sido seleccionadas
 		if (!$this->input->is_ajax_request()) {
 			$RespData['STATUS'] = 'ERROR';
 			$RespData['MSG_ERROR'] = 'No direct script access allowed'; 		 
		}else {
			$id_ddr = 0;
			if (isset($_POST['id_ddr'])){ $id_ddr = $_POST['id_ddr']; }
			$this->db->select('*');
			$this->db->from('seguimientos');
			$this->db->join('conceptos_inversion','seguimientos.id_concepto = conceptos_inversion.id_concepto','left');			
			$this->db->where( 'id_ddr',$id_ddr);
			//$this->db->where ('no_oficio_remesa') // isnull 
			//where('archived IS NOT NULL', null, false)
			//$this->db->where(array('archived' => NULL));
			//produces
			//WHERE `archived` IS NULL 
			$qryTmp = $this->db->get()->result(); // despues validare con los que estan vacios
			$RespData['SQL'] = $this->db->last_query();
			if ($this->db->affected_rows()>0){
				$RespData['STATUS'] = 'OK';
				$RespData['CONSULTA'] = $qryTmp;
			}else{
				$RespData['STATUS'] = 'ERROR';
 				$RespData['MSG_ERROR'] = 'No hay registros'; 		 
			}
		}
		header('Content-type: application/json; charset=utf-8'); 		
 		echo json_encode($RespData); 
 	} 
 	/*******************************************************************************/
 	public function grabar_oficio_remesa(){ // is ajax, actualiza los campos no_oficio_remesa_seguimiento y fechas en tabla seguimientos
 		$RespData = array();
 		if (!$this->input->is_ajax_request()) {
 			$RespData['STATUS'] = 'ERROR';
 			$RespData['MSG_ERROR'] = 'No direct script access allowed'; 		 
		}else {
			//var data = { 'no_oficio_apertura':no_oficio_apertura,'fecha_oficio_apertura': fecha_oficio_apertura,'fecha_acuse_oficio_apertura':fecha_acuse_oficio_apertura};

			$enc = isset($_POST['enc']) ? $_POST['enc'] : false; //condicion si existe que tome la variable si no lo 
			$det = isset($_POST['det']) ? $_POST['det'] : false;	

			if ($enc && $det)	{

				$no_oficio_remesa_seguimiento 		= $enc['no_oficio_apertura'];
				$fecha_oficio_remesa_seguimiento 	= $enc['fecha_oficio_apertura'];
				$fecha_acuse_remesa_seguimiento 	= $enc['fecha_acuse_oficio_apertura'];

				$detallado = $det[0];
				for ($nPos=0;$nPos<count($detallado);$nPos+=2){
					
					$id_padron_beneficiario 	= $detallado[$nPos];
					
					$datos_detallado = array (
						'id_padron_beneficiario'			=> $id_padron_beneficiario,
						'no_oficio_remesa_seguimiento'		=> $no_oficio_remesa_seguimiento,
						'fecha_oficio_remesa_seguimiento'	=> $fecha_oficio_remesa_seguimiento,
						'fecha_acuse_remesa_seguimiento'	=> $fecha_acuse_remesa_seguimiento
					); 
					$data[] = $datos_detallado;
					
				} // fin del for

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
			}else{
				$RespData['STATUS'] = 'ERROR';
	 			$RespData['MSG_ERROR'] = 'información llego incompleta'; 		 
			}
		}
		header('Content-type: application/json; charset=utf-8'); 		
 		echo json_encode($RespData); 
 	} 
 	/*******************************************************************************/
 	public function actualiza_fecha_acuse_oficio_apertura(){ // is ajax --> actualiza desde un modal la fecha de acuse 
 		$RespData = array();
 		if (!$this->input->is_ajax_request()) {
 			$RespData['STATUS'] = 'ERROR';
 			$RespData['MSG_ERROR'] = 'No direct script access allowed'; 		 
		}else {
			//var data = { 'no_oficio_apertura':no_oficio_apertura,'fecha_oficio_apertura': fecha_oficio_apertura,'fecha_acuse_oficio_apertura':fecha_acuse_oficio_apertura};

			if (isset($_POST['no_oficio_apertura']) && isset($_POST['fecha_acuse_oficio_apertura'])){
				$no_oficio_apertura = "'".$_POST['no_oficio_apertura']."'";
				$dFechaAcuse = "'".$_POST['fecha_acuse_oficio_apertura']."'";

				$this->db->query('update seguimientos set fecha_acuse_apertura_seguimiento = '.$dFechaAcuse . ' where no_oficio_apertura_seguimiento = '. $no_oficio_apertura);
				$RespData['SQL'] = $this->db->last_query();

				if ($this->db->affected_rows()>0){
					$RespData['STATUS'] = 'OK';
					//$RespData['CONSULTA'] = $qryTmp;
				}else{
					$RespData['STATUS'] = 'ERROR';
	 				$RespData['MSG_ERROR'] = 'No hay registros'; 		 
				}
			}else{
				$RespData['STATUS'] = 'ERROR';
	 			$RespData['MSG_ERROR'] = 'parametros llegaron incompletos';
			}
		}
		header('Content-type: application/json; charset=utf-8'); 		
 		echo json_encode($RespData); 
 	} 	
 	/*******************************************************************************/ 	
 	public function actualiza_fecha_acuse_oficio_remesa(){ // is ajax --> actualiza desde un modal la fecha de acuse 
 		$RespData = array();
 		if (!$this->input->is_ajax_request()) {
 			$RespData['STATUS'] = 'ERROR';
 			$RespData['MSG_ERROR'] = 'No direct script access allowed'; 		 
		}else {
			if (isset($_POST['no_oficio_remesa']) && isset($_POST['fecha_acuse_oficio_remesa'])){
				$no_oficio_remesa = "'".$_POST['no_oficio_remesa']."'";
				$dFechaAcuse = "'".$_POST['fecha_acuse_oficio_remesa']."'";

				$this->db->query('update seguimientos set fecha_acuse_remesa_seguimiento = '.$dFechaAcuse . ' where no_oficio_remesa_seguimiento = '. $no_oficio_remesa);
				$RespData['SQL'] = $this->db->last_query();

				if ($this->db->affected_rows()>0){
					$RespData['STATUS'] = 'OK';
					//$RespData['CONSULTA'] = $qryTmp;
				}else{
					$RespData['STATUS'] = 'ERROR';
	 				$RespData['MSG_ERROR'] = 'No hay registros'; 		 
				}
			}else{
				$RespData['STATUS'] = 'ERROR';
	 			$RespData['MSG_ERROR'] = 'parametros llegaron incompletos';
			}
		}
		header('Content-type: application/json; charset=utf-8'); 		
 		echo json_encode($RespData); 
 	} 	

 	/*******************************************************************************/
 	public function cedula_pertinencia_individual(){
 		$id_seguimiento = 30;
 		if (isset($_GET['id'])){ $id_seguimiento = $_GET['id']; }
 		


 		$data = new stdClass();
		$data->menu_activo = 'tercero';		
		$data->accion = 'ALTA';
		$data->panel_title = 'Cedula de Pertinencia';
		$data->page_title = 'SISEP';			
		


		$this->db->select('*');
 		$this->db->from('seguimientos');
 		$this->db->join('ceula_pertinencias','seguimientos.id_seguimiento = ceula_pertinencias.id_seguimiento','left');
 		$this->db->where('seguimientos.id_seguimiento',$id_seguimiento);	
 		$qryCedula = $this->db->get();
 		$data->cedula_pertinencia=$qryCedula->row();

 		$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);	

 		if ($this->db->affected_rows()>0){ 				
			$this->load->view('seguimiento/v_registro_cedula_pertinencia_individual',$data);			
 		}else { 			
			echo 'nada que mostrar';			 			
 		}
 		$this->load->view('plantillas/footer',$data);	 	

 	}

 	/*******************************************************************************/
 	public function cedula_pertinencia(){ // global 'Cedula de Pertinencia Pendientes de Agregar y Agregadas';
 		$data = new stdClass();
		$data->menu_activo = 'tercero';		
		$data->accion = 'ALTA';
		$data->panel_title = 'Cedula de Pertinencia Pendientes de Agregar y Agregadas';
		$data->page_title = 'SISEP';

		// CEDULAS POSIBLES...
		$cComponente = $_SESSION['id_componente'];
		$qryCedulasPosibles = $this->db->query('select * from seguimientos where id_componente = '.$cComponente.' and id_cedula_pertinencia is null');
		$data->cedulas_posibles = $qryCedulasPosibles->result();		

		// cedulas ya agregadas
		$this->db->select('*');
 		$this->db->from('ceula_pertinencias');
 		$this->db->join('seguimientos','ceula_pertinencias.id_seguimiento = seguimientos.id_seguimiento','left');
 		
 		$qryCedulaAgregadas = $this->db->get();
 		$data->cedulas_agregadas=$qryCedulaAgregadas->result();

 		$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);	

 		$this->load->view('seguimiento/v_registro_cedula_pertinencia_global',$data);			
 		$this->load->view('plantillas/footer',$data);
 	}
 } // fin del controller
