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
		  			<button type="button" class="btn btn-warning" id='idBtnGeneraOficioRemesaOK' formtarget="_blank"  >Generar Oficio via php</button>		  			
		  		</div>				
				<div class="col-md-3" id='idDivEnviarCorreoOficioRemesa'>
		  			<!--<input type="button" class="btn btn-info" name="btnEditarOficioAceptacion" id="btnEnviarCorreoOficioApertura" value="Enviar Correo Oficio" />-->
		  			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" id="oldbtnEnviarCorreoOficioApertura2" value="Enviar Correo Oficio" />
		  		</div>

		  	</div>
	  	</div>
	</div><!-- fin del panel primary-->
</div> <!-- fin del container fluid -->


<!-- ******************************************** PARTE MODAL PARA LA SUBIDA DE ARCHIVOS ****************************************-->
<!-- ******************************************** PARTE MODAL PARA LA SUBIDA DE ARCHIVOS ****************************************-->
<!-- ******************************************** PARTE MODAL PARA LA SUBIDA DE ARCHIVOS ****************************************-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelMetodologia">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">      
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabelMetodologia">Subida de Archivo(s)</h4>            
      		</div> <!--fin de modal header -->
      	
      	<div class="modal-body">

	        <!-- vamos agregar las alertas -->
	        <div id="msg_alerta_modal"></div> 
	        <!-- LIMPIAR LOS CAMPOS -->      
        

	        <div class="row">
	          <div class="form-group">
	                
	                <div class="col-sm-12">

	                	<?php 
	                		$cFile = array('name'=>'file_oficio_remesa','id'=>'file_oficio_remesa', 'class'=>'form-control','value'=>set_value('file_oficio_remesa'));
	                		$attributes = array('id' => 'form_subir_oficio_remesa');
	                		echo form_open_multipart('subir_oficio_remesa',$attributes);

	                		echo form_upload( $cFile);
	                		$attributes = array( 'class'=>'btn-xs btn-info');
	                		echo form_submit('btnSubirOficioRemesa','Subir Archivo',$attributes);
	                		echo form_close();
	                	?>
	                    
	                </div>
	          </div>
	        </div>           

	    </div> <!--fin de modal body -->       

		<div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal" id="idBtnCloseModal">Close</button>            
	        <button type="button" class="btn btn-primary"  id="enviar_correo_oficio_remesa">Aceptar</button>
	    </div> <!--fin de modal footer -->          
    
    </div> <!--fin de modal content -->      
  </div> <!--fin de modal dialog -->
</div> <!-- fin de modal fade -->
<!-- ************************************************************************************************-->  


