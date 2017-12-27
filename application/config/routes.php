<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
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
$route['listado_autorizaciones'] = 'seguimiento_controller/listado_autorizaciones'; // primer submenu
$route['registro_cartas_autorizacion'] = 'seguimiento_controller/registro_cartas_autorizacion'; //segundo submenu
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

