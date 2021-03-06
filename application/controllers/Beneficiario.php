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
		//$this->db->where( 'id_incentivo', $_SESSION['id_incentivo']);

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
	public function padron_individual(){ // LLEGA EL ID_PADRON_BENEFICIARIO VIA GET		

	    //$RespData = array(); // PARA LOS VALORES DE RETORNO DEL JSON
		$data = new stdClass();
		$data->menu_activo = 'primero';
		$data->accion = 'ALTA';
		$data->panel_title = 'ABC del Padron de Beneficiario';
		$data->page_title = 'SISEP';
		$id = 99999999; // SIMULAR LA ALTA
		if (isset($_GET['id'])){
			$id = $_GET['id'];
			$data->accion = 'EDICION';
		}

		$this->db->select('*,siseppadronbeneficiarios.id_padron_beneficiario as id_padron'); // campo ambiguo
		$this->db->from('siseppadronbeneficiarios');
		$this->db->join( 'siseppersonasfisicas',' `siseppadronbeneficiarios`.`id_padron_beneficiario` = `siseppersonasfisicas`.`id_padron_beneficiario`','left');
		$this->db->join( 'siseppersonasmorales',' `siseppadronbeneficiarios`.`id_padron_beneficiario` = `siseppersonasmorales`.`id_padron_beneficiario`','left');
		$this->db->join( 'siseprepresentanteslegales', ' `siseppadronbeneficiarios`.`id_padron_beneficiario` = `siseprepresentanteslegales`.`id_padron_beneficiario`','left');
		$this->db->join( 'sisepdatosupp', ' `siseppadronbeneficiarios`.`id_padron_beneficiario` = `sisepdatosupp`.`id_padron_beneficiario`','left');
		$this->db->join( 'sisepdatosbanco', ' `siseppadronbeneficiarios`.`id_padron_beneficiario` = `sisepdatosbanco`.`id_padron_beneficiario`','left');
		$this->db->join( 'sisepdatospropiedad', ' `siseppadronbeneficiarios`.`id_padron_beneficiario` = `sisepdatospropiedad`.`id_padron_beneficiario`','left');
		$this->db->join( 'sisepdatosproveedor', ' `siseppadronbeneficiarios`.`id_padron_beneficiario` = `sisepdatosproveedor`.`id_padron_beneficiario`','left');		
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
		
		$data = new stdClass();
		$data->menu_activo = 'primero';
		//$data->accion = 'ALTA'; --> se define abajo..!
		$data->panel_title = 'ABC del Padron de Beneficiario';
		$data->page_title = 'SISEP';		
		
		//cargando las variables
		$tipo_solicitante = $_GET['t'];
		$cesionado_usuario = $_GET['c'];
		$cAno = '2017';
		$id_programa = $_SESSION['id_programa'];
		$id_componente = $_SESSION['id_componente'];
		//$id_incentivo = $_SESSION['id_incentivo'];

		$data->tipo_solicitante = $tipo_solicitante;
		$data->cesionado_usuario = $cesionado_usuario;
		$data->ano = $cAno;
		$data->id_programa = $id_programa;
		$data->id_componente = $id_componente;
		//$data->id_incentivo = $id_incentivo;		
		
		$this->db->select('*');
		$this->db->from('sisepcatplantillas');
		$this->db->where('id_programa',$id_programa);		
		$this->db->where('id_componente',$id_componente);
		//$this->db->where('id_incentivo',$id_incentivo);
		$this->db->where('tipo_usuario',$tipo_solicitante);
		$this->db->where('cesionado_usuario',$cesionado_usuario);
		$this->db->where('id_ano_fiscal',$cAno);
		$cSQL = $this->db->get_compiled_select();
		$data->SQL = $cSQL;		
		
		$qryConvenio 	= $this->db->query( $cSQL)->row();
		$data->qryConvenio = $qryConvenio;

		if ($this->db->affected_rows()>0) {		
			$data->nombre_plantilla = $qryConvenio->nombre_plantilla;
			$data->convenio = $qryConvenio->convenio;
			$data->accion = 'EDICION';
		}else { 			
			$data->accion = 'ALTA';
		}
		//$this->load->view('plantillas/encabezado',$data);
		$this->load->view('convenio/v_convenio',$data);		
		//$this->load->view('plantillas/menu',$data);		
		//echo json_encode(array('status'=>true) );
		//$this->load->view('plantillas/footer',$data);
	}
	/******************************************AJAX DE JSON *****************************/
	public function ObtenerDelegacion(){ // is ajax 
		//header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepdelegaciones')->result();                
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerPersonaFisica(){ // is ajax 
		//header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from siseppersonasfisicas')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerPersonaMoral(){ // is ajax 
		//header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from siseppersonasmorales')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerBeneficiario(){ // is ajax 
		//header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from datosbeneficiarios')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerRepresentante(){ // is ajax 
		//header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from siseprepresentanteslegales')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerPropiedad(){ // is ajax 
		//header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepdatospropiedad')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*************************************************/
	public function ObtenerProveedor(){ // is ajax 
		//header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepdatosproveedor')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*****************************************************/
	public function ObtenerUPP(){ // is ajax 
		//header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from sisepdatosupp')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*****************************************************/
	public function ObtenerConcepto(){ // is ajax 
		//header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from datosconceptos')->result();        
        //print_r( json_encode ( $delegacion ) );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode ( $queryAux ) ;
	}
	/*****************************************************/
	public function ObtenerSeguimiento(){ // is ajax 
		//header('Content-Type: application/json');        
        $queryAux = $this->db->query('select * from seguimientos')->result();        
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
				//'id_incentivo'		=> $_POST['incentivo'],
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
				//$this->db->where( 'id_incentivo', $_POST['incentivo']);
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
				//$cIncentivo = $query->id_incentivo;
				$cTipo		= $query->tipo_solicitante;
				$cCesionado = $query->cesionado_usuario;

				$convenio = NULL;

				$RespData['IDPADRON'] = $idPadron;
				$RespData['PARAMETROS'] = array( 'ANO'=>$cAno, 'COMPONENTE'=>$cComponente,'TIPO'=>$cTipo,'CESIONADO'=>$cCesionado);
				
				
				$this->db->select('convenio');
				$this->db->from('sisepcatplantillas');				
				$this->db->where( 'id_programa',$cPrograma);
				$this->db->where( 'id_componente', $cComponente);
				//$this->db->where( 'id_incentivo', $cIncentivo);
				$this->db->where( 'tipo_usuario', $cTipo);
				$this->db->where( 'cesionado_usuario', $cCesionado);
				$this->db->where( 'id_ano_fiscal',$cAno);

				$queryPlantilla = $this->db->get()->row();
				$RespData['SQL_PLANTILLA'] = $this->db->last_query();

				if ( $this->db->affected_rows()>0) {

					/// HAY Q REALIZAR AHORA LA CONSULTA A LA BASE DE DATOS...
					$this->db->select('*');
					$this->db->from('siseppadronbeneficiarios');
					$this->db->join('conceptos_inversion','conceptos_inversion.id_concepto = siseppadronbeneficiarios.`id_concepto` ','left');
					$this->db->join('siseppersonasfisicas','siseppersonasfisicas.id_padron_beneficiario = siseppadronbeneficiarios.`id_padron_beneficiario` ','left');
					$this->db->join('siseppersonasmorales','siseppersonasmorales.id_padron_beneficiario = siseppadronbeneficiarios.`id_padron_beneficiario` ','left');
					$this->db->join('sisepdatospropiedad','sisepdatospropiedad.id_padron_beneficiario = siseppadronbeneficiarios.`id_padron_beneficiario` ','left');
					$this->db->join('sisepdatosbanco','sisepdatosbanco.id_padron_beneficiario = siseppadronbeneficiarios.`id_padron_beneficiario` ','left');
					$this->db->join('siseprepresentanteslegales','siseprepresentanteslegales.id_padron_beneficiario = siseppadronbeneficiarios.`id_padron_beneficiario` ','left');					
					$this->db->join('sisepdelegaciones','sisepdelegaciones.id_delegacion > 0','full');
					$this->db->join('incentivos_federales','incentivos_federales.id_incentivo > 0','full');
					$this->db->join('programas_federales','programas_federales.id_programa > 0','full');
					$this->db->join('componentes_federales','componentes_federales.id_componente > 0','full');
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
					ON sisepDetConceptos.id_padron_beneficiario = sisepPadronBeneficiarios.`﻿idPadronBeneficiario` 
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
		//$cIncentivo = $_POST['incentivo'];
		$cTipo	= $_POST['tipo'];
		$cCesionado = $_POST['cesionado'];

		$this->db->select('*');
		$this->db->from('sisepcatplantillas');
		$this->db->where('id_programa',$cPrograma);		
		$this->db->where('id_componente',$cComponente);
		//$this->db->where('id_incentivo',$cIncentivo);
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
	public function graba_padron_individual(){ // graba btn v_padron_individual --> recibe muchos campos..!
		$RespData = array();
		if (!isset($_POST['id_padron_beneficiario'])){
			$RespData['STATUS']  = 'ERROR';
			$RespData['MSG_ERROR'] = 'No hay información para procesar';			
		}else {
			// comenzamos grabando la tabla de personas fisicas
			$datos = $_POST; // aqui le pasamos los datos al array datos
			$id_padron_beneficiario = $datos['id_padron_beneficiario'];
			$this->db->trans_begin();
			//2017-12-04 --> grabando la tabla siseppadronbeneficiarios
			/*
$id_padron 				= array( 'id'=>'id_padron_beneficiario','name'=>'id_padron_beneficiario','class'=>'form-control','value'=>set_value('id_padron_beneficiario'),'type'=>'hidden');
$folio_interno			= array( 'id'=>'folio_interno', 'name'=>'folio_interno', 'class'=>'form-control','value'=>set_value('folio_interno'));
$folio_suri				= array( 'id'=>'folio_suri', 'name'=>'folio_suri', 'class'=>'form-control','value'=>set_value('folio_suri'));
$fecha_folio_suri 		= array( 'id'=>'fecha_folio_suri', 'name'=>'fecha_folio_suri', 'class'=>'form-control','value'=>set_value('fecha_folio_suri'));
$nombre_solicitante 	= array( 'id'=>'nombre_solicitante', 'name'=>'nombre_solicitante', 'class'=>'form-control','value'=>set_value('nombre_solicitante'));
$fecha_ventanilla 		= array( 'id'=>'fecha_ventanilla', 'name'=>'fecha_ventanilla', 'class'=>'form-control','value'=>set_value('fecha_ventanilla'));
$remesa_no 				= array( 'id'=>'remesa_no', 'name'=>'', 'class'=>'form-control','value'=>set_value('remesa_no'));
$id_concepto 			= array( 'id'=>'id_concepto', 'name'=>'id_concepto', 'class'=>'form-control','value'=>set_value('id_concepto'));
$has_suri 				= array( 'id'=>'has_suri', 'name'=>'has_suri', 'class'=>'form-control','value'=>set_value('has_suri'));
$id_ddr 				= array( 'id'=>'id_ddr', 'name'=>'id_ddr', 'class'=>'form-control','value'=>set_value('id_ddr'));
$apoyo_solicitado 		= array( 'id'=>'apoyo_solicitado', 'name'=>'apoyo_solicitado', 'class'=>'form-control','value'=>set_value('apoyo_solicitado'));
$aportacion_productor 	= array( 'id'=>'aportacion_productor', 'name'=>'aportacion_productor', 'class'=>'form-control','value'=>set_value('aportacion_productor'));
$inversion_total 		= array( 'id'=>'inversion_total', 'name'=>'inversion_total', 'class'=>'form-control','value'=>set_value('inversion_total'));
$producto_atender 		= array( 'id'=>'producto_atender', 'name'=>'producto_atender', 'class'=>'form-control','value'=>set_value('producto_atender'));
$nombre_proyecto 		= array( 'id'=>'nombre_proyecto', 'name'=>'nombre_proyecto', 'class'=>'form-control','value'=>set_value('nombre_proyecto'));
$tipo_solicitante 		= array( 'id'=>'tipo_solicitante', 'name'=>'tipo_solicitante', 'class'=>'form-control','value'=>set_value('tipo_solicitante'));
$cesionado_usuario 		= array( 'id'=>'cesionado_usuario', 'name'=>'cesionado_usuario', 'class'=>'form-control','value'=>set_value('cesionado_usuario'));
$descripcion_proyecto 	= array( 'id'=>'descripcion_proyecto', 'name'=>'descripcion_proyecto', 'class'=>'form-control','value'=>set_value('descripcion_proyecto'));

			*/
			$qryTmp = $this->db->query('select id_padron_beneficiario from siseppadronbeneficiarios where id_padron_beneficiario ='.$id_padron_beneficiario)->row();
			$accion = 'EDICION';
			if (is_null($qryTmp)){ $accion = 'ALTA';}

			$data = array(
					'folio_interno'			=> $datos['folio_interno'],
					'folio_suri'			=> $datos['folio_suri'],
					'fecha_folio_suri'		=> $datos['fecha_folio_suri'],
					'nombre_solicitante'	=> $datos['nombre_solicitante'],
					'fecha_ventanilla'		=> $datos['fecha_ventanilla'],
					//'remesa_no'				=> $datos['remesa_no'],
					'id_concepto'			=> $datos['id_concepto'],
					'has_suri'				=> $datos['has_suri'],
					'id_ddr'				=> $datos['id_ddr'],
					'apoyo_solicitado'		=> $datos['apoyo_solicitado'],
					'aportacion_productor'	=> $datos['aportacion_productor'],
					//'inversion_total'		=> $datos['inversion_total'],
					'producto_atender'      => $datos['producto_atender'],
					'nombre_proyecto'		=> $datos['nombre_proyecto'],
					'tipo_solicitante'		=> $datos['tipo_solicitante'],
					'cesionado_usuario'		=> $datos['cesionado_usuario'],
					'descripcion_proyecto'	=> $datos['descripcion_proyecto']					
				);
				
			if ($accion == 'ALTA'){
				$cSQL = $this->db->set($data)->get_compiled_insert('siseppadronbeneficiarios');					
			}else {
				$this->db->where('id_padron_beneficiario',$id_padron_beneficiario);
				$cSQL = $this->db->set($data)->get_compiled_update('siseppadronbeneficiarios');
			}
			$qryTmp = $this->db->query($cSQL);
			$RespData['SQL_PADRON_BENEFICIARIOS'] = $cSQL;

			// ahora la tabla de personas fisicas
			
			if ($datos['tipo_solicitante'] == 'F') { // se trata de una persona fisica
				// hay q preguntar si existe ese id en la tabla de personas fisicas				
				$qryTmp = $this->db->query('select id_persona_fisica from siseppersonasfisicas where id_padron_beneficiario ='.$id_padron_beneficiario)->row();
				$accion = 'EDICION';
				if (is_null($qryTmp)){ $accion = 'ALTA';}
				
				$data = array(
					'ap_paterno_persona_fisica'			=> $datos['ap_paterno_persona_fisica'],
					'ap_materno_persona_fisica'			=> $datos['ap_materno_persona_fisica'],
					'nombre_persona_fisica'				=> $datos['nombre_persona_fisica'],
					'rfc_persona_fisica'				=> $datos['rfc_persona_fisica'],
					'curp_persona_fisica'				=> $datos['curp_persona_fisica'],
					'nacionalidad_persona_fisica'		=> $datos['nacionalidad_persona_fisica'],
					'fecha_nacimiento_persona_fisica'	=> $datos['fecha_nacimiento_persona_fisica'],
					'estado_civil_persona_fisica'		=> $datos['estado_civil_persona_fisica'],
					'calle_persona_fisica'				=> $datos['calle_persona_fisica'],
					'numero_persona_fisica'			    => $datos['num__persona_fisica'],
					'colonia_persona_fisica'			=> $datos['colonia_persona_fisica'],
					'cp_persona_fisica'				    => $datos['cp_persona_fisica'],
					'localidad_persona_fisica'          => $datos['localidad_persona_fisica'],
					'municipio_persona_fisica'			=> $datos['municipio_persona_fisica'],
					'estado_persona_fisica'			    => $datos['estado_persona_fisica'],
					'telefono_casa_persona_fisica'		=> $datos['telefono_persona_fisica'],
					'num_celular_persona_fisica'		=> $datos['num_celular_persona_fisica'],
					'correo_persona_fisica'			    => $datos['correo_persona_fisica'],
					'id_oficial_persona_fisica'		    => $datos['id_oficial_persona_fisica'],
					'num_id_oficial_persona_fisica'  	=> $datos['num_id_oficial_persona_fisica'],
					'id_padron_beneficiario'			=> $datos['id_padron_beneficiario']
				);
				
				if ($accion == 'ALTA'){
					$cSQL = $this->db->set($data)->get_compiled_insert('siseppersonasfisicas');					
				}else {
					$this->db->where('id_padron_beneficiario',$id_padron_beneficiario);
					$cSQL = $this->db->set($data)->get_compiled_update('siseppersonasfisicas');
				}
				$qryTmp = $this->db->query($cSQL);
				$RespData['SQL_PERSONA_FISICA'] = $cSQL;
			}// fin del if ($datos['tipo_solicitante']) == 'F')

			// AHORA LA TABLA DE PERSONAS MORALES
			
			if ($datos['tipo_solicitante'] == 'M') { // se trata de una persona moral				
				$qryTmp = $this->db->query('select id_persona_moral from siseppersonasmorales where id_padron_beneficiario ='.$id_padron_beneficiario)->row();
				$accion = 'EDICION';
				if (is_null($qryTmp)){ $accion = 'ALTA';}
						
				$data = array(
					'nombre_persona_moral'							=> $datos['nombre_persona_moral'],
					'rfc_persona_moral'								=> $datos['rfc_persona_moral'],
					'calle_persona_moral'							=> $datos['calle_persona_moral'],
					'numero_persona_moral'							=> $datos['numero_persona_moral'],
					'colonia_persona_moral'							=> $datos['colonia_persona_moral'],
					'cp_persona_moral'								=> $datos['cp_persona_moral'],
					'localidad_persona_moral'						=> $datos['localidad_persona_moral'],
					'municipio_persona_moral'						=> $datos['municipio_persona_moral'],
					'estado_persona_moral'							=> $datos['estado_persona_moral'],
					'telefono_oficina_persona_moral'				=> $datos['telefono_oficina_persona_moral'],
					'correo_persona_moral'							=> $datos['correo_persona_moral'],
					'fecha_Inscripcion_rfc_persona_moral'			=> $datos['fecha_Inscripcion_rfc_persona_moral'],
					'objeto_social_persona_moral'					=> $datos['objeto_social_persona_moral'],
					'tipo_de_organismo_persona_moral'				=> $datos['tipo_de_organismo_persona_moral'],
					'no_acta_constitutiva_persona_moral'			=> $datos['no_acta_constitutiva_persona_moral'],
					'fecha_de_constitucion_persona_moral'			=> $datos['fecha_de_constitucion_persona_moral'],
					'nombre_licenciado_notario_persona_moral'		=> $datos['nombre_licenciado_notario_persona_moral'],
					'notario_acta_const_persona_moral'				=> $datos['notario_acta_const_persona_moral'],
					'num_notario_act_const_persona_moral'			=> $datos['num_notario_act_const_persona_moral'],
					'calle_notario_acta_const_persona_moral'		=> $datos['calle_notario_acta_const_persona_moral'],
					'numero_notario_acta_const_persona_moral'		=> $datos['numero_notario_acta_const_persona_moral'],
					'colonia_notario_acta_const_persona_moral'		=> $datos['colonia_notario_acta_const_persona_moral'],
					'cp_notario_acta_const_persona_moral'			=> $datos['cp_notario_acta_const_persona_moral'],
					'municipio_notario_acta_const_persona_moral'	=> $datos['municipio_notario_acta_const_persona_moral'],
					'estado_notario_acta_const_persona_moral'		=> $datos['estado_notario_acta_const_persona_moral'],
					'no_acta_asamblea_persona_moral'				=> $datos['no_acta_asamblea_persona_moral'],
					'fecha_de_acta_asamblea_persona_moral'			=> $datos['fecha_de_acta_asamblea_persona_moral'],
					'notario_acta_asamblea_persona_moral'			=> $datos['notario_acta_asamblea_persona_moral'],
					'num_dom_notario_act_asamblea_persona_moral'	=> $datos['numero_notario_acta_asamblea_persona_moral'],
					'calle_notario_acta_asamblea_persona_moral'		=> $datos['calle_notario_acta_asamblea_persona_moral'],
					'numero_notario_acta_asamblea_persona_moral'	=> $datos['numero_notario_acta_asamblea_persona_moral'],
					'colonia_notario_acta_asamblea_persona_moral'	=> $datos['colonia_notario_acta_asamblea_persona_moral'],
					'cp_notario_acta_asamblea_persona_moral'		=> $datos['cp_notario_acta_asamblea_persona_moral'],
					'municipio_notario_acta_asamblea_persona_moral'	=> $datos['municipio_notario_acta_asamblea_persona_moral'],
					'estado_notario_acta_asamblea_persona_moral'	=> $datos['estado_notario_acta_asamblea_persona_moral'],
					'id_padron_beneficiario'						=> $datos['id_padron_beneficiario']
				);
				if ($accion == 'ALTA'){
					$cSQL = $this->db->set($data)->get_compiled_insert('siseppersonasmorales');					
				}else {
					$this->db->where('id_padron_beneficiario',$id_padron_beneficiario);
					$cSQL = $this->db->set($data)->get_compiled_update('siseppersonasmorales');
				}
				$qryTmp = $this->db->query($cSQL);
				$RespData['SQL_MORAL'] = $cSQL;
			}// fin del if ($datos['tipo_solicitante']) == 'M')
			


			// ahora los representantes
			$qryTmp = $this->db->query('select id_representante_legal from siseprepresentanteslegales where id_padron_beneficiario ='.$id_padron_beneficiario)->row();
			//$RespData['QRY_REPRESENTANTES'] = $qryTmp;
			$accion = 'EDICION';
			if (is_null($qryTmp)){ $accion = 'ALTA';}			

			$data = array(                                            
				'apellido_paterno_representante_legal'		=>$datos['apellido_paterno_representante_legal'],
				'apellido_materno_representante_legal'		=>$datos['apellido_materno_representante_legal'],
				'nombre_representante_legal'				=>$datos['nombre_representante_legal'],
				'caracter_representante_legal'				=>$datos['caracter_representante_legal'],
				'rfc_representante_legal'					=>$datos['rfc_representante_legal'],
				'curp_representante_legal'					=>$datos['curp_representante_legal'],
				'nacionalidad_representante_legal'			=>$datos['nacionalidad_representante_legal'],
				'fecha_de_nacimiento_representante_legal'	=>$datos['fecha_de_nacimiento_representante_legal'],
				'estado_civil_representante_legal'			=>$datos['estado_civil_representante_legal'],
				'calle_representante_legal'					=>$datos['calle_representante_legal'],
				'numero_representante_legal'				=>$datos['numero_representante_legal'],
				'colonia_representante_legal'				=>$datos['colonia_representante_legal'],
				'cp_representante_legal'					=>$datos['cp_representante_legal'],
				'localidad_representante_legal'				=>$datos['localidad_representante_legal'],
				'municipio_representante_legal'				=>$datos['municipio_representante_legal'],
				'fecha_const_representante_legal'			=>$datos['fecha_const_representante_legal'],
				'estado_representante_legal'				=>$datos['estado_representante_legal'],
				'telefono_representante_legal'				=>$datos['telefono_representante_legal'],
				'celular_representante_legal'				=>$datos['celular_representante_legal'],
				'correo_representante_legal'				=>$datos['correo_representante_legal'],
				'tipo_documento_representante_legal'		=>$datos['tipo_documento_representante_legal'],
				'numero_documento_representante_legal'		=>$datos['numero_documento_representante_legal'],
				'nombre_licenciado_notario_representante_legal'	=>$datos['nombre_licenciado_notario_representante_legal'],
				'notario_doc_legal_representante_legal'			=>$datos['notario_doc_legal_representante_legal'],
				'num_notario_doc_representante_legal'			=>$datos['num_notario_doc_representante_legal'],
				'calle_notario_doc_representante_legal'			=>$datos['calle_notario_doc_representante_legal'],
				'numero_dom__notario_doc_representante_legal'	=>$datos['numero_dom__notario_doc_representante_legal'],
				'colonia_notario_doc_representante_legal'		=>$datos['colonia_notario_doc_representante_legal'],
				'cp_notario_doc_representante_legal'			=>$datos['cp_notario_doc_representante_legal'],
				'municipio_notario_doc_representante_legal'		=>$datos['municipio_notario_doc_representante_legal'],
				'estado_notario_doc_representante_legal'		=>$datos['estado_notario_doc_representante_legal'],
				'id_padron_beneficiario'						=> $datos['id_padron_beneficiario']
			);

			if ($accion == 'ALTA'){
				$cSQL = $this->db->set($data)->get_compiled_insert('siseprepresentanteslegales');
				$RespData['ACCION_REPRESENTANTES'] ='ALTA';
			}else {
				$this->db->where('id_padron_beneficiario',$id_padron_beneficiario);
				$cSQL = $this->db->set($data)->get_compiled_update('siseprepresentanteslegales');
				$RespData['ACCION_REPRESENTANTES'] ='EDICION';
			}
			$qryTmp = $this->db->query($cSQL);
			$RespData['SQL_REPRESENTANTE'] = $cSQL;


			//la tabla q le sigue  juan jose Revisar los ID
			$qryTmp = $this->db->query('select id_datos_propiedad from sisepdatospropiedad where id_padron_beneficiario ='.$id_padron_beneficiario)->row();
			$accion = 'EDICION';
			if (is_null($qryTmp)){ $accion = 'ALTA';}

			$data = array(				
				'ubicacion_predio_datos_propiedad'	=>$datos['ubicacion_predio_datos_propiedad'],
				'docto_acreditcion_datos_propiedad'	=>$datos['docto_acreditcion_datos_propiedad'],
				'num_acta_datos_propiedad'			=>$datos['num_acta_datos_propiedad'],
				'fecha_acta_datos_propiedad'		=>$datos['fecha_acta_datos_propiedad'],
				'nombre_notario_datos_propiedad'	=>$datos['nombre_notario_datos_propiedad'],
				'num_notario_datos_propiedad'		=>$datos['num_notario_datos_propiedad'],
				'objeto_datos_propiedad'			=>$datos['objeto_datos_propiedad'],
				'id_padron_beneficiario'			=>$datos['id_padron_beneficiario']
			);
				
			if ($accion == 'ALTA'){
				$cSQL = $this->db->set($data)->get_compiled_insert('sisepdatospropiedad');					
			}else {
				$this->db->where('id_padron_beneficiario',$id_padron_beneficiario);
				$cSQL = $this->db->set($data)->get_compiled_update('sisepdatospropiedad');
			}
			$qryTmp = $this->db->query($cSQL);
			$RespData['SQL_PROPIEDAD'] = $cSQL;



			$qryTmp = $this->db->query('select id_datos_banco from sisepdatosbanco where id_padron_beneficiario ='.$id_padron_beneficiario)->row();
			$accion = 'EDICION';
			if (is_null($qryTmp)){ $accion = 'ALTA';}

			$data = array(				
				'fecha_cta_datos_banco'		=>$datos['fecha_cta_datos_banco'],
				'clabe_datos_banco'			=>$datos['clabe_datos_banco'],
				'cuenta_datos_banco'		=>$datos['cuenta_datos_banco'],
				'nomina_datos_banco'		=>$datos['nomina_datos_banco'],
				'nombre_banco_datos_banco'	=>$datos['nombre_banco_datos_banco'],
				'id_padron_beneficiario'	=>$datos['id_padron_beneficiario']
			);
								
			if ($accion == 'ALTA'){
				$cSQL = $this->db->set($data)->get_compiled_insert('sisepdatosbanco');					
			}else {
				$this->db->where('id_padron_beneficiario',$id_padron_beneficiario);
				$cSQL = $this->db->set($data)->get_compiled_update('sisepdatosbanco');
			}
			
			$qryTmp = $this->db->query($cSQL);
			$RespData['SQL_BANCO'] = $cSQL;


			$qryTmp = $this->db->query('select id_datos_proveedor from sisepdatosproveedor where id_padron_beneficiario ='.$id_padron_beneficiario)->row();
			$accion = 'EDICION';
			if (is_null($qryTmp)){ $accion = 'ALTA';}

			$data = array(				
				'nombre_datos_proveedor'			=>$datos['nombre_datos_proveedor'],
				'calle_datos_proveedor'				=>$datos['calle_datos_proveedor'],
				'numero_datos_proveedor'			=>$datos['numero_datos_proveedor'],
				'localidad_datos_proveedor'			=>$datos['localidad_datos_proveedor'],
				'cp_datos_proveedor'				=>$datos['cp_datos_proveedor'],
				'municipio_datos_proveedor'			=>$datos['municipio_datos_proveedor'],
				'entidad_federativa_datos_proveedor'=>$datos['entidad_federativa_datos_proveedor'],
				'id_padron_beneficiario'			=>$datos['id_padron_beneficiario']
			);
								
			if ($accion == 'ALTA'){
				$cSQL = $this->db->set($data)->get_compiled_insert('sisepdatosproveedor');					
			}else {
				$this->db->where('id_padron_beneficiario',$id_padron_beneficiario);
				$cSQL = $this->db->set($data)->get_compiled_update('sisepdatosproveedor');
			}
			$qryTmp = $this->db->query($cSQL);
			$RespData['SQL_PROVEEDOR'] = $cSQL;


			$qryTmp = $this->db->query('select id_datos_upp from sisepdatosupp where id_padron_beneficiario ='.$id_padron_beneficiario)->row();
			$accion = 'EDICION';
			if (is_null($qryTmp)){ $accion = 'ALTA';}

			$data = array(				
				'localidad_datos_upp'		=>$datos['localidad_datos_upp'],
				'municipio_datos_upp'		=>$datos['municipio_datos_upp'],
				'estado_datos_upp'			=>$datos['estado_datos_upp'],
				'no_upp_datos_upp'			=>$datos['no_upp_datos_upp'],
				'nombre_posesion_datos_upp'	=>$datos['nombre_posesion_datos_upp'],
				'has_datos_upp'				=>$datos['has_datos_upp'],
				'no_animales_datos_upp'		=>$datos['no_animales_datos_upp'],
				'especie_apoyada_datos_upp'	=>$datos['especie_apoyada_datos_upp'],
				'id_padron_beneficiario'	=>$datos['id_padron_beneficiario']
			);
								
			if ($accion == 'ALTA'){
				$cSQL = $this->db->set($data)->get_compiled_insert('sisepdatosupp');					
			}else {
				$this->db->where('id_padron_beneficiario',$id_padron_beneficiario);
				$cSQL = $this->db->set($data)->get_compiled_update('sisepdatosupp');
			}
			$qryTmp = $this->db->query($cSQL);
			$RespData['SQL_UPP'] = $cSQL;
		

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$RespData['STATUS'] = 'ERROR';
				$RespData['MSG_ERROR'] = $this->db->_error_message();	        	
	        } else {        
	        	$this->db->trans_commit();
	        	$RespData['STATUS'] = 'OK';
	        }								
		}	
		header('Content-type: application/json; charset=utf-8');
		echo  json_encode($RespData);	
	}
	/***********************************************************************/
}