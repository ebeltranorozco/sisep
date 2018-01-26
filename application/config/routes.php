<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['registro'] = 'auth/registro'; // funciona para altas y bajas ya que trae un parametro by get
$route['login'] = 'auth/login';
$route['graba_usuario'] = 'auth/graba_usuario'; // funciona para altas y bajas ya que trae un parametro by get
$route['login_usuario'] = 'auth/login_usuario'; // es la vista de cuando se logean en ella
$route['logout'] = 'auth/logout';
$route['confirmacion'] = 'auth/confirmacion'; // para get id , es para confirmar la alta.. 2017-11-21

$route['padron'] = 'beneficiario/padron_beneficiario';
$route['padron_individual'] = 'beneficiario/padron_individual'; // lleva un id de la tabla de padron de benficiario y es la full funciont
$route['individual'] = 'beneficiario/individual'; // lleva un id de la tabla de padron de benficiario y es la full funciont
$route['prepara_convenio'] = 'beneficiario/prepara_convenio';
$route['graba_padron_individual']  = 'beneficiario/graba_padron_individual' ; // es quien graba las correcciones al padron individual muchos campos..!

// CATALOGOS
$route['componentes_crud'] = 'crud_controller/componentes_crud';
$route['incentivos_crud'] = 'crud_controller/incentivos_crud';
$route['programas_crud'] = 'crud_controller/programas_crud';
$route['ddrs_crud'] = 'crud_controller/ddrs_crud';

//CONVENIOS
$route['ObtenerDelegacion'] 	= 'beneficiario/ObtenerDelegacion';
$route['ObtenerPersonaFisica'] 	= 'beneficiario/ObtenerPersonaFisica';
$route['ObtenerPersonaMoral'] 	= 'beneficiario/ObtenerPersonaMoral';
$route['ObtenerBeneficiario'] 	= 'beneficiario/ObtenerBeneficiario';
$route['ObtenerRepresentante'] 	= 'beneficiario/ObtenerRepresentante';
$route['ObtenerPropiedad'] 		= 'beneficiario/ObtenerPropiedad';
$route['ObtenerProveedor'] 		= 'beneficiario/ObtenerProveedor';
$route['ObtenerUPP'] 			= 'beneficiario/ObtenerUPP';
$route['ObtenerConcepto'] 		= 'beneficiario/ObtenerConcepto';
$route['ObtenerSeguimiento'] 	= 'beneficiario/ObtenerSeguimiento';

$route['grabar_convenio']		= 'beneficiario/grabar_convenio';

$route['decodifica_convenio'] 	= 'beneficiario/decodifica_convenio';

$route['buscar_convenio'] 		= 'beneficiario/buscar_convenio';
$route['genera_convenio']		= 'beneficiario/genera_convenio';

/* EMPEZADNO MENU SEGUIMIENTO */
$route['listado_autorizaciones'] = 'seguimiento_controller/listado_autorizaciones'; // primer submenu -> cartas de apertura

$route['listado_cartas_autorizacion'] = 'seguimiento_controller/listado_cartas_autorizacion'; //segundo submenu --> oficio remesa
$route['registro_cartas_autorizacion'] = 'seguimiento_controller/registro_cartas_autorizacion'; //segundo submenu -->agregar

$route['obtener_cartas_apertura'] = 'seguimiento_controller/obtener_cartas_apertura'; // 2017-12-08


$route['apertura'] = 'seguimiento_controller/apertura';
$route['buscar_beneficiarios'] = 'seguimiento_controller/buscar_beneficiarios'; // es ajax para buscar beneficiario

$route['graba_oficio_apertura'] = 'seguimiento_controller/graba_oficio_apertura'; // graba el oficio de apertura
$route['enviar_correo_oficio_apertura'] = 'seguimiento_controller/enviar_correo_oficio_apertura'; //2017-12-27
$route['grabar_oficio_remesa'] = 'seguimiento_controller/grabar_oficio_remesa'; //graba el oficio remesa 2017-12-11

// enviar correo
$route['enviar_correo'] = 'seguimiento_controller/enviar_correo';

// impresiones en pdf
$route['generar_oficio_remesa'] = 'impresiones_controller/generar_oficio_remesa'; //2017-12-11


$route['actualiza_fecha_acuse_oficio_apertura'] = 'seguimiento_controller/actualiza_fecha_acuse_oficio_apertura'; //ajax
$route['actualiza_fecha_acuse_oficio_remesa'] = 'seguimiento_controller/actualiza_fecha_acuse_oficio_remesa'; //ajax

//2018-01-11
//$route['procesaygenera_oficio_remesa'] = '/impresiones_controller/procesaygenera_oficio_remesa'; // se abre en una ventana nueva --> 2018-01-11

//2018-01-19 --> subir archivos al site
$route['subir_oficio_remesa'] = 'upload_controllers/cargar_archivo';


//2018-01-26 --> cedula de pertiencnai
$route['cedula_pertinencia'] = 'seguimiento_controller/cedula_pertinencia';