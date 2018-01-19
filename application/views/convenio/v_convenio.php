<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set ( 'America/Mazatlan' );
ini_set('date.timezone','America/Mazatlan'); 
ini_set("session.cookie_lifetime","7200");//2017-07-11
ini_set("session.gc_maxlifetime","7200");//2017-07-11
?>
<!DOCTYPE html>
<html lang="es">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">



	<title><?php echo $page_title ?></title>

	<!--<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>-->
	<?php 
		if (file_exists("/ckeditor/ckeditor.js")) {
			echo '<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>';
		}else {
			echo '<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>';
		}
	?>


	    
	<style type="text/css">
	  .centrado-porcentual2{
	    position: fixed;
	    left: 40%;
	    top: 40%;
	    width: 180px;
	    height:140px;
	    margin-left: -80px;
	    margin-top: -80px;
	    z-index: 9999        
	  }
	</style>  


	 <!-- CARGANDO JQUERY -->  
	<!--<script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>-->   

	</head>
 	
 	<body>
		<div class ="container">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-4">
							<h6 style="text-align:left;"><span class="label label-default" style="align:right"><?php if (isset($_SESSION['programa'])){ echo $_SESSION['programa'];}?></span></h6>
						</div>
						<div class="col-md-8">
             				<h6 style="text-align:left;"><span class="label label-default"><?php if (isset($_SESSION['componente'])){ echo $_SESSION['componente'];}?></span></h6>
             			</div>
					</div>
					
					<div class="row">
						<div class="col-md-3">
							<h3 class="panel-title" id='panel-encabezado'>Convenio(s)</h3>
						</div>
						<div class="col-md-7">
							<input type="text" id="idNombreConvenio" placeholder='nombre especifico para este grupo de convenios' value="" class="form-control" />			
						</div>
						<div class="col-md-2">
							<div id='divGrabar' style="visibility:none" class="form-group col-xs-6 col-sm-2"> 
								<input type="button" name="btnGrabar" class="btn btn-primary btnGrabar" value='Grabar' >
							</div>
							<div id='divActualizar' style="visibility:none" class="form-group col-xs-6 col-sm-2"> 
								<input type="button" name="btnGrabar" class="btn btn-primary btnGrabar" value='Actualizar'>
							</div>
						</div>
					</div> <!-- fin del row arriba panel heading -->
				</div> <!-- fin del panel-heading -->
				
				<!-- EMPIEZA PANEL BODY -->
				<div class="panel-body">
					<?php if (validation_errors()) { ?> 
						<div class="alert alert-danger" role="alert"><?php echo validation_errors(); ?> </div>
					<?php } ?>

					<div class="row">
						<input type="hidden" id="tipo_solicitante" value="<?php echo $tipo_solicitante; ?>" />
						<input type="hidden" id="cesionado_usuario" value="<?php echo $cesionado_usuario; ?>" />
						<input type="hidden" id="ano" value="<?php echo $ano; ?>" />
						<input type="hidden" id="id_programa" value="<?php echo $id_programa; ?>" />
						<input type="hidden" id="id_componente" value="<?php echo $id_componente; ?>" />						
					</div>

					


					<hr size="5">
					<h7>
						<div class="row"> <!--LOS BOTONES DE LOS CATALOGOS -->
							<div id="idDivDelegaciones" class="form-group col-xs-6 col-sm-2" >
								<label>Datos Delegación</label>
								<select id="cboDelegaciones" class="form-control" >
									<option value="0">Seleccione</option>
								</select>
								<hr size="1">						
								<button value='delegacion' class="insertar-campo btn-primary form-control">Insertar</button>
							</div>				
					
							<div id="idDivPersonaFisica" class="form-group col-xs-6 col-sm-2" >
								<label>Datos Persona Fisica</label>
								<select id="cboPersonaFisica" class="form-control">
									<option value="0">Seleccione</option>
								</select>
								<hr size="1">						
								<button value='personafisica' class="insertar-campo btn-primary form-control">Insertar</button>
							</div>

							<div id="idDivPersonaMoral" class="form-group col-xs-6 col-sm-2" >
								<label>Datos Persona Moral</label>
								<select id="cboPersonaMoral" class="form-control">
									<option value="0">Seleccione</option>
								</select>
								<hr size="1">						
								<button value='personamoral' class="insertar-campo btn-primary form-control">Insertar</button>
							</div>

							<div id="idDivRepresentantes" class="form-group col-xs-6 col-sm-2" >
								<label>Datos Representante</label>
								<select id="cboRepresentante" class="form-control">
									<option value="0">Seleccione</option>
								</select>
								<hr size="1">
								<button value='representante' class="insertar-campo btn-primary form-control">Insertar</button>
							</div>

							<div id="idDivPropiedad" class="form-group col-xs-6 col-sm-2" >
								<label>Datos Propiedad</label>
								<select id="cboPropiedad" class="form-control">
									<option value="0">Seleccione</option>
								</select>
								<hr size="1">						
								<button value='propiedad' class="insertar-campo btn-primary form-control">Insertar</button>
							</div>					

							<div id="idDivProveedores" class="form-group col-xs-6 col-sm-2" >
								<label>Datos Proveedor</label>
								<select id="cboProveedor" class="form-control">
									<option value="0">Seleccione</option>
								</select>
								<hr size="1">						
								<button value='proveedor' class="insertar-campo btn-primary form-control">Insertar</button>
							</div>

							<div id="idDivUPP" class="form-group col-xs-6 col-sm-2" >
								<label>Datos UPP</label>
								<select id="cboUPP" class="form-control">
									<option value="0">Seleccione</option>
								</select>
								<hr size="1">						
								<button value='upp' class="insertar-campo btn-primary form-control">Insertar</button>
							</div>

							<div id="idDivApoyo" class="form-group col-xs-6 col-sm-2" >
								<label>Conoceptos de Apoyo</label>
								<select id="cboApoyo" class="form-control">
									<option value="0">Seleccione</option>
								</select>
								<hr size="1">
								<button value='apoyo' class="insertar-campo btn-primary form-control">Insertar</button>
							</div>

							<div id="idDivSeguimiento" class="form-group col-xs-6 col-sm-2" >
								<label>Datos Seguimiento</label>
								<select id="cboSeguimiento" class="form-control">
									<option value="0">Seleccione</option>
								</select>
								<hr size="1">
								<button value='seguimiento' class="insertar-campo btn-primary form-control">Insertar</button>
							</div>

							<div id="idDivTablaConceptos" class="form-group col-xs-6 col-sm-2" >
								<label>Tabla Conceptos</label>						
								<select id="cboTablaConceptos" class="form-control">
									<option value="0">Seleccione</option>
									<option value="tablaconceptos">tablaconceptos</option>
								</select>
								<hr size="1">
								<button value='tablaconceptos' class="insertar-campo btn-primary form-control">Insertar</button>
							</div>

							<!--2017-12-01 anexado para meter combo con programas, componente e incentivos manualmente-->
							<div id="idDivTablaControl" class="form-group col-xs-6 col-sm-2" >
								<label>Tabla Control</label>						
								<select id="cboTablaControl" class="form-control">
									<option value="0">Seleccione</option>
									<option value="nombre_programa">nombre programa</option>
									<option value="nombre_componente">nombre componente</option>
									<option value="nombre_incentivo">nombre incentivo</option>
								</select>
								<hr size="1">
								<button value='tablacontrol' class="insertar-campo btn-primary form-control">Insertar</button>
							</div>
						</div> <!-- FIN DEL ROW  DE LOS BOTONES -->

						<div id='divConvenio'  class="row">						
							<div class="form-group col-xs-6 col-sm-12">						
								<textarea cols='80' id='editor1' name='editor1' rows='10'></textarea>
								<script type='text/javascript'>
									CKEDITOR.replace ('editor1',{
										width: '99%',
										height: 1500,
										resize_dir: 'both', // redimencionar
										resize_minWidth: 200,
										resize_minHeight: 300,
										resize_maxWidth: 800
									});
								</script>
							</div>						
						</div> <!-- fin del div divConvenio y row -->

						<div class="row">

						</div> <!-- fin del row -->

					</h7> <!-- fin del encabezado h7-->
				</div> <!-- fin del panel-body -->

			</div> <!-- fin del panel panel-primary -->
		</div> <!-- fin del container -->
	
		

		<!-- CARGANDO JQUERY SEP 17 -->

	  	<!--<script src="<?php echo base_url('assets/convenio/jquery/jquery-3.1.0.min.js')?>"></script>-->

	  	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

	  	<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		  
	  	<!-- CARGANDO BOOTSTRAP SEP 17 -->
	  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"/>
	  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

	  	<script src="<?php echo base_url(); ?>assets/convenio/js/funciones_convenio.js" type="text/javascript"></script>
	  
	  	<div class="centrado-porcentual2" id="ajax-loading" style="display:none" ><img id="imagen_cargando" src="<?php echo base_url('assets/convenio/imagen/cargando.gif'); ?>" /></div>
	  	<!--http://innovaciones.com.py/images/cargando.gif-->
  	</body>
</html>

