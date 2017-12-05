<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		
		$data = new stdClass();		
		$data->menu_activo = '';
		//$data->accion = 'ALTA';
		//$data->panel_title = 'Acceso al Sistema';
		$data->page_title = 'SISEP';
		
		if (!isset($_SESSION['logeado'])){			
			$this->login();
		}else {
			//function listData($table,$name,$value,$orderBy=null, $where_nombre_campo=null, $where_variable=null) {
			//$data->ProgramasFederalesCombo = listData('programas_federales','nombre_programa', 'id_programa');
			//$data->ComponentesFederalesCombo = listData('componentes_federales','nombre_componente', 'id_componente');
			//$data->IncentivosFederalesCombo = listData('incentivos_federales','nombre_incentivo', 'id_incentivo');
			$this->load->view('plantillas/encabezado',$data);
			//$this->load->view('plantillas/menu',$data);		
			if (isset($_SESSION['ddr_usuario'])){
				if ($_SESSION['ddr_usuario']>0) {
					$this->load->view('plantillas/menu_ddr',$data);
				}else {
					$this->load->view('plantillas/menu',$data);
				}
			}else {
				$this->load->view('plantillas/menu',$data);
			}
			$this->load->view('plantillas/footer',$data);
		}
	}
	/***************************************************************************/
	public function login()
	{
		
		$data = new stdClass();				
		$data->menu_activo = '';
		//$data->accion = 'ALTA';
		$data->panel_title = 'Acceso al Sistema';
		$data->contenido = 'auth/v_login';
		
		//$this->load->view('welcome_message');
		//$this->load->view('plantillas/v_frontend',$data);
		$this->load->view('plantillas/encabezado',$data);

		if (isset($_SESSION['ddr_usuario'])){
			if ($_SESSION['ddr_usuario']>0) {
				$this->load->view('plantillas/menu_ddr',$data);
			}else {
				$this->load->view('plantillas/menu',$data);
			}
		}else {
			$this->load->view('plantillas/menu',$data);
		}	
		
		$this->load->view('auth/v_login',$data);
		$this->load->view('plantillas/footer',$data);
		
	}
	/***********************************************************************************************************/
	public function registro()
	{
		
		$data = new stdClass();
		$data->menu_activo = '';
		//$nIdView = 71;// ejemplo unicamente
		//$data->PanelTitle = 'SISEP';
		//$data->contenido = 'estudios/v_capturar_estudio'; //vista estudios			
		$data->menu_activo = 'servicios';
		$data->accion = 'ALTA';
		$data->panel_title = 'Registro al Sistema';
		

		//function listData($table,$name,$value,$orderBy=null, $where_nombre_campo=null, $where_variable=null) {
		//                               function listData($table,                 $name,   $value,$orderBy, $where_nombre_campo, $where_variable) {
		$data->CargosFederalesCombo = listData('cargos_federales','nombre_cargo_federal', 'id_cargo_federal','id_cargo_federal','visualizar_campo_cargo_federal','S');
		//$data->SQL_CARGOS = $this->db->last_query();
		$data->ProgramasFederalesCombo = listData('programas_federales','nombre_programa', 'id_programa');
		$data->ComponentesFederalesCombo = listData('componentes_federales','nombre_componente', 'id_componente');
		$data->DDRCombo = listData('ddrs_federales','nombre_ddr', 'id_ddr');
		//$data->IncentivosFederalesCombo = listData('incentivos_federales','nombre_incentivo', 'id_incentivo');

		//$this->load->view('welcome_message');
		$this->load->view('plantillas/encabezado',$data);

		if (isset($_SESSION['ddr_usuario'])){
			if ($_SESSION['ddr_usuario']>0) {
				$this->load->view('plantillas/menu_ddr',$data);
			}else {
				$this->load->view('plantillas/menu',$data);
			}
		}else {
			$this->load->view('plantillas/menu',$data);
		}	
		$this->load->view('auth/v_registrar',$data);
		$this->load->view('plantillas/footer',$data);
	}
	
	/**********************************************************************************************************/
	public function check_cargo($str){
		//if ($this->input->post('cbo_cargo_federal')=='Seleccione'){
		if ( $str==0 ){ // verifica no este en 'Seleccione'
			$this->form_validation->set_message('check_cargo', 'Seleccione Cargo del Usuario');
          	return false;            
        } else { return true;}
	}
	/**********************************************************************************************************/
	public function check_programa($str){
		//if ($this->input->post('cbo_cargo_federal')=='Seleccione'){
		if ( $str==0 ){ // verifica no este en 'Seleccione'
			$this->form_validation->set_message('check_programa', 'Seleccione Programa.');
          	return false;            
        } else { return true;}
	}
	/***********************************************************************************************************/
	public function check_componente($str){
		//if ($this->input->post('cbo_cargo_federal')=='Seleccione'){
		if ( $str==0 ){ // verifica no este en 'Seleccione'
			$this->form_validation->set_message('check_componente', 'Seleccione Componente.');
          	return false;            
        } else { return true;}
	}
	/*******************************************************************************************/
	public function username_check($str)
	{
		if ($str == 'test') {
			$this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	/************************************************************************************************************/
	public function graba_usuario(){	

		if (isset($_POST)) {
			$this->form_validation->set_rules('nombre_usuario','Nombre de Usuario','required');
			$this->form_validation->set_rules('alias_usuario','Alias del Usuario','required');
			$this->form_validation->set_rules('correo1_usuario', 'Email', 'required|valid_email|is_unique[usuarios.correo1_usuario]');
	        $this->form_validation->set_rules('pass_usuario', 'Contraseña', 'required', array('required' => 'El campo %s no debe estar vacia.')  );
	        $this->form_validation->set_rules('pass2_usuario', 'Confirmacion de Contraseña', 'required|matches[pass_usuario]');
	        $this->form_validation->set_rules('cbo_cargo_federal', 'Cargo del Usuario', 'required|callback_check_cargo');
	        $this->form_validation->set_rules('cbo_programa_federal', 'Programa Federal', 'required|callback_check_programa');
	        $this->form_validation->set_rules('cbo_componente_federal', 'Componente Federal', 'required|callback_check_componente');
	        //$this->form_validation->set_rules('cbo_incentivo_federal', 'Incentivo Federal', 'required');        
	        
	        /*
	        if ($this->input->post('cbo_cargo_federal')=='Seleccione'){
				$this->form_validation->set_message('cbo_cargo_federal', 'Seleccione un Cargo.');
            	$this->registro();
        	}
        	*/

	        if ($this->form_validation->run() == FALSE) {
	        	$this->registro();
	        }else { //COMENZZAMOS CON LAS VALIDACIONES DEL PASSWORD
	         	        	
	            $nombre_usuario		= $this->input->post('nombre_usuario');
	            $alias_usuario 		= $this->input->post('alias_usuario');
	            $correo1 			= $this->input->post('correo1_usuario');
	            $correo2			= $this->input->post('correo2_usuario');
	            $contrasena 		= $this->input->post('pass_usuario');
	            $cargo 				= $this->input->post('cbo_cargo_federal');
	            $programa 			= $this->input->post('cbo_programa_federal');
	            $componente 		= $this->input->post('cbo_componente_federal');
	            $ddr_usuario		= $this->input->post('cbo_ddr');
	            //$incentivo 			= $this->input->post('cbo_incentivo_federal');
	            //$this->load->library('utilerias');						
	            $verificacion		= strtolower( $this->utilerias->generateRandomString(15));
	            $cAccion 			= $this->input->get('accion');

	            $datos		= array(
	            	'nombre_usuario' 		=> $nombre_usuario,
	            	'alias_usuario'			=> $alias_usuario,
	            	'contrasena_usuario'	=> $contrasena,
	            	'correo1_usuario'		=> $correo1,
	            	'correo2_usuario'		=> $correo2,
	            	'contrasena_usuario'	=> $contrasena,
	            	'id_programa'			=> $programa,
	            	'id_componente'			=> $componente,
	            	'id_cargo_federal'		=> $cargo,
	            	'ddr_usuario'			=> $ddr_usuario,
	            	'cadena_usuario'		=> $verificacion);
	            //var_dump($datos);
	            var_dump($_POST);
	            echo '<br>'.$verificacion.'<br>';
	            var_dump($_GET);

	            if ($programa == 0 or $componente == 0 ) {
	            	$this->session->set_flashdata('mensaje_error','Debe Especificar correctamente Programa y Componente donde se dara de alta al Usuario');
	            	//redirect(base_url('index'));
	            	$this->index();
	            }else { // todo correocto a grabar se ha dicho

	            	$cSQL = $this->db->set($datos)->get_compiled_insert('usuarios');
	            	$qryUser = $this->db->query( $cSQL);
	            	if ($this->db->affected_rows()>0) {
	            		$this->session->set_flashdata('mensaje_sucess','En breve recibira una confirmacion por correo para que valide su contraseña</br>no es necesario que se vuelva a registrar</br>no se olvide de revisar el correo SPAM');
	            		// MANDAR CORREO
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
						$this->email->from('sisep.sagarpa@gmail.com');
						$this->email->subject('Confirmación y Verificación de Cuenta en SISEP');

						 $cMsg = "<h2>Hola: ".$nombre_usuario."</h2>";
						 $cMsg .= '<br/>';
						 $cNamePrograma = $this->db->query("select * from programas_federales where id_programa =".$programa)->row();
						 $cMsg .= "<p>Programa: ".$cNamePrograma->nombre_programa."</p>";
						 $cMsg .= "<br/>";
						 $cNameComponente = $this->db->query("select * from componentes_federales where id_componente =".$componente)->row();
						 $cMsg .= "<p>Componente: ".$cNameComponente->nombre_componente."</p>";
						 $cMsg .= "<br/>";
						 $cMsg .= "<p>Favor de confirmar en la liga de la parte de abajo; en caso de desconocer esta actividad ignorar este correo</p>";
						 $cMsg .= "<br/>";						 
						 $cMsg .= "<a href='". base_url('confirmacion?id='). $verificacion."'>Liga de Confirmación</a>";						 
						 $cMsg .= '<br/><br/>';
						 $cMsg .= "<h7>La información que se envía al destinatario mediante esta transmisión es propiedad exclusiva del Laboratorio Regional de Inocuidad Alimentaria. Si usted no es el destinatario de esta información o si la ha recibido por error, se le comunica que la copia, distribución, modificación, retransmisión, revelación o uso en cualquier forma, está estrictamente prohibida.</h7>";
						 
						 $this->email->message($cMsg);
						 
						 if ($correo2)	{ $this->email->to($correo1,$correo2); }
						 else { $this->email->to($correo1); }
						 
						 $this->email->cc('sistemas@laria.mx','ebeltranorozco77@gmail.com');						 
						 	
						 
						 if ( !$this->email->send() ) {
						 	$this->session->set_flashdata('mensaje_error','no fue posible enviar el correo de confirmacion, favor de reportarse al area de sistemas');
						 }					 

	            		// FIN DE MANDAR CORREO
		        	    redirect(base_url());
		        	}
		        } // fin del programa
		    } // fin del form_validation
	    } else {
	    	echo 'Opcion no Permitida';
	    } // fin de isset post
	    
	} //Fin de la funcion (graba_usuario)
	/**********************************************************************************************************/
	public function login_usuario(){	

		if (isset($_POST)) {
			
			$this->form_validation->set_rules('alias_usuario','Alias del Usuario','required');			
	        $this->form_validation->set_rules('pass_usuario', 'Contraseña', 'required' );
	               
	        if ($this->form_validation->run() == FALSE) {
	        	$this->login();
	        }else { //COMENZZAMOS CON LAS VALIDACIONES DEL PASSWORD
	         	        	
	            
	            $alias_usuario 		= $this->input->post('alias_usuario');
	            $contrasena 		= $this->input->post('pass_usuario');

	            $this->db->select('*');
	            $this->db->from( 'usuarios');
	            $this->db->join('programas_federales', 'usuarios.id_programa = programas_federales.id_programa');
	            $this->db->join('componentes_federales', 'usuarios.id_componente = componentes_federales.id_componente');
	            //$this->db->join('incentivos_federales', 'usuarios.id_incentivo = incentivos_federales.id_incentivo');
	            $this->db->where( 'alias_usuario', $alias_usuario);
	            $this->db->where( 'contrasena_usuario', $contrasena);	            
	            $qryUser = $this->db->get()->row();
	            if ($this->db->affected_rows()>0) {

	            	if ($qryUser->correo_confirmacion_usuario == 'N'){
	            		$this->session->set_flashdata('mensaje_warning','cuenta sin verificacion por parte del usuario; favor de revisar en su cuenta de correo, incluido SPAM');
	            		redirect(base_url('login'));	
	            	}
	            	if ($qryUser->acceso_usuario == 'N'){	            		
	            		$this->session->set_flashdata('mensaje_warning','cuenta sin verificacion por parte del administrador; favor de comunicarse con el area de sistemas');
	            		redirect(base_url('login'));
	            	}else {
		            	$this->session->set_flashdata('mensaje_sucess','Bienvenido:');
						$_SESSION['logeado'] = TRUE;
						$_SESSION['alias_usuario'] = $qryUser->alias_usuario;
						$_SESSION['programa'] = $qryUser->nombre_programa;
						$_SESSION['componente'] = $qryUser->nombre_componente;
						//$_SESSION['incentivo'] = $qryUser->nombre_incentivo;
						$_SESSION['nombre_usuario'] = $qryUser->nombre_usuario;
						$_SESSION['id_programa'] = $qryUser->id_programa;
						$_SESSION['id_componente'] = $qryUser->id_componente;
						if ($qryUser->ddr_usuario>0) {
							$_SESSION['ddr_usuario'] = $qryUser->ddr_usuario;
						}
			        	redirect(base_url());	
	            	}
					
	            }else {
	            	//$_SESSION['logeado'] = null;
	            	$this->session->set_flashdata('mensaje_error','Debe Especificar correctamente alias y contraseña');
	            	$this->login();
	            }	
		    } // fin del form_validation
	    } else {
	    	echo 'Opcion no Permitida';
	    } // fin de isset post	    
	} //Fin de la funcion (login_usuario)	
	/********************************************************************************************/
	public function logout(){
		//$this->session->sess_destroy();
		if (isset($_SESSION['logeado'])) {
			unset($_SESSION['logeado']);
			session_destroy();
			$this->session->set_flashdata('mensaje_warning','Session Terminada');			
			redirect(base_url());	
		}else{
			echo 'nada que hacer';
		}		
	}
	/************************************************************************************************/
	public function confirmacion(){
		if (isset($_GET['id'])){
			$id_cadena ="'" .$_GET['id']."'";
			//$id_cadena =$_GET['id'];

			$data = new stdClass();
			$data->menu_activo = '';		
			$data->accion = 'ALTA';
			$data->panel_title = 'Confirmación de Registro';
			$data->page_title = 'SISEP';

			$qryUser = $this->db->query('select * from usuarios where cadena_usuario = '.$id_cadena)->row();
			$data->data = $qryUser;

			if ($this->db->affected_rows()>0){
				// realizar la actualizacion en la base de datos
				$this->db->query("update usuarios set correo_confirmacion_usuario = 'S' where cadena_usuario = ".$id_cadena);
				if ($this->db->affected_rows()>0){
					$this->load->view('plantillas/encabezado',$data);
					$this->load->view('plantillas/menu',$data);
					$this->load->view('auth/v_confirmar',$data);
					$this->load->view('plantillas/footer',$data);		
				}else{die('imposible la actualizacion del usario; favor de volver a intentar mas tarde');}

				
			}else{
				die('id cambiado o invalido');
			}
		}else {
			die('Opcion no permitida');
		}
	}
}
