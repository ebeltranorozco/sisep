<?php // definicion de variables

$no_oficio			= array('id'=>'no_oficio_apertura', 'name'=>'no_oficio_apertura', 'class'=>'form-control', 'value'=>set_value('no_oficio_apertura') );
$fecha_oficio		= array('id'=>'fecha_oficio_apertura', 'name'=>'fecha_oficio_apertura', 'class'=>'form-control', 'value'=>set_value('fecha_oficio_apertura') );
$fecha_acuse		= array('id'=>'fecha_acuse_oficio_apertura', 'name'=>'fecha_acuse_oficio_apertura', 'class'=>'form-control', 'value'=>set_value('fecha_acuse_oficio_apertura') );

$id_beneficiario= array('id'=>'id_beneficiario', 'name'=>'id_beneficiario', 'class'=>'form-control', 'value'=>set_value('id_beneficiario'),'readonly'=>'TRUE' );
$nombre_beneficiario= array('id'=>'nombre_beneficiario', 'name'=>'nombre_beneficiario', 'class'=>'form-control', 'value'=>set_value('nombre_beneficiario'),'placeholder'=>'Ingrese minimo 5 caracteres' ,'value'=>'maria');
//$no_oficio_apertura		= array('id'=>'', 'name'=>'', 'class'=>'form-control', 'value'=>set_value('') );


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
	  	<div class="row">
	  		<div class="col-md-12">
	  			<div id='idDivBuscarBeneficiarioApertura'></div>	
	  		</div>	  		
	  	</div>

	  </div><!-- fin del panel body -->
	</div><!-- fin del panel primary-->
</div> <!-- fin del container fluid -->
