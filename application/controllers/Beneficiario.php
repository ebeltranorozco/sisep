<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beneficiario extends CI_Controller {

	function __construct() {        
        parent::__construct();        
        if (!isset($_SESSION['logeado'])){			
			redirect();			
		}
    }	
	/********************************************************************************************/
	public function index(){
		
	}
	/***************************************************************************************/
	public function padron_beneficiario(){

		$data = new stdClass();		
		$data->menu_activo = 'primero';
		//$data->accion = 'ALTA';
		$data->panel_title = 'Padron de Beneficiarios';
		$data->page_title = 'SISEP';

		$this->db->select('siseppadronbeneficiarios.id_padron_beneficiario as ID,folio_interno as Folio,left(nombre_solicitante,50) as Nombre,format(has_suri,2) as HAS,format(apoyo_solicitado,2) as Apoyo,format(aportacion_productor,2) as Aportacion,tipo_solicitante as Tipo, cesionado_usuario as Cesionado, id_programa as Programa, id_componente as Componente,id_incentivo as Incentivo,space(10) as "A"');
		$this->db->from('siseppadronbeneficiarios');
		$this->db->join( 'siseppersonasfisicas',' `siseppadronbeneficiarios`.`id_padron_beneficiario` = `siseppersonasfisicas`.`id_padron_beneficiario`','left');
		$this->db->where( 'id_programa', $_SESSION['id_programa']);
		$this->db->where( 'id_componente', $_SESSION['id_componente']);
		$this->db->where( 'id_incentivo', $_SESSION['id_incentivo']);

		$qryPadron = $this->db->get();

		$this->load->library('table');	

		$template = array(
	        'table_open'            => '<table border="0" cellpadding="4" cellspacing="0" id="idTablaPadron">',
		        'thead_open'            => '<thead>',
		        'thead_close'           => '</thead>',

		        'heading_row_start'     => '<tr>',
		        'heading_row_end'       => '</tr>',
		        'heading_cell_start'    => '<th>',
		        'heading_cell_end'      => '</th>',

		        'tbody_open'            => '<tbody>',
		        'tbody_close'           => '</tbody>',

		        'row_start'             => '<tr>',
		        'row_end'               => '</tr>',
		        'cell_start'            => '<td>',
		        'cell_end'              => '</td>',

		        'row_alt_start'         => '<tr>',
		        'row_alt_end'           => '</tr>',
		        'cell_alt_start'        => '<td>',
		        'cell_alt_end'          => '</td>',

		        'table_close'           => '</table>'
			);
		$this->table->set_template($template);


		//$aHeading = array( 'FOLIO' ,'NOMBRE',array('data' => 'Am', 'align' => 'center'),'APOYO','APORTACION');
		//$this->table->set_heading( $aHeading);


		$data->data = $qryPadron;
		
		//function listData($table,$name,$value,$orderBy=null, $where_nombre_campo=null, $where_variable=null) {
		//$data->ProgramasFederalesCombo = listData('programas_federales','nombre_programa', 'id_programa');
		//$data->ComponentesFederalesCombo = listData('componentes_federales','nombre_componente', 'id_componente');
		//$data->IncentivosFederalesCombo = listData('incentivos_federales','nombre_incentivo', 'id_incentivo');
		
		$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		
		$this->load->view('beneficiario/v_padron');
		$this->load->view('plantillas/footer',$data);

	}
	/*************************************************************** FUNCTION INDIVUDIAL DE EL PADRON DE BENEFICIARIO *****************/
	public function padron_individual(){

		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else {



        		/*
			$data = new stdClass();
			//$data->menu_activo = 'servicios';
			//$data->accion = 'ALTA';
			$data->panel_title = 'ABC del Padron de Beneficiario';
			$data->page_title = 'SISEP';
			$id = $_POST['id']+3424234235435;

			$this->db->select('*');
			$this->db->from('siseppadronbeneficiarios');
			$this->db->join( 'siseppersonasfisicas',' `siseppadronbeneficiarios`.`id_padron_beneficiario` = `siseppersonasfisicas`.`id_padron_beneficiario`','left');
			$this->db->where( 'siseppadronbeneficiarios.id_padron_beneficiario', $id);
			

			$qryPadron = $this->db->get()->row();
			$data->qryPadron = $qryPadron;	

			$this->load->view('plantillas/encabezado',$data);
			$this->load->view('plantillas/menu',$data);		

			*/

			exit('no se que rollo');
			die();

			/*
			if ($this->db->affected_rows()>0 ){				
				$this->load->view('beneficiario/v_padron_individual',$data);				
			}else {
				$data->mensaje_error = 'Nada que Mostrar * Revise Consulta SQL *';				
				$this->load->view('errors/users/v_error_user',$data);				
			}
			$this->load->view('plantillas/footer',$data);
			*/
		} // fin del ajax _request

	}
	/**************************************************************************************************/
	public function individual(){

		        		
		$data = new stdClass();
		$data->menu_activo = 'primero';
		$data->accion = 'ALTA';
		$data->panel_title = 'ABC del Padron de Beneficiario';
		$data->page_title = 'SISEP';
		$id = 2; // temporal

		$this->db->select('*,siseppadronbeneficiarios.id_padron_beneficiario as id_padron'); // campo ambiguo
		$this->db->from('siseppadronbeneficiarios');
		$this->db->join( 'siseppersonasfisicas',' `siseppadronbeneficiarios`.`id_padron_beneficiario` = `siseppersonasfisicas`.`id_padron_beneficiario`','left');
		$this->db->where( 'siseppadronbeneficiarios.id_padron_beneficiario', $id);
		

		$qryPadron = $this->db->get()->row();
		$data->data = $qryPadron;	
		$data->SQL = $this->db->last_query();

		$this->load->view('plantillas/encabezado',$data);
		$this->load->view('plantillas/menu',$data);		

		if ($this->db->affected_rows()>0 ){	
			$data->accion = 'EDICION';
			$this->load->view('beneficiario/v_padron_individual',$data);				
		}else {
			$data->mensaje_error = 'Nada que Mostrar * Revise Consulta SQL *<br>'.$this->db->last_query();			
			$this->load->view('errors/users/v_error_user',$data);				
		}
		$this->load->view('plantillas/footer',$data);
	} // fin defunction individual
	/************************************************************************************************************/
	public function prepara_convenio(){
		//is ajax
		$data = new stdClass();
		$data->menu_activo = 'primero';
		$data->accion = 'ALTA';
		$data->panel_title = 'ABC del Padron de Beneficiario';
		$data->page_title = 'SISEP';		
		
		//cargando las variables
		$tipo_solicitante = $_GET['t'];
		$cesionado_usuario = $_GET['c'];
		$cAno = '2017';
		$id_programa = $_SESSION['id_programa'];
		$id_componente = $_SESSION['id_componente'];
		$id_incentivo = $_SESSION['id_incentivo'];

		$data->tipo_solicitante = $tipo_solicitante;
		$data->cesionado_usuario = $cesionado_usuario;
		$data->ano = $cAno;
		$data->id_programa = $id_programa;
		$data->id_componente = $id_componente;
		$data->id_incentivo = $id_incentivo;

		// LLENANDO LOS COMBOS BOX
		/*
		$this->db->select('*');
		$this->db->from('sisepCatPlantillas');
		$this->db->where('id_programa',$id_programa);		
		$this->db->where('id_componente',$id_componente);
		$this->db->where('id_incentivo',$id_incentivo);
		$this->db->where('tipo_usuario',$tipo_solicitante);
		$this->db->where('cesionado_usuario',$cesionado_usuario);
		$this->db->where('id_ano_fiscal',$cAno);
		$cSQL = $this->db->get_compiled_select();
		$data->SQL = $cSQL;		
		
		$qryConvenio 	= $this->db->query( $cSQL)->row();
		$data->qryConvenio = $qryConvenio;

		if ($this->db->affected_rows()>0) {		
			$data->nombre_plantilla = $query->nombre_plantilla;
			$data->convenio = $query->convenio;
			$data->accion = 'EDICION';
		}else { 			
			$data->accion = 'ALTA';
		}
		*/

		//header('Content-type: application/json; charset=utf-8');
		//echo  json_encode($RespData);	


		//$this->load->view('plantillas/encabezado',$data);
		$this->load->view('convenio/v_convenio',$data);		
		//$this->load->view('plantillas/menu',$data);		
		//echo json_encode(array('status'=>true) );
		//$this->load->view('plantillas/footer',$data);

	}
	/******************************************AJAX DE JSON *****************************/
	public function ObtenerDelegacion(){ // is ajax 
		header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepdelegaciones')->result();                
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerPersonaFisica(){ // is ajax 
		header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepPersonasFisicas')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerPersonaMoral(){ // is ajax 
		header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepPersonasMorales')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerBeneficiario(){ // is ajax 
		header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from datosbeneficiarios')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerRepresentante(){ // is ajax 
		header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepRepresentantesLegales')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerPropiedad(){ // is ajax 
		header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepDatosPropiedad')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerProveedor(){ // is ajax 
		header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepDatosProveedor')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*****************************************************/
	public function ObtenerUPP(){ // is ajax 
		header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepDatosUPP')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*****************************************************/
	public function ObtenerConcepto(){ // is ajax 
		header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from datosconceptos')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*****************************************************/
	public function ObtenerSeguimiento(){ // is ajax 
		header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepSeguimientoRiego')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*****************************************************/
	public function grabar_convenio(){// is ajax
		//var datos = { 'ano': cAno , 'programa':cPrograma , 'componente':cComponente , 'incentivo':cIncentivo, 'tipo' : cTipo, 'cesionado':cCesionado,'nombreconvenio':cNombreConvenio};
		$RespData = array();
		if ($_POST['accion'] <> "") {

			$datos = array(	
				'nombre_plantilla'	=> $_POST['nombreconvenio'],
				'id_ano_fiscal'		=> $_POST['ano'],
				'id_programa'		=> $_POST['programa'],
				'id_componente'		=> $_POST['componente'],
				'id_incentivo'		=> $_POST['incentivo'],
				'tipo_usuario'		=> $_POST['tipo'],
				'cesionado_usuario'	=> $_POST['cesionado'],
				'convenio'			=> $_POST['convenio']	);
			if ($_POST['accion']=='Grabar') {// se trata de una alta
				$cSQL = $this->db->set($datos)->get_compiled_insert('sisepcatplantillas');
			}else{
				
				$this->db->select('id_plantilla');
				$this->db->from('sisepcatplantillas');
				$this->db->where( 'id_ano_fiscal',$_POST['ano']);
				$this->db->where( 'id_programa', $_POST['programa']);
				$this->db->where( 'id_incentivo', $_POST['incentivo']);
				$this->db->where( 'id_componente', $_POST['componente']);
				$this->db->where( 'tipo_usuario', $_POST['tipo']);
				$this->db->where( 'cesionado_usuario', $_POST['cesionado']);
				$queryPlantilla = $this->db->get()->row();
				$idPlantilla = $queryPlantilla->id_plantilla;

				$this->db->where ( 'id_plantilla', $idPlantilla);
				$cSQL = $this->db->set($datos)->get_compiled_update('sisepcatplantillas');
			}
			$this->db->trans_begin();
			$RespData['SQL'] = $cSQL;
			$this->db->query( $cSQL);

			//Column 'nombrePlantilla' cannot be null - Invalid query: INSERT INTO `plantillas` (`nombrePlantilla`, `idAnoFiscal`, `idPrograma`, `idComponente`, `idIncentivo`, `TipoUsuario`, `Cesionado`, `convenio`) VALUES (NULL, '1', '1', '1', '1', 'F', 'S', NULL)


			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$cRet = 'Error al intentar '.accion.' la informacion';
				$RespData['ERROR'] = $cRet;
			} else {
	        	$this->db->trans_commit();        	
	        	$cRet = 'Todas las Acciones se realizaron con exito';
	        	$RespData['OK'] = $cRet;
	        	//$cRet = "<script type='text/javascript'>alert('Depuracion de las Tablas de Los IDR y anulacion en Detalla de Muestras Realizada')</script>";
	        }
	        
	        header('Content-type: application/json; charset=utf-8');
			echo  json_encode($RespData);				

		}
	}
	/*****************************************************/	
	public function genera_convenio( ) { // metodo que solicita via ajax recibe id por GET
		$idPadron = null;
		$RespData = array();
		if (isset($_GET['id'])){
			$idPadron = $_GET['id'];
			
			//$query = $this->db->query("select idAnoFiscal, idPrograma, idComponente, idIncentivo, `TIPO DE SOLICITANTE` as tipo,`CESIONADO USUARIO` as cesionado from sisepPadronBeneficiarios where ﻿idPadronBeneficiario = ".$idPadron)->row();
			
			$query = $this->db->query("select * from siseppadronbeneficiarios where id_padron_beneficiario = ".$idPadron)->row();
			if ($this->db->affected_rows()>0 ) {

				$cAno 		= $query->id_ano_fiscal;
				$cPrograma	= $query->id_programa;
				$cComponente= $query->id_componente;
				$cIncentivo = $query->id_incentivo;
				$cTipo		= $query->tipo_solicitante;
				$cCesionado = $query->cesionado_usuario;

				$convenio = NULL;

				$RespData['IDPADRON'] = $idPadron;
				$RespData['PARAMETROS'] = array( 'ANO'=>$cAno, 'COMPONENTE'=>$cComponente,'INCENTIVO'=> $cIncentivo,'TIPO'=>$cTipo,'CESIONADO'=>$cCesionado);
				
				$this->db->select('convenio');
				$this->db->from('sisepcatplantillas');				
				$this->db->where( 'id_programa',$cPrograma);
				$this->db->where( 'id_componente', $cComponente);
				$this->db->where( 'id_incentivo', $cIncentivo);
				$this->db->where( 'tipo_usuario', $cTipo);
				$this->db->where( 'cesionado_usuario', $cCesionado);
				$this->db->where( 'id_ano_fiscal',$cAno);

				$queryPlantilla = $this->db->get()->row();
				$RespData['SQL_PLANTILLA'] = $this->db->last_query();

				if ( $this->db->affected_rows()>0) {

					/// HAY Q REALIZAR AHORA LA CONSULTA A LA BASE DE DATOS...
					$this->db->select('*');
					$this->db->from('siseppadronbeneficiarios');
					//$this->db->join('sisepDetConceptos','sisepDetConceptos.idPadronBeneficiario = siseppadronbeneficiarios.`id_padron_beneficiario` ','left');
					//$this->db->join('sisepPersonasFisicas','sisepPersonasFisicas.idPadronBeneficiario = siseppadronbeneficiarios.`id_padron_beneficiario` ','left');
					//$this->db->join('sisepPersonasMorales','sisepPersonasMorales.idPadronBeneficiario = siseppadronbeneficiarios.`id_padron_beneficiario` ','left');
					//$this->db->join('sisepDatosPropiedad','sisepDatosPropiedad.idPadronBeneficiario = siseppadronbeneficiarios.`id_padron_beneficiario` ','left');
					//$this->db->join('sisepDatosBanco','sisepDatosBanco.idPadronBeneficiario = siseppadronbeneficiarios.`id_padron_beneficiario` ','left');
					//$this->db->join('sisepRepresentantesLegales','sisepRepresentantesLegales.idPadronBeneficiario = siseppadronbeneficiarios.`id_padron_beneficiario` ','left');
					
					$this->db->join('sisepdelegaciones','sisepDelegaciones.id_delegacion > 0','full');					
					$this->db->where( 'siseppadronbeneficiarios.id_padron_beneficiario',$idPadron);
					$cConsulta1 = $this->db->get_compiled_select();

					$this->db->select('*');
					$this->db->from('sisepdelegaciones');
					$cConsulta2 = $this->db->get_compiled_select();


					//$consulta = $this->db->query( $cConsulta1 . ' union '. $cConsulta2 )->result_array();
					$consulta = $this->db->query( $cConsulta1 )->result_array();
					$RespData['CONSULTA'] = $consulta;
					$RespData['SQL_UNION'] = $this->db->last_query();
					//$this->db->join('comments', 'comments.id = blogs.id', 'left');
					/*
					SELECT * FROM `sisepPadronBeneficiarios` 
					LEFT JOIN `sisepDetConceptos` 
					ON sisepDetConceptos.idPadronBeneficiario = sisepPadronBeneficiarios.`﻿idPadronBeneficiario` 
					*/


					$convenio = $queryPlantilla->convenio;					
					
					$nAparicion = 0;
					$nPosParentesisAbre 	= strpos($convenio, '((',$nAparicion);
					$nPosParentesisCierra 	= strpos($convenio, '))',$nAparicion);					
					$aCpo					= array();
					$aCpoVacios				= array();
					while( $nPosParentesisAbre ) {
						
						// posicion del campo a buscar
						if (!$nPosParentesisCierra) { $RespData['ERROR']='No se encontraron llaves de cierre';break;}
						$cCpo = substr($convenio,$nPosParentesisAbre+2,$nPosParentesisCierra-$nPosParentesisAbre-2);
						$cCpoDecodificado = null;
						if (isset($consulta[0][$cCpo])){
							$cCpoDecodificado = $consulta[0][$cCpo];	
						}						

						// vamos a buscar el CPO en el query de la consulta y hacer la transformacion
						
						if (!empty($cCpoDecodificado)){
							$aCpo[] = array( $cCpo => $cCpoDecodificado );
							$convenio = substr( $convenio , 0,$nPosParentesisAbre).  strtoupper($cCpoDecodificado). substr( $convenio,$nPosParentesisCierra+2);
						}else{
							$aCpoVacios = array( $cCpo => 'Verificar en BD');
						}
						
						$nAparicion++;
						$nPosParentesisAbre = strpos($convenio, '((',$nAparicion);
						$nPosParentesisCierra = strpos($convenio, '))',$nAparicion);
					} // FIN DEL while

					/*  AHORA VAMOS A BUSCAR LOS CONCEPTOS QUE PUDIERAN SER MAS DE 1*/
					$nAparicion = 0;
					$nPosTablaConceptos = strpos($convenio, '((tablaconceptos))',$nAparicion++);
					if ($nPosTablaConceptos){
						/// PONIENDO EL ENCABEZADO DE LA TABLA						
						$cTabla  = '<table border="1" cellspacing="0" style="border-collapse:collapse; border:1pt solid windowtext; margin:auto auto auto -1.7pt">';
						$cTabla .= '<tbody>';
						$cTabla .= '<tr>';
						$cTabla .= '<td style="background-color:#bfbfbf; height:45.0pt; width:77.45pt">';
						$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:12.0pt"><span style="font-family:&quot;Arial&quot;,sans-serif"><span style="color:black">Folio</span></span></span></p>';
						$cTabla .= '</td>';
						$cTabla .= '<td style="background-color:#bfbfbf; border-color:windowtext windowtext windowtext #000000; height:45.0pt; width:71.45pt">';
						$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:12.0pt"><span style="font-family:&quot;Arial&quot;,sans-serif"><span style="color:black">Proyecto</span></span></span></p>';
						$cTabla .= '</td>';
						$cTabla .= '<td style="background-color:#bfbfbf; border-color:windowtext windowtext windowtext #000000; height:45.0pt; width:3cm">';
						$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:12.0pt"><span style="font-family:&quot;Arial&quot;,sans-serif"><span style="color:black">Beneficiario</span></span></span></p>';
						$cTabla .= '</td>';
						$cTabla .= '<td style="background-color:#bfbfbf; border-color:windowtext windowtext windowtext #000000; height:45.0pt; width:70.85pt">';
						$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:12.0pt"><span style="font-family:&quot;Arial&quot;,sans-serif"><span style="color:black">Monto Federal ($)</span></span></span></p>';
						$cTabla .= '</td>';
						$cTabla .= '<td style="background-color:#bfbfbf; border-color:windowtext windowtext windowtext #000000; height:45.0pt; width:70.9pt">';
						$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:12.0pt"><span style="font-family:&quot;Arial&quot;,sans-serif"><span style="color:black">Monto Beneficiario ($)</span></span></span></p>';
						$cTabla .= '</td>';
						$cTabla .= '<td style="background-color:#bfbfbf; border-color:windowtext windowtext windowtext #000000; height:45.0pt; width:2cm">';
						$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:12.0pt"><span style="font-family:&quot;Arial&quot;,sans-serif"><span style="color:black">Total ($)</span></span></span></p>';
						$cTabla .= '</td>';
						$nMes 	 = (int)date('m');
						$nMes 	 = 13 - $nMes ;
						$cTabla .= '<td colspan="'.$nMes.'" style="background-color:#bfbfbf; border-color:windowtext windowtext windowtext #000000; height:45.0pt; width:4cm">';
						$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:12.0pt"><span style="font-family:&quot;Arial&quot;,sans-serif"><span style="color:black">Calendario</span></span></span></p>';
						$cTabla .= '</td>';
						$cTabla .= '<td></td>';
						$cTabla .= '</tr>'; // fin del encabezado de la tabla

						
						foreach ($consulta as $registro) {
							$cTabla .= '<tr>';
							/* variables */
							$nFolio					= $registro['No. DE FOLIO INTERNO'];
							$cNombreProyecto		= $registro['NOMBRE DEL PROYECTO'];
							$cNombreSolicitante		= $registro['NOMBRE DEL SOLICITANTE'];
							$nMontoFederal			= $registro['APOYO SOLICITADO'];
							$nMontoBeneficiario		= $registro['APORTACION DEL PRODUCTOR'];
							$nTotalApoyo			= $registro['INVERSION TOTAL'];

							//$cDetConcepto 			= $registro['conceptoDetConcepto'];
							$nHasDetConcepto		= $registro['hasDetConcepto'];
							$nMontoDetConcepto		= $registro['montoDetConcepto'];
							//$cReferenciaDetConcepto = $registro['referenciaDetConcepto'];
							if ($nMontoDetConcepto>0) { $nMontoBeneficiario = $nMontoDetConcepto; }
							
							$cTabla .= '<td style="border-color:#000000 windowtext windowtext; height:15.0pt; width:77.45pt">';
							$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:9.0pt"><span style="color:black">'.$nFolio.'</span></span></p>';
							$cTabla .= '</td>';
							$cTabla .= '<td style="border-color:#000000 windowtext windowtext #000000; height:15.0pt; width:71.45pt">';
							$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:9.0pt"><span style="color:black">'.$cNombreProyecto.'</span></span></p>';
							$cTabla .= '</td>';
							$cTabla .= '<td style="border-color:#000000 windowtext windowtext #000000; height:15.0pt; width:3cm">';
							$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:9.0pt"><span style="color:black">'.$cNombreSolicitante.'</span></span></p>';
							$cTabla .= '</td>';
							$cTabla .= '<td style="border-color:#000000 windowtext windowtext #000000; height:15.0pt; width:70.85pt">';
							$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:9.0pt"><span style="color:black">'.number_format($nMontoFederal,2).'</span></span></p>';
							$cTabla .= '</td>';
							$cTabla .= '<td style="border-color:#000000 windowtext windowtext #000000; height:15.0pt; width:70.9pt">';
							$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:9.0pt"><span style="color:black">'.number_format($nMontoBeneficiario,2).'</span></span></p>';
							$cTabla .= '</td>';
							$cTabla .= '<td style="border-color:#000000 windowtext windowtext #000000; height:15.0pt; width:70.9pt">';
							$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:9.0pt"><span style="color:black">'.number_format($nTotalApoyo,2).'</span></span></p>';
							$cTabla .= '</td>';
							$meses = array('1'=>'Ene','2'=>'Feb','3'=>'Mar','4'=>'Abr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Ago','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dic');
							for ( $nMes = (int)date('m'); $nMes<13;$nMes++){

								$cTabla .= '<td style="border-color:#000000 windowtext windowtext #000000; height:15.0pt; width:1cm">';
								$cTabla .= '<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:9.0pt"><span style="font-family:&quot;Calibri&quot;,sans-serif"><span style="color:black">'.$meses[$nMes].'</span></span></span></p>';
								$cTabla .= '</td>';

							}



							$cTabla .= '</tr>';	
						}
					
						$cTabla .= '</tbody>';
						$cTabla .= '</table>';

						// PARTE PERRONA DE LA CONVERSION
						$convenio = substr( $convenio , 0,$nPosTablaConceptos).  $cTabla. substr( $convenio,$nPosTablaConceptos+18);					

						// CREAMOS UN CICLO POR QUE PUDIERAN SER VARIOS CONCEPTOS
					} // fin de $npostablaconceptos					

					$RespData['CAMPO'] = $aCpo; // le manda el array con todos los campos encontrados
					$RespData['LLAVEINICIAL'] = $nPosParentesisAbre;
					$RespData['LLAVEFINAL'] = $nPosParentesisCierra;
					$RespData['CONVENIO'] = $convenio;
					
				}else {
					$RespData['ERROR'] = 'Sin Plantillas';
				}// finde if encontro alguna plantilla
				
			} else {// fin de encontrar plantilla convenio
				$RespData['ERROR'] = 'No se encontro una plantilla que cumpla con los criterios de la consulta';
			}
			
		}else {
			$RespData['ERROR'] = 'Sin Parametros de Entrada';
		} // fin del isset	
		
        //header('Content-Type: application/json');        
        //echo json_encode($RespData);
        //echo json_encode ( $RespData['CONVENIO'] ) ;
        //echo json_encode ( $RespData['CAMPO'] ) ;
        //echo $RespData['CAMPO'];
        echo $convenio;
	}
	/*****************************************************/
	public function buscar_convenio() { // es ajax es para bucar el convenio
		//var datos = { 'ano': cAno , '¨programa':cPrograma , 'componente':cComponente , 'incentivo':cIncentivo, 'tipo' : cTipo, 'cesionado':cCesionado};
		$RespData = array();

		$cAno = $_POST['ano'];
		$cPrograma = $_POST['programa'];
		$cComponente = $_POST['componente'];
		$cIncentivo = $_POST['incentivo'];
		$cTipo	= $_POST['tipo'];
		$cCesionado = $_POST['cesionado'];

		$this->db->select('*');
		$this->db->from('sisepCatPlantillas');
		$this->db->where('id_programa',$cPrograma);		
		$this->db->where('id_componente',$cComponente);
		$this->db->where('id_incentivo',$cIncentivo);
		$this->db->where('tipo_usuario',$cTipo);
		$this->db->where('cesionado_usuario',$cCesionado);
		$this->db->where('id_ano_fiscal',$cAno);
		$cSQL = $this->db->get_compiled_select();
		$RespData['SQL'] = $cSQL;
		$query 	= $this->db->query( $cSQL)->row();	

		if ($this->db->affected_rows()>0) {			
			$RespData['NOMBREPLANTILLA']	= $query->nombre_plantilla;
			$RespData['PLANTILLA'] = $query->convenio;
			$RespData['ACCION'] = 'EDICION';
		}else { 			
			$RespData['ACCION'] = 'ALTA';
		}
		
		header('Content-type: application/json; charset=utf-8');
		echo  json_encode($RespData);		
	}
	/***********************************************************************/
}