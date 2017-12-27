<?php // definicion de variables

$no_oficio			= array('id'=>'no_oficio_apertura', 'name'=>'no_oficio_apertura', 'class'=>'form-control', 'value'=>set_value('no_oficio_apertura') );
$fecha_oficio		= array('id'=>'fecha_oficio_apertura', 'name'=>'fecha_oficio_apertura', 'class'=>'form-control', 'value'=>set_value('fecha_oficio_apertura') );
$fecha_acuse		= array('id'=>'fecha_acuse_oficio_apertura', 'name'=>'fecha_acuse_oficio_apertura', 'class'=>'form-control', 'value'=>set_value('fecha_acuse_oficio_apertura') );

$id_beneficiario= array('id'=>'id_beneficiario', 'name'=>'id_beneficiario', 'class'=>'form-control', 'value'=>set_value('id_beneficiario'),'readonly'=>'TRUE' );
$nombre_beneficiario= array('id'=>'nombre_beneficiario', 'name'=>'nombre_beneficiario', 'class'=>'form-control', 'value'=>set_value('nombre_beneficiario'),'placeholder'=>'Ingrese minimo 5 caracteres' ,'value'=>'maria');


$folio_interno						=array('id'=>'folio_interno','name'=>'folio_interno','class'=>'form-control','value'=>set_value('folio_interno'),'readonly'=>TRUE);
$folio_suri							=array('id'=>'folio_suri','name'=>'folio_suri','class'=>'form-control','value'=>set_value('folio_suri'),'readonly'=>TRUE);
$fecha_folio_suri					=array('id'=>'fecha_folio_suri','name'=>'fecha_folio_suri','class'=>'form-control','value'=>set_value('fecha_folio_suri'),'readonly'=>TRUE);
$nombre_beneficiario_seleccionado	=array('id'=>'nombre_beneficiario_seleccionado','name'=>'nombre_beneficiario_seleccionado','class'=>'form-control','value'=>set_value('nombre_beneficiario_seleccionado'),'readonly'=>TRUE);
//$concepto_real						=array('id'=>'concepto_real','name'=>'concepto_real','class'=>'form-control','value'=>set_value('concepto_real'),'readonly'=>TRUE);
$concepto_real						=array('id'=>'concepto_real','name'=>'concepto_real','class'=>'form-control','value'=>set_value('concepto_real'),'readonly'=>TRUE);
$has_real 							=array('id'=>'has_real','name'=>'has_real','class'=>'form-control','value'=>set_value('has_real'),'readonly'=>TRUE);
$monto_apoyo_real 					=array('id'=>'monto_apoyo_real','name'=>'monto_apoyo_real','class'=>'form-control','value'=>set_value('monto_apoyo_real'),'readonly'=>TRUE);
$monto_productor_real				=array('id'=>'monto_productor_real','name'=>'monto_productor_real','class'=>'form-control','value'=>set_value('monto_productor_real'),'readonly'=>TRUE);
$producto_real						=array('id'=>'producto_real','name'=>'producto_real','class'=>'form-control','value'=>set_value('producto_real'),'readonly'=>TRUE);
$ddr 								=array('id'=>'ddr_real','name'=>'ddr_real','class'=>'form-control','value'=>set_value('ddr_real'),'readonly'=>TRUE);
$nombre_proyecto 					=array('id'=>'nombre_proyecto','name'=>'nombre_proyecto','class'=>'form-control','value'=>set_value('nombre_proyecto'),'readonly'=>TRUE);

$no_oficio['value'] = '311.2017.12.05';

