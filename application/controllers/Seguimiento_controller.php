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



 		// aqi me quede
 		
 		header('Content-type: application/json; charset=utf-8');
 		echo json_encode($RespData); 
 	}
 } // fin del controller
