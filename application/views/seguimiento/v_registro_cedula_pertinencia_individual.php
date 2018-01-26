<?php // definicion de variables

$no_solicitud			= array('id'=>'no_solicitud_cedula', 'name'=>'no_solicitud_cedula', 'class'=>'form-control', 'value'=>set_value('no_solicitud_cedula') ,'readonly'=>'true');

$cLugar					= array('id'=>'lugar_solicitud','name'=>'lugar_solicitud','class'=>'form-control','value'=>set_value('lugar_solicitud'));
$cDia 					= array('id'=>'dia_solicitud','name'=>'dia_solicitud','class'=>'form-control','value'=>set_value('dia_solicitud'));
$cMes 					= array('id'=>'mes_solicitud','name'=>'mes_solicitud','class'=>'form-control','value'=>set_value('mes_solicitud'));
// DATOS GENERALES DEL BENEFICIARIO
$nombre_beneficiario 	= array('id'=>'nombre_beneficiario', 'name'=>'nombre_beneficiario', 'class'=>'form-control', 'value'=>set_value('nombre_beneficiario'));
//DATOS DEL PREDIO A TECNIFICAR
$tiene_agua				= array('id'=>'tiene_agua','name'=>'tiene_agua','class'=>'form-control','value'=>set_value('tiene_agua'),'maxlength'=>'1');
$tiene_luz				= array('id'=>'tiene_luz','name'=>'tiene_luz','class'=>'form-control','value'=>set_value('tiene_luz'),'maxlength'=>'1');
$tiene_telefono			= array('id'=>'tiene_telefono','name'=>'tiene_telefono','class'=>'form-control','value'=>set_value('tiene_telefono'),'maxlength'=>'1');
$tipo_camino			= array('id'=>'tipo_camino','name'=>'tipo_camino','class'=>'form-control','value'=>set_value('tipo_camino'),'maxlength'=>'1');

$tipo_tenencia 			= array('id'=>'tipo_tenencia','name'=>'tipo_tenencia','class'=>'form-control','value'=>set_value('tipo_tenencia'));
$predio_es 				= array('id'=>'predio_es','name'=>'predio_es','class'=>'form-control','value'=>set_value('predio_es'));
$anos_predio_es 		= array('id'=>'anos_predio_es','name'=>'anos_predio_es','class'=>'form-control','value'=>set_value('anos_predio_es'));

$nombre_propietario		= array('id'=>'nombre_propietario','name'=>'nombre_propietario','class'=>'form-control','value'=>set_value('nombre_propietario'));
$descripcion_zona 		= array('id'=>'descripcion_zona','name'=>'descripcion_zona','class'=>'form-control','value'=>set_value('descripcion_zona'));
$uso_actual 			= array('id'=>'uso_actual','name'=>'uso_actual','class'=>'form-control','value'=>set_value('uso_actual'));
// DATOS GENERALES DEL PROYECTO
$localidad_proyecto		= array('id'=>'localidad_proyecto','name'=>'localidad_proyecto','class'=>'form-control','value'=>set_value('localidad_proyecto'));
$municipio_proyecto		= array('id'=>'municipio_proyecto','name'=>'municipio_proyecto','class'=>'form-control','value'=>set_value('municipio_proyecto'));
$entidad_proyecto 		= array('id'=>'entidad_proyecto','name'=>'entidad_proyecto','class'=>'form-control','value'=>set_value('entidad_proyecto'));
$predio_proyecto 		= array('id'=>'predio_proyecto','name'=>'predio_proyecto','class'=>'form-control','value'=>set_value('predio_proyecto'));
$geoposicionamiento_proyecto 		= array('id'=>'geoposicionamiento_proyecto','name'=>'geoposicionamiento_proyecto','class'=>'form-control','value'=>set_value('geoposicionamiento_proyecto'));
$superficio_total 		= array('id'=>'superficio_total','name'=>'superficio_total','class'=>'form-control','value'=>set_value('superficio_total'));
$superficie_tecnificada	= array('id'=>'superficie_tecnificada','name'=>'superficie_tecnificada','class'=>'form-control','value'=>set_value('superficie_tecnificada'));
$superficie_por_tecnificar		= array('id'=>'anos_predio_es','name'=>'anos_predio_es','class'=>'form-control','value'=>set_value('anos_predio_es'));
$tipo_sistema 			= array('id'=>'tipo_sistema','name'=>'tipo_sistema','class'=>'form-control','value'=>set_value('tipo_sistema'));
$cultivo_establecido	= array('id'=>'cultivo_establecido','name'=>'cultivo_establecido','class'=>'form-control','value'=>set_value('cultivo_establecido'));
$cultivo_establecer		= array('id'=>'cultivo_establecer','name'=>'cultivo_establecer','class'=>'form-control','value'=>set_value('cultivo_establecer'));
$condiciones_aptas 		= array('id'=>'condiciones_aptas','name'=>'condiciones_aptas','class'=>'form-control','value'=>set_value('condiciones_aptas'));



//$fecha_acuse['value'] = '2017-12-10';
$nombre_beneficiario['value'] = $cedula_pertinencia->nombre_beneficiario_seguimiento;
if ($accion == 'ALTA'){
	$no_solicitud['value'] = 'nuevo';
	$cDia['value']	= date('d');
	$cMes['value'] = date('M');
}