$fecha_oficio['value'] = '2017-12-05';
//$fecha_acuse['value'] = '2017-12-10';
$fecha_acuse['readonly'] = false;
?>
<div class="container-fluid">
	<div class="panel panel-primary">
	  <div class="panel-heading"><?php echo $panel_title ?></div>
	  <div class="panel-body">
	  	<!--<form method="POST" action="<?php echo base_url(); ?>login_usuario"  >-->
	  	

	  	<div class="row">
	  		<div class="col-md-4"><?php echo form_label('No. Oficio:');echo form_input($no_oficio);?></div>
	  		<div class="col-md-4"><?php echo form_label('Fecha Oficio:');echo form_input($fecha_oficio);?></div>
	  		<div class="col-md-4"><?php echo form_label('Fecha Acuse:');echo form_input($fecha_acuse);?></div>	  		
	  	</div>
	  	<br/>
	  	<div class="row">	  		
	  		<div class="col-md-2"><?php echo form_label('ID:'); echo form_input($id_beneficiario)?></div>
	  		<div class="col-md-6"><?php echo form_label('Nombre del Beneficiario:');echo form_input($nombre_beneficiario) ;?></div>
	  		<div class="col-md-2"><br><input type="button" id='btnBuscarBeneficiario' name="btnBuscarBeneficiario" value="Buscar" class="btn btn-primary" /></div>
	  	</div>
	  	<hr>
	  	<div class="row">
	  		<div class="col-md-12">
	  			<div id='idDivBuscarBeneficiarioApertura'></div>	
	  		</div>	  		
	  	</div>

		<br/>

		<div class="row">
			<div class="col-md-4"><?php echo form_label('Folio Interno:'); echo form_input($folio_interno); ?></div>
			<div class="col-md-4"><?php echo form_label('Folio SURI:'); echo form_input($folio_suri); ?></div>
			<div class="col-md-4"><?php echo form_label('Fecha Folio SURI:'); echo form_input($fecha_folio_suri); ?></div>
		</div>			

		<div class="row">
			<div class="col-md-4"><?php echo form_label('Nombre:'); echo form_input($nombre_beneficiario_seleccionado); ?></div>
			<div class="col-md-4">
				<?php 
					echo form_label('Concepto:'); 
					//$ConceptosFederalesCombo['0']='Seleccione';
					echo form_dropdown('cboConceptos',$ConceptosFederalesCombo,0,'class="form-control" id="cboConceptos" disabled="disabled"'); 

				?>
			</div>

			<div class="col-md-4"><?php echo form_label('HAS:'); echo form_input($has_real); ?></div>			
		</div>			
		
		<div class="row">
			<div class="col-md-4"><?php echo form_label('Producto:'); echo form_input($producto_real); ?></div>
			<div class="col-md-4"><?php echo form_label('Monto de Apoyo:'); echo form_input($monto_apoyo_real); ?></div>
			<div class="col-md-4"><?php echo form_label('Aportacion Productor:'); echo form_input($monto_productor_real); ?></div>
		</div>
		<div class="row">
			<div class="col-md-4"><?php echo form_label('DDR del Proyecto:'); echo form_input($ddr); ?></div>
			<div class="col-md-8"><?php echo form_label('Nombre del Proyecto:'); echo form_input($nombre_proyecto); ?></div>			
		</div>

		<div class="row">
			<div class="col-md-4"><input type="button" style="display: none" class="btn btn-primary" id="btnAgregaBeneficiarios" value="Agregar" /></div>			
		</div>

		<hr>
		
	  	<div class="row">
	  		<div class="col-md-12">
	  			<?php echo $this->table->generate(); ?>	  			
	  		</div>	  		
	  	</div>

		<div class="row">
	  		<div class="col-md-4" id='idDivGrabarOficioApertura'>
	  			<input type="button" name="btnGrabarApertura" id="btnGrabarApertura" class="btn btn-primary" value="Grabar Oficio" />	  			
	  		</div>
			<div class="col-md-4" id='idDivEnviarCorreoOficioApertura'>
	  			<input type="button" name="btnEnviarCorreoOficioApertura" class="btn btn-info" id="btnEnviarCorreoOficioApertura" value="Enviar Correo Confirmación" />	  			
	  		</div>
	  	</div>



	  </div><!-- fin del panel body -->
	</div><!-- fin del panel primary-->
</div> <!-- fin del container fluid -->
