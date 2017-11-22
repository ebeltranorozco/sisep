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
 		if (isset($_GET['id'])){
 			$id=$_GET['id'];
 			$accion = 'EDICION';
 			// consulta SQL

 		}

 		$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		
		//$this->load->view('seguimiento/v_apertura_individual',$data);
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
 } // fin del controller