//var_dump($consulta);
if ($accion == 'VISUALIZACION'){
	/*
lugar_c_pertinencia
dia_c_pertinencia
mes_c_pertinencia

datos_predio_tecnificar_c_pertinencia
tipo_tenencia_c_pertinencia
predio_es_c_pertinencia
anos_predio_es_c_pertinencia
nombre_propietario_c_pertinencia
descripcion_zona_c_pertinencia
uso_actual_c_pertinencia
localidad_proyecto_c_pertinencia
municipio_proyecto_c_pertinencia
entidad_proyecto_c_pertinencia
predio_proyecto_c_pertinencia
geoposicionamiento_proyecto_c_pertinencia
superficie_total_proyecto_c_pertinencia
superficie_tecnificada_proyecto_c_pertinencia
superficie_por_tecnificar_proyecto_c_pertinencia
tipo_sistema_riego_autorizado_proyecto_c_pertinencia
cultivo_establecido_proyecto_c_pertinencia
cultivo_establecer_proyecto_c_pertinencia
condiciones_aptas_proyecto_c_pertinencia
*/
}

?>


<div class="container-fluid">
	<div class="panel panel-primary">
	  <div class="panel-heading"><?php echo $panel_title ?></div>
	  <div class="panel-body">
	  	<!--<form method="POST" action="<?php echo base_url(); ?>login_usuario"  >-->  	

	  	<div class="row">
	  		<div class="col-md-3"><?php echo form_label('Folio Solicitud:');echo form_input($no_solicitud);?></div>
	  		<div class="col-md-3"><?php echo form_label('Lugar:');echo form_input($cLugar);?></div>
	  		<div class="col-md-3"><?php echo form_label('Día:');echo form_input($cDia);?></div>	  		
	  		<div class="col-md-3"><?php echo form_label('Mes:');echo form_input($cMes);?></div>	  		
	  	</div>
	  	
	  	<div class="row">
	  		<div class="col-md-12"><?php echo form_label('Razón Social:');echo form_input($nombre_beneficiario);?></div>
	  		
	  	</div>
	  	<hr size="1" />
	  	<div class="row">
	  		<p> DATOS DEL PREDIO A TECNIFICAR </p>
	  		<div class="col-md-3"><?php echo form_label('Agua [S/N]:');echo form_input($tiene_agua);?></div>
	  		<div class="col-md-3"><?php echo form_label('Energia Electrica [S/N]:');echo form_input($tiene_luz);?></div>
	  		<div class="col-md-3"><?php echo form_label('Teléfono [S/N]:');echo form_input($tiene_telefono);?></div>	  		
	  		<div class="col-md-3"><?php echo form_label('Tipo de Acceso [P/T]:');echo form_input($tipo_camino);?></div>	  		
	  	</div>
	  	<div class="row">	  		
	  		<div class="col-md-3"><?php echo form_label('Predio es [P/C/R/O]:');echo form_input($predio_es);?></div>
	  		<div class="col-md-3"><?php echo form_label('Años:');echo form_input($anos_predio_es);?></div>
	  		<div class="col-md-6"><?php echo form_label('Nombre del Propietario cuando no es propio:');echo form_input($nombre_propietario);?></div>	  		
	  	</div>
	  	<div class="row">	  		
	  		<div class="col-md-6"><?php echo form_label('Descripción de la Zona:');echo form_input($descripcion_zona);?></div>	  		
	  		<div class="col-md-6"><?php echo form_label('Uso Actual:');echo form_input($uso_actual);?></div>	  		
	  	</div>
	  	<hr/>
	  	<div class="row">
	  		<p> DATOS GENERALES DEL PROYECTO</p>
	  		<div class="col-md-3"><?php echo form_label('Localidad:');echo form_input($localidad_proyecto);?></div>
	  		<div class="col-md-3"><?php echo form_label('Municipio:');echo form_input($municipio_proyecto);?></div>
	  		<div class="col-md-3"><?php echo form_label('Entidad:');echo form_input($entidad_proyecto);?></div>	  		
	  		<div class="col-md-3"><?php echo form_label('Predio(s):');echo form_input($predio_proyecto);?></div>	  		
	  	</div>
	  	<div class="row">	  		
	  		<div class="col-md-3"><?php echo form_label('GeoPosicionamiento:');echo form_input($geoposicionamiento_proyecto);?></div>
	  		<div class="col-md-3"><?php echo form_label('Sup. Total:');echo form_input($superficio_total);?></div>
	  		<div class="col-md-3"><?php echo form_label('Sup. Tecnificada:');echo form_input($superficie_tecnificada);?></div>	  		
	  		<div class="col-md-3"><?php echo form_label('Sup. por Tecnificar:');echo form_input($superficie_por_tecnificar);?></div>	  		
	  	</div>
	  	<div class="row">	  		
	  		<div class="col-md-6"><?php echo form_label('Cultivo(s) establecidos:');echo form_input($cultivo_establecido);?></div>	  		
	  		<div class="col-md-6"><?php echo form_label('Cultivo(s) a establecer:');echo form_input($cultivo_establecer);?></div>	  		
	  	</div>
	  	<div class="row">
	  		<div class="col-md-12"><?php echo form_label('Las condiciones del predio(s) son aptas para la ejecución y óptima operación del proyecto autorizado: [S/N = porque]');echo form_input($condiciones_aptas);?></div>
	  	</div>
	  	<hr/>
	  	

		<div class="row">
	  		<div class="col-md-4" id='idDivGrabarCedulaPertinencia'>
	  			<?php  if ($accion == 'ALTA') {?>
	  				<input type="button" name="btnGrabarCedula" id="btnGrabarCedula" class="btn btn-primary" value="Grabar Cedula" />	  			
	  			<?php }?>
	  		</div>			
	  	</div>



	  </div><!-- fin del panel body -->
	</div><!-- fin del panel primary-->
</div> <!-- fin del container fluid -->

<?php 
var_dump($cedula_pertinencia);
?>


