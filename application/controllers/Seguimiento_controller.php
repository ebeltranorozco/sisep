<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Seguimiento_controller extends CI_Controller {
	
 
	 public function __construct() {
 		parent::__construct();		 		
		if (!isset($_SESSION['logeado'])){
			if (!$_SESSION['logeado']){
				redirect();
			}			
		}
 	}
 	/****************************************************************************/
 	public function apertura(){ // INDICA QUE SE VA A REALIZAR UN NUEVO OFICIO DE APERTURA
 		$data = new stdClass();
		$data->menu_activo = 'tercero';		
		$data->accion = 'ALTA';
		$data->panel_title = 'Listado de Autorizaciones (Oficios de Apertura)';
		$data->page_title = 'SISEP';

 		$accion = 'ALTA';
 		$id_seguimiento = 9999999;
 		if (isset($_GET['id'])){
 			$id=$_GET['id'];
 			$accion = 'EDICION';
 			// consulta SQL
 		}

 		$this->load->library('table');
 		

 		$template = array (
            'table_open'          => '<table border="0" class="table table-condensed" cellpadding="4" cellspacing="0" id="idTablaTmpDetalleSeguimiento">',

            'heading_row_start'   => '<tr>',
            'heading_row_end'     => '</tr>',
            'heading_cell_start'  => '<th>',
            'heading_cell_end'    => '</th>',

            'row_start'           => '<tr>',
            'row_end'             => '</tr>',
            'cell_start'          => '<td>',
            'cell_end'            => '</td>',

            'row_alt_start'       => '<tr>',
            'row_alt_end'         => '</tr>',
            'cell_alt_start'      => '<td>',
            'cell_alt_end'        => '</td>',

            'table_close'         => '</table>'
      	);	

		
 		$this->table->set_template($template);	

 		//$this->db->select('id_seguimiento,folio_interno_seguimiento,folio_suri_seguimiento,concepto_seguimiento,sistema_producto_seguimiento,,aportacion_federal_seguimiento,aportacion_productor_seguimiento,""');
 		$this->table->set_heading('ID','Nombre','SURI','ID Concepto','Concepto','DDR','HAS','Apoyo','Aportacion','Acciones');

 		$this->db->select('id_padron_beneficiario,nombre_beneficiario_seguimiento,folio_suri_seguimiento,seguimientos.id_concepto,nombre_concepto,id_ddr,has_seguimiento,aportacion_federal_seguimiento,aportacion_productor_seguimiento');
		$this->db->from('seguimientos');
		$this->db->join('conceptos_inversion','seguimientos.id_concepto = conceptos_inversion.id_concepto','LEFT');			
		$this->db->where('id_seguimiento',$id_seguimiento);

		$cCad = $this->db->get_compiled_select();
		$qryBeneficiarios = $this->db->query($cCad)->result_array();
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
		
		$qryOficios = $this->db->query('select * from seguimientos_enc');		
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
			       	// 2017-12-06 --> enviando el correo a los usuarios
			       	$this->load->library('utilerias');
			       	//$nImporte = $this->utilerias->conv_cadena_float($_POST['importe']);
			       	//$RespData['ERROR_CORREO'] = $this->utilerias->email();
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
				    $config = array(
						'protocol' 		=> 'smtp',
					 	'smtp_host' 	=> 'smtp.googlemail.com',
					 	'smtp_user' 	=> 'ebeltran@laria.mx', //Su Correo de Gmail Aqui
					 	'smtp_pass' 	=> 'inf61010', // Su Password de Gmail aqui
					 	'smtp_port' 	=> '465', //587
					 	'smtp_crypto' 	=> 'ssl', //tls
					 	'mailtype' 		=> 'html',
					 	'wordwrap' 		=> TRUE,
					 	'charset' 		=> 'utf-8'
					 );

				    $this->load->library('email',$config);				    
				 	$this->email->set_newline("\r\n");
				 	$this->email->from('muestras@laria.mx');
				 	$this->email->subject('Nueva Muestra de Analisis');
				 	$this->email->to('ebeltranorozco77@gmail.com');
				 	$this->email->message('prueba de envio de correo');
				 	$this->email->send();

				    
				    /*$subject = 'Bienvenido a mi app';

				    $msg = 'Mensaje de prueba';

				    $this->email
				        ->from('ebeltran@laria.mx')
				        ->to('sistemas@laria.mx')
				        ->subject($subject)
				        ->message($msg)
				        ->send();
				        */
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
 	public function enviar_correo(){

 	}
 	/***********************************************************************/
 	public function registro_cartas_autorizacion(){ // segunda opcion de menu
 		$data = new stdClass();
		$data->menu_activo = 'tercero';		
		$data->accion = 'ALTA';
		$data->panel_title = 'Registro de Cartas de Autorizacion';
		$data->page_title = 'SISEP';
		$id_ddr = 133; // temporal		
		
		

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
 		$this->db->from('seguimientos');
 		$this->db->join('conceptos_inversion','seguimientos.id_concepto = conceptos_inversion.id_concepto','LEFT');			
 		$cSql = $this->db->get_compiled_select();
		$qryCartas = $this->db->query($cSql)->result_array();	
		$data->cartas_aceptacionTmp=$qryCartas;
		$data->sql = $cSql;

		$template2 = array (
            'table_open'          => '<table id="idTablaDetalleCartasAperturaDDR" border="0" class="table table-condensed table-bordered" cellpadding="4" cellspacing="0" >'
      	);		
 		$this->table->set_template($template2);
 		$this->table->set_heading('ID','Nombre','SURI','ID Concepto','Concepto','DDR','HAS','Apoyo','Aportacion','Acciones');		
		$data->cartas_aceptacion = $qryCartas;

		$data->DDRCombo = listData('ddrs_federales','nombre_ddr', 'id_ddr'); 				

	 	$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		
		$this->load->view('seguimiento/v_registro_cartas_aceptacion',$data);
		$this->load->view('plantillas/footer',$data);	
 	}
 	/*************************************************************************/
 	public function obtener_cartas_apertura(){ // is ajax, retorna las cartas de un ddr que no han sido seleccionadas
 		if (!$this->input->is_ajax_request()) {
 			$RespData['STATUS'] = 'ERROR';
 			$RespData['MSG_ERROR'] = 'No direct script access allowed'; 		 
		}else {
			//$id_ddr = $_POST['id_ddr'];
			$id_ddr = 136;
			$qryTmp = $this->db->query('select * from seguimientos where id_ddr ='.$id_ddr)->result(); // despues validare con los que estan vacios
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
 } // fin del controller
