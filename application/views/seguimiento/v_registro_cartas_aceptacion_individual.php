<?php // definicion de variables

$no_oficio			= array('id'=>'no_oficio_remesa', 'name'=>'no_oficio_remesa', 'class'=>'form-control', 'value'=>set_value('no_oficio_remesa') );
$fecha_oficio		= array('id'=>'fecha_oficio_remesa', 'name'=>'fecha_oficio_remesa', 'class'=>'form-control', 'value'=>set_value('fecha_oficio_remesa') );
$fecha_acuse		= array('id'=>'fecha_acuse_oficio_remesa', 'name'=>'fecha_acuse_oficio_remesa', 'class'=>'form-control', 'value'=>set_value('fecha_acuse_oficio_remesa') );


//$fecha_acuse['value'] = '2017-12-10';

if ($accion == 'ALTA'){
	$no_oficio['value'] = '411.2017.12.05';
	$fecha_oficio['value'] = '2017-12-10';	
	$fecha_acuse['readonly'] = false;	
}

if ($accion == 'VISUALIZACION'){
	$no_oficio['value'] 	= $oficios->no_oficio_remesa_seguimiento;
	$fecha_oficio['value'] 	= $oficios->fecha_oficio_remesa_seguimiento;
	$fecha_acuse['value'] 	= $oficios->fecha_acuse_remesa_seguimiento;

	$no_oficio['readonly'] = true;
	$fecha_oficio['readonly'] = true;
	$fecha_acuse['readonly'] = true;
//	var_dump($cartas_aceptacion);
}

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
		  				if ($accion=='ALTA') {
		  					echo form_label('DDR:');
		  					echo form_dropdown('cboDDR',$DDRCombo,0,'class="form-control" id="cboDDR" '); 	
		  				}		  				
		  			?>
		  			<br/>
		  		</div>		  		
		  		<div class="col-md-4">
		  			<br/>
		  			<!--<input type="button" name="btnBuscarCartasAceptacion" id="btnBuscarCartasAceptacion" value="Buscar" class="btn btn-info">-->
		  		</div>
		  	</div>
		  	<div class="row">
		  		<div class="col-md-12">
		  			<?php if ($accion == 'ALTA') { ?>
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
					<?php } ?>
	  				
	  			</div>	  		
		  	</div>
		  	<hr/>
		  	<div class="row">
		  		<div class="col-md-12">
		  			<?php if ($accion =='ALTA') { echo '<p>Cartas pendientes Agregadas</p>';}else{ echo '<p>Cartas Agregadas</p>';} ?>		  			
		  			<table class="table table-condensed table-bordered" id='idTablaDetalleCartasApertura'>
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
						<?php if ($accion == 'VISUALIZACION') { 
							foreach ($cartas_aceptacion as $carta) {
								echo '<tr>';									
									echo '<th>'.$carta->id_seguimiento.'</th>';
									echo '<th>'.$carta->id_seguimiento.'</th>';
									echo '<th>'.$carta->nombre_beneficiario_seguimiento.'</th>';
									echo '<th>'.$carta->folio_suri_seguimiento.'</th>';
									echo '<th>'.$carta->id_concepto.'</th>';
									echo '<th>'.$carta->nombre_concepto.'</th>';
									echo '<th>'.$carta->has_seguimiento.'</th>';
									echo '<th>'.$carta->aportacion_federal_seguimiento.'</th>';
									echo '<th>'.$carta->aportacion_productor_seguimiento.'</th>';
									echo '<th>'."".'</th>';									
								echo '</tr>';
							}
						} ?>

						</tbody>
					</table>
	  				
	  			</div>	  		
		  	</div>
	  	</div><!-- fin del panel body -->
	  	<div class="panel-footer">
			<div class="row">
		  		<div class="col-md-3" id='idDivGrabarOficioRemesa'>
		  			<?php if ($accion == 'ALTA') { ?>
		  				<input type="button" class="btn btn-primary" name="btnGrabarOficioRemesa" id="btnGrabarOficioRemesa" value="Grabar Oficio" />	  			
		  			<?php } ?>
		  		</div>
		  		<div class="col-md-3" id='idDivGeneraOficioRemesa'>					
		  			<!--input type="button"  class="btn btn-info" name="btnGeneraOficioRemesa" id="btnGeneraOficioRemesa" value="Generar Oficio" /> -->
		  			<!-- <input type="button"  class="btn btn-info" name="btnGeneraOficioRemesaTmp" id="btnGeneraOficioRemesaTmp" value="Prueba Temporal" />-->
		  			
		  			<button type="button" class="btn btn-warning" id='idBtnGeneraOficioRemesaOK' formtarget="_blank"  >Generar Oficio via php</button>
		  			<!--enviar_correo_general( $email_from, $email_to, $email_bcc, $email_bco,$email_titulo,$email_msg,$email_file = null){-->
		  			<!--<input type="button" onclick="<?php //echo base_url('impresiones_controller/correo_prueba')?>" name="btnCorreoPrueba" id="btnCorreoPrueba" value="Enviar correo General de Prueba">-->
		  			<!--<button onclick="location.href='<?php echo base_url();?>impresiones_controller/correo_prueba'">Register</button>-->

		  				<!--

		  					$accion = $accion . '<a target= "new" href= "'.base_url('impresiones_controller/idr_aflatoxinas/').$registro->ID_DETALLE_MUESTRA.'">';
							$accion = $accion . '<button type="button" data-toggle="tooltip"  title="IDR Aflatoxinas" class="btn btn-default btn-xs" aria-label="Left Align"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button></a>';
						-->
		  		</div>				
				<div class="col-md-3" id='idDivEnviarCorreoOficioRemesa'>
		  			<input type="button" class="btn btn-info" name="btnEditarOficioAceptacion" id="btnEnviarCorreoOficioApertura" value="Enviar Correo Oficio" />
		  		</div>

		  	</div>
	  	</div>
	</div><!-- fin del panel primary-->
</div> <!-- fin del container fluid -->