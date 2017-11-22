<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Crud_controller extends CI_Controller {
	
 
	 public function __construct()
	 	{
	 		parent::__construct();		 		
			if (!isset($_SESSION['logeado'])){
				if (!$_SESSION['logeado']){
					redirect();			
				}			
			}
	 	}
 
 
	public function index()
	{
 
		//$data['clientes']=$this->clientes_crud_model->get_all_clientes();
		//$this->load->view('crud/v_clientes_crud',$data);
		//$data = new stdClass();		
		//$data['clientes']=$this->clientes_crud_model->get_all_clientes();
		//$data->clientes=$this->clientes_crud_model->get_all_clientes();


		//$data->title = 'Sistema de Recepcion de Muestra';
	 	//$data->contenido = 'crud/v_clientes_crud';
	 	//$data->panel_title = 'Listado de Clientes';
	 	//$data->menu_activo = 'catalogos';
	 	//$data->cargar_crud = true; 	

	 	//$this->load->view('plantillas/head',$data);	 	
	 	//$this->load->view('frontend',$data);		
		//$this->load->view('plantillas/mymodal2',$data);
		//$this->load->view('plantillas/footer',$data);
		//$this->load->view('crud/v_clientes_crud',$data);	

	}
	/********************************************************************************************************************/
	/********************************** CATALOGOS DEL SISTEMA ***********************************************************/
	/********************************************************************************************************************/
	public function componentes_crud(){ // es el que se llama desde el menu
		$data = new stdClass();
		
		$qryComponentes = $this->db->query('select * from componentes_federales');		
		$data->componentes=$qryComponentes->result();

		$data->title = 'SISEP';
	 	//$data->contenido = 'crud/v_clientes_crud';
	 	$data->panel_title = 'Listado de Componentes';
	 	$data->menu_activo = 'segundo';
	 	//$data->cargar_crud = true; 	

	 	$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		
		$this->load->view('crud/v_crud_componente');
		$this->load->view('plantillas/footer',$data);	 	
	}
	/****************************************************************************/
	public function componente_add() { // es ajax requeri
			
		// HAY Q VALIDARLOS
			
		$this->form_validation->set_rules('nombre_componente','Nombre del componente','trim|required');
			//$this->form_validation->set_rules('EMAIL_CLIENTE','Correo','trim|required|valid_email','callback_email_check');	
			/*
			$this->form_validation->set_rules('DOMICILIO_CLIENTE','Domicilio','trim|required');
			$this->form_validation->set_rules('RFC_CLIENTE','RFC','trim|required');
			$this->form_validation->set_rules('CIUDAD_CLIENTE','Ciudad','trim|required');
			$this->form_validation->set_rules('ESTADO_CLIENTE','Estado','trim|required');
			
			$this->form_validation->set_rules('CONTACTO_CLIENTE','Contacto','trim|required');	
			$this->form_validation->set_rules('TELEFONO_CLIENTE','Telefono','trim|required');	
			
			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			$this->form_validation->set_message('integer', 'El campo %s deve poseer solo numeros enteros');
			$this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			$this->form_validation->set_message('max_length', 'El Campo %s debe tener un Maximo de %d Caracteres');
			*/
	    if ($this->form_validation->run() == FALSE) {	
	       	$cError = 'Reglas de Validación de los campos marco error; llene los campos con información correcta ';
	      	//$this->session->set_flashdata('mensaje_error',$cError);
	      	//echo json_encode($cError);
	      	echo $cError;
	        //$this->alta_cliente();
	        //$this->index();
	       	
	    } else {  //COMENZZAMOS CON LAS VALIDACIONES DEL PASSWORD      
			$data = array(						
				'nombre_componente' => $this->input->post('nombre_componente') );
			//$insert = $this->clientes_crud_model->cliente_add($data);
			$this->db->insert('componentes_federales', $data);
			$insert= $this->db->insert_id();
			echo json_encode(array("status" => TRUE));
		} // FIN DEL IF
	}
		/*************************************************************/
	public function componente_ajax_edit($id) 		{
			//$data = $this->clientes_crud_model->get_cliente_by_id($id); 
			$this->db->from('componentes_federales');
			$this->db->where('id_componente',$id);
			$query = $this->db->get(); 
			$data= $query->row();
			echo json_encode($data);
	}
 	/***************************************************************/
	public function componente_update() 	{
		$data = array(				
				'nombre_componente'	 	=> $this->input->post('nombre_componente') );
		//$this->clientes_crud_model->cliente_update(array('ID_CLIENTE' => $this->input->post('ID_CLIENTE')), $data);

		$this->db->update( 'componentes_federales', $data, array('id_componente' => $this->input->post('id_componente')) );
		//return $this->db->affected_rows();
		//$x=$this->db->last_query();
		//echo json_encode(array('SQL'=>$x,"status" => TRUE));
		echo json_encode(array("status" => TRUE));
	}
	/***********************************************************************/ 
	public function componente_delete($id)
	{
		//$this->clientes_crud_model->delete_cliente_by_id($id);
		$this->db->where('id_componente', $id);
		$this->db->delete('componentes_federales');
		echo json_encode(array("status" => TRUE));
	}
/********************************************************************************************************************/
/********************************************************************************************************************/
/************************************************************* CATALOGO DE INCENTIVOS *******************************/
 public function incentivos_crud(){ // es el que se llama desde el menu
		$data = new stdClass();
		
		$qryincentivos = $this->db->query('select * from incentivos_federales');		
		$data->incentivos=$qryincentivos->result();

		$data->title = 'SISEP';
	 	//$data->contenido = 'crud/v_clientes_crud';
	 	$data->panel_title = 'Listado de incentivos';
	 	$data->menu_activo = 'segundo';
	 	//$data->cargar_crud = true; 	

	 	$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		
		$this->load->view('crud/v_crud_incentivo',$data);
		$this->load->view('plantillas/footer',$data);	 	
	}
	/****************************************************************************/
	public function incentivo_add() { // es ajax requeri
			
		// HAY Q VALIDARLOS
			
		$this->form_validation->set_rules('nombre_incentivo','Nombre del incentivo','trim|required');
			//$this->form_validation->set_rules('EMAIL_CLIENTE','Correo','trim|required|valid_email','callback_email_check');	
			/*
			$this->form_validation->set_rules('DOMICILIO_CLIENTE','Domicilio','trim|required');
			$this->form_validation->set_rules('RFC_CLIENTE','RFC','trim|required');
			$this->form_validation->set_rules('CIUDAD_CLIENTE','Ciudad','trim|required');
			$this->form_validation->set_rules('ESTADO_CLIENTE','Estado','trim|required');
			
			$this->form_validation->set_rules('CONTACTO_CLIENTE','Contacto','trim|required');	
			$this->form_validation->set_rules('TELEFONO_CLIENTE','Telefono','trim|required');	
			
			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			$this->form_validation->set_message('integer', 'El campo %s deve poseer solo numeros enteros');
			$this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			$this->form_validation->set_message('max_length', 'El Campo %s debe tener un Maximo de %d Caracteres');
			*/
	    if ($this->form_validation->run() == FALSE) {	
	       	$cError = 'Reglas de Validación de los campos marco error; llene los campos con información correcta ';
	      	//$this->session->set_flashdata('mensaje_error',$cError);
	      	//echo json_encode($cError);
	      	echo $cError;
	        //$this->alta_cliente();
	        //$this->index();
	       	
	    } else {  //COMENZZAMOS CON LAS VALIDACIONES DEL PASSWORD      
			$data = array(						
				'nombre_incentivo' => $this->input->post('nombre_incentivo') );
			//$insert = $this->clientes_crud_model->cliente_add($data);
			$this->db->insert('incentivos_federales', $data);
			$insert= $this->db->insert_id();
			echo json_encode(array("status" => TRUE));
		} // FIN DEL IF
	}
		/*************************************************************/
	public function incentivo_ajax_edit($id) 		{
			//$data = $this->clientes_crud_model->get_cliente_by_id($id); 
			$this->db->from('incentivos_federales');
			$this->db->where('id_incentivo',$id);
			$query = $this->db->get(); 
			$data= $query->row();
			echo json_encode($data);
	}
 	/***************************************************************/
	public function incentivo_update() 	{
		$data = array(				
				'nombre_incentivo'	 	=> $this->input->post('nombre_incentivo') );
		//$this->clientes_crud_model->cliente_update(array('ID_CLIENTE' => $this->input->post('ID_CLIENTE')), $data);

		$this->db->update( 'incentivos_federales', $data, array('id_incentivo' => $this->input->post('id_incentivo')) );
		//return $this->db->affected_rows();
		//$x=$this->db->last_query();
		//echo json_encode(array('SQL'=>$x,"status" => TRUE));
		echo json_encode(array("status" => TRUE));
	}
	/***********************************************************************/ 
	public function incentivo_delete($id)
	{
		//$this->clientes_crud_model->delete_cliente_by_id($id);
		$this->db->where('id_incentivo', $id);
		$this->db->delete('incentivos_federales');
		echo json_encode(array("status" => TRUE));
	}
/********************************************************************************************************************/
/********************************************************************************************************************/
/************************************************************* CATALOGO DE PROGRAMAS *******************************/
 public function programas_crud(){ // es el que se llama desde el menu
		$data = new stdClass();
		
		$qryprogramas = $this->db->query('select * from programas_federales');		
		$data->programas=$qryprogramas->result();

		$data->title = 'SISEP';
	 	//$data->contenido = 'crud/v_clientes_crud';
	 	$data->panel_title = 'Listado de programas';
	 	$data->menu_activo = 'segundo';
	 	//$data->cargar_crud = true; 	

	 	$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		
		$this->load->view('crud/v_crud_programa',$data);
		$this->load->view('plantillas/footer',$data);	 	
	}
	/****************************************************************************/
	public function programa_add() { // es ajax requeri
			
		// HAY Q VALIDARLOS
			
		$this->form_validation->set_rules('nombre_programa','Nombre del programa','trim|required');
			//$this->form_validation->set_rules('EMAIL_CLIENTE','Correo','trim|required|valid_email','callback_email_check');	
			/*
			$this->form_validation->set_rules('DOMICILIO_CLIENTE','Domicilio','trim|required');
			$this->form_validation->set_rules('RFC_CLIENTE','RFC','trim|required');
			$this->form_validation->set_rules('CIUDAD_CLIENTE','Ciudad','trim|required');
			$this->form_validation->set_rules('ESTADO_CLIENTE','Estado','trim|required');
			
			$this->form_validation->set_rules('CONTACTO_CLIENTE','Contacto','trim|required');	
			$this->form_validation->set_rules('TELEFONO_CLIENTE','Telefono','trim|required');	
			
			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			$this->form_validation->set_message('integer', 'El campo %s deve poseer solo numeros enteros');
			$this->form_validation->set_message('is_unique', 'El campo %s ya esta registrado');
			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			$this->form_validation->set_message('max_length', 'El Campo %s debe tener un Maximo de %d Caracteres');
			*/
	    if ($this->form_validation->run() == FALSE) {	
	       	$cError = 'Reglas de Validación de los campos marco error; llene los campos con información correcta ';
	      	//$this->session->set_flashdata('mensaje_error',$cError);
	      	//echo json_encode($cError);
	      	echo $cError;
	        //$this->alta_cliente();
	        //$this->index();
	       	
	    } else {  //COMENZZAMOS CON LAS VALIDACIONES DEL PASSWORD      
			$data = array(						
				'nombre_programa' => $this->input->post('nombre_programa') );
			//$insert = $this->clientes_crud_model->cliente_add($data);
			$this->db->insert('programas_federales', $data);
			$insert= $this->db->insert_id();
			echo json_encode(array("status" => TRUE));
		} // FIN DEL IF
	}
		/*************************************************************/
	public function programa_ajax_edit($id) 		{
			//$data = $this->clientes_crud_model->get_cliente_by_id($id); 
			$this->db->from('programas_federales');
			$this->db->where('id_programa',$id);
			$query = $this->db->get(); 
			$data= $query->row();
			echo json_encode($data);
	}
 	/***************************************************************/
	public function programa_update() 	{
		$data = array(				
				'nombre_programa'	 	=> $this->input->post('nombre_programa') );
		//$this->clientes_crud_model->cliente_update(array('ID_CLIENTE' => $this->input->post('ID_CLIENTE')), $data);

		$this->db->update( 'programas_federales', $data, array('id_programa' => $this->input->post('id_programa')) );
		//return $this->db->affected_rows();
		//$x=$this->db->last_query();
		//echo json_encode(array('SQL'=>$x,"status" => TRUE));
		echo json_encode(array("status" => TRUE));
	}
	/***********************************************************************/ 
	public function programa_delete($id)
	{
		//$this->clientes_crud_model->delete_cliente_by_id($id);
		$this->db->where('id_programa', $id);
		$this->db->delete('programas_federales');
		echo json_encode(array("status" => TRUE));
	}
 
 /********************************************************************************************************************/
/********************************************************************************************************************/
/************************************************************* CATALOGO DE DDR (gde) *******************************/
 public function ddrs_crud(){ // es el que se llama desde el menu
		$data = new stdClass();
		
		$qryddrs = $this->db->query('select * from ddrs_federales');		
		$data->ddrs=$qryddrs->result();

		$data->title = 'SISEP';
	 	//$data->contenido = 'crud/v_clientes_crud';
	 	$data->panel_title = 'Listado de ddrs';
	 	$data->menu_activo = 'segundo';
	 	//$data->cargar_crud = true; 	

	 	$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		
		$this->load->view('crud/v_crud_distrito',$data);
		$this->load->view('plantillas/footer',$data);	 	
	}
	/****************************************************************************/
	public function ddr_add() { // es ajax requeri
			
		// HAY Q VALIDARLOS
			
		$this->form_validation->set_rules('nombre_ddr','Nombre del ddr','trim|required');		
		$this->form_validation->set_rules('jefe_ddr','Jefe del DDR','trim|required');
		$this->form_validation->set_rules('direccion_ddr','Direccion del DDR','trim|required');
		$this->form_validation->set_rules('correo1_ddr','Correo','trim|required|valid_email');	
		$this->form_validation->set_rules('estado_ddr','Estado','trim|required');
		$this->form_validation->set_rules('municipio_ddr','Estado','trim|required');
		$this->form_validation->set_rules('localidad_ddr','Estado','trim|required');
		
		
	    if ($this->form_validation->run() == FALSE) {	
	       	$cError = 'Reglas de Validación de los campos marco error; llene los campos con información correcta ';
	      	//$this->session->set_flashdata('mensaje_error',$cError);
	      	//echo json_encode($cError);
	      	echo $cError;
	        //$this->alta_cliente();
	        //$this->index();
	       	
	    } else {  // a grabar se ha dicho..!
			$data = array(						
				'nombre_ddr' 		=> $this->input->post('nombre_ddr'),
				'jefe_ddr' 			=> $this->input->post('jefe_ddr'),
				'encargado_ddr' 	=> $this->input->post('encargado_ddr'),
				'direccion_ddr' 	=> $this->input->post('direccion_ddr'),
				'telefono1_ddr' 	=> $this->input->post('telefono1_ddr'),
				'telefono2_ddr' 	=> $this->input->post('telefono2_ddr'),
				'correo1_ddr' 		=> $this->input->post('correo1_ddr'),
				'correo2_ddr' 		=> $this->input->post('correo2_ddr'),
				'estado_ddr' 		=> $this->input->post('estado_ddr'),
				'municipio_ddr' 	=> $this->input->post('municipio_ddr'),
				'localidad_ddr' 	=> $this->input->post('localidad_ddr'),
				'abreviatura_titulo_ddr' => $this->input->post('abreviatura_titulo_ddr')
				 );
			//$insert = $this->clientes_crud_model->cliente_add($data);
			$this->db->insert('ddrs_federales', $data);
			$insert= $this->db->insert_id();
			echo json_encode(array("status" => TRUE));
		} // FIN DEL IF
	}
		/*************************************************************/
	public function ddr_ajax_edit($id) 		{
			//$data = $this->clientes_crud_model->get_cliente_by_id($id); 
			$this->db->from('ddrs_federales');
			$this->db->where('id_ddr',$id);
			$query = $this->db->get(); 
			$data= $query->row();
			echo json_encode($data);
	}
 	/***************************************************************/
	public function ddr_update() 	{
		$data = array(						
				'nombre_ddr' 		=> $this->input->post('nombre_ddr'),
				'jefe_ddr' 			=> $this->input->post('jefe_ddr'),
				'encargado_ddr' 	=> $this->input->post('encargado_ddr'),
				'direccion_ddr' 	=> $this->input->post('direccion_ddr'),
				'telefono1_ddr' 	=> $this->input->post('telefono1_ddr'),
				'telefono2_ddr' 	=> $this->input->post('telefono2_ddr'),
				'correo1_ddr' 		=> $this->input->post('correo1_ddr'),
				'correo2_ddr' 		=> $this->input->post('correo2_ddr'),
				'estado_ddr' 		=> $this->input->post('estado_ddr'),
				'municipio_ddr' 	=> $this->input->post('municipio_ddr'),
				'localidad_ddr' 	=> $this->input->post('localidad_ddr'),
				'abreviatura_titulo_ddr' => $this->input->post('abreviatura_titulo_ddr')
				 );
		$this->db->update( 'ddrs_federales', $data, array('id_ddr' => $this->input->post('id_ddr')) );
		//return $this->db->affected_rows();
		//$x=$this->db->last_query();
		//echo json_encode(array('SQL'=>$x,"status" => TRUE));
		echo json_encode(array("status" => TRUE));
	}
	/***********************************************************************/ 
	public function ddr_delete($id)
	{
		//$this->clientes_crud_model->delete_cliente_by_id($id);
		$this->db->where('id_ddr', $id);
		$this->db->delete('ddrs_federales');
		echo json_encode(array("status" => TRUE));
	}
}