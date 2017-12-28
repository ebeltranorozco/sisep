<?php // definicion de variables

$no_oficio			= array('id'=>'no_oficio_apertura', 'name'=>'no_oficio_apertura', 'class'=>'form-control', 'value'=>set_value('no_oficio_apertura') );
$fecha_oficio		= array('id'=>'fecha_oficio_apertura', 'name'=>'fecha_oficio_apertura', 'class'=>'form-control', 'value'=>set_value('fecha_oficio_apertura') );
$fecha_acuse		= array('id'=>'fecha_acuse_oficio_apertura', 'name'=>'fecha_acuse_oficio_apertura', 'class'=>'form-control', 'value'=>set_value('fecha_acuse_oficio_apertura') );

$no_oficio['value'] = '411.2017.12.05';
$fecha_oficio['value'] = '2017-12-10';
$fecha_acuse['value'] = '2017-12-10';
?>

<div class="container-fluid">
	<div class="panel panel-primary">
	  	<div class="panel-heading"><?php echo $panel_title ?></div>
	  	<div class="panel-body">
	  		<div class="row">
		  		<div class="col-md-4"><?php echo form_label('No. Oficio:');echo form_input($no_oficio);?></div>
		  		<div class="col-md-4"><?php echo form_label('Fecha Oficio:');echo form_input($fecha_oficio);?></div>
		  		<div class="col-md-4"><?php echo form_label('Fecha Acuse:');echo form_input($fecha_acuse);?></div>	  		
		  		<br/>
		  	</div>

		  	<div class="row">
		  		<div class="col-md-4">
		  			<?php 
		  				echo form_label('DDR:');
		  				echo form_dropdown('cboDDR',$DDRCombo,0,'class="form-control" id="cboDDR" '); 
		  			?>
		  			<br/>
		  		</div>		  		
		  		<div class="col-md-4">
		  			<br/>
		  			<input type="button" name="btnBuscarCartasAceptacion" id="btnBuscarCartasAceptacion" value="Buscar" class="btn btn-info">
		  		</div>
		  	</div>
		  	<div class="row">
		  		<div class="col-md-12">
		  			<p>Cartas pendientes de Agregar</p>
		  			<table class="table table-condensed" id='idTablaDetalleTmpCartasApertura'>
						<thead>
						    <tr>						    	
						      	<th>#</th>
						      	<th>ID</th>
						      	<th>Nombre</th>
						      	<th>SURI</th>
						      	<th>Id Concepto</th>
						      	<th>Concepto</th>
						      	<th>Haz</th>
						      	<th>Apoyo</th>
						      	<th>Aportación</th>
						      	<th>Acciones</th>
						    </tr>
						</thead>
						<tbody>
						</tbody>
					</table>
	  				
	  			</div>	  		
		  	</div>
		  	<hr/>
		  	<div class="row">
		  		<div class="col-md-12">
		  			<p>Cartas pendientes Agregadas</p>
		  			<table class="table table-condensed" id='idTablaDetalleCartasApertura'>
						<thead>
						    <tr>
						      	<th>#</th>
						      	<th>ID</th>
						      	<th>Nombre</th>
						      	<th>SURI</th>
						      	<th>Id Concepto</th>
						      	<th>Concepto</th>
						      	<th>Haz</th>
						      	<th>Apoyo</th>
						      	<th>Aportación</th>
						      	<th>Acciones</th>
						    </tr>
						</thead>
						<tbody>
						</tbody>
					</table>
	  				
	  			</div>	  		
		  	</div>
	  	</div><!-- fin del panel body -->
	  	<div class="panel-footer">
			<div class="row">
		  		<div class="col-md-3" id='idDivGrabarOficioRemesa'>
		  			<input type="button" class="btn btn-primary" name="btnGrabarOficioRemesa" id="btnGrabarOficioRemesa" value="Grabar Oficio" />	  			
		  		</div>
				<div class="col-md-3" id='idDivEnviarCorreoOficioRemesa'>
		  			<input type="button" class="btn btn-info" name="btnEditarOficioAceptacion" id="btnEnviarCorreoOficioApertura" value="Editar Plantilla del Oficio" />	  			
		  		</div>
		  		<div class="col-md-3" id='idDivGeneraOficioRemesa'>					
		  			<input type="button"  class="btn btn-info" name="btnGeneraOficioRemesa" id="btnGeneraOficioRemesa" value="Generar Oficio" />
		  			<!--enviar_correo_general( $email_from, $email_to, $email_bcc, $email_bco,$email_titulo,$email_msg,$email_file = null){-->
		  			<!--<input type="button" onclick="<?php //echo base_url('impresiones_controller/correo_prueba')?>" name="btnCorreoPrueba" id="btnCorreoPrueba" value="Enviar correo General de Prueba">-->
		  			<button onclick="location.href='<?php echo base_url();?>impresiones_controller/correo_prueba'">Register</button>

		  				<!--

		  					$accion = $accion . '<a target= "new" href= "'.base_url('impresiones_controller/idr_aflatoxinas/').$registro->ID_DETALLE_MUESTRA.'">';
							$accion = $accion . '<button type="button" data-toggle="tooltip"  title="IDR Aflatoxinas" class="btn btn-default btn-xs" aria-label="Left Align"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button></a>';
						-->
		  		</div>				
		  	</div>
	  	</div>
	</div><!-- fin del panel primary-->
</div> <!-- fin del container fluid -->