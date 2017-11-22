<?php
//$cNombre			= array( 'name'=>'nombre_usuario', 'class'=>'form-group','value' => set_value('nombre_usuario') );
$cNombreUser     	= array( 'id'=>'nombre_usuario' ,'name'=>'nombre_usuario' ,'class'=>'form-control', 'value'=>set_value('nombre_usuario'),'placeholder'=>'nombre y apellidos');
$cAliasUser     	= array( 'id'=>'alias_usuario' ,'name'=>'alias_usuario' ,'class'=>'form-control', 'value'=>set_value('alias_usuario'),'placeholder'=>'pseudonimo sin espacios');
$cPassUser     		= array( 'id'=>'pass_usuario' ,'name'=>'pass_usuario' ,'class'=>'form-control', 'value'=>set_value('pass_usuario'),'placeholder'=>'contraseña de ingreso');
$cPass2User     	= array( 'id'=>'pass2_usuario' ,'name'=>'pass2_usuario' ,'class'=>'form-control', 'value'=>set_value('pass2_usuario'),'placeholder'=>'volver a escribir la contraseña');
$cCorreo1User     	= array( 'id'=>'correo1_usuario' ,'name'=>'correo1_usuario' ,'class'=>'form-control', 'value'=>set_value('correo1_usuario'),'placeholder'=>'correo electronico principal');
$cCorreo2User     	= array( 'id'=>'correo2_usuario' ,'name'=>'correo2_usuario' ,'class'=>'form-control', 'value'=>set_value('correo2_usuario'),'placeholder'=>'correo electronico alterno');
//$cProgramaUser     	= array( 'id'=>'programa_usuario' ,'name'=>'programa_usuario' ,'class'=>'form-control', 'value'=>set_value('programa_usuario'));
//$cComponenteUser    = array( 'id'=>'componente_usuario' ,'name'=>'componente_usuario' ,'class'=>'form-control', 'value'=>set_value('componente_usuario'));
//$cIncentivoUser     = array( 'id'=>'incentivo_usuario' ,'name'=>'incentivo_usuario' ,'class'=>'form-control', 'value'=>set_value('incentivo_usuario'));
//$cDDR			    = array( 'id'=>'ddr_usuario' ,'name'=>'ddr_usuario' ,'class'=>'form-control', 'value'=>set_value('ddr_usuario'));
//$cCargoUser			= array( 'id'=>'cargo_usuario' ,'name'=>'cargo_usuario' ,'class'=>'form-control', 'value'=>set_value('cargo_usuario'));
?>

<?php

?>

<div class="container-fluid">
	<div class="panel panel-primary">
	  <div class="panel-heading"><?php echo $panel_title ?></div>
	  <div class="panel-body">
	  	<form method="POST" action="<?php echo base_url(); ?>graba_usuario?accion=new"  >
	  	<div class="row">
	  		<div class="col-md-6 form-group">
	  			<label>Nombre de Usuario:</label>
	  			<?php echo form_input( $cNombreUser); ?>
	  		</div>	  		
	  	</div>

	  	<div class="row">
	  		<div class="col-md-6 form-group">
	  			<label>Alias de Usuario:</label>
	  			<?php echo form_input( $cAliasUser); ?>
	  		</div>
	  	</div>

	  	<div class="row">
	  		<div class="col-md-6 form-group">
	  			<label>Cargo:</label>	  			
	  			<?php 	  			
	  			$CargosFederalesCombo['0']='Seleccione';	  			
            	echo form_dropdown('cbo_cargo_federal',$CargosFederalesCombo,set_value('cbo_cargo_federal',0),'class="form-control" id="cbo_cargo_federal"');
	  			?>
	  		</div>
	  	</div>

	  	<div class="row">
	  		<div class="col-md-6 form-group">	  		
	  			<label>Contraseña de Usuario:</label>
	  			<?php echo form_input( $cPassUser); ?>
	  		</div>
	  	</div>	  	

		<div class="row">
	  		<div class="col-md-6 form-group">
	  		<label>Contraseña de Usuario:</label>
	  		<?php echo form_input( $cPass2User); ?>
	  		</div>
	  	</div>

	  	<div class="row">
	  		<div class="col-md-6 form-group">
	  		<label>Correo Principal de Usuario:</label>
	  		<?php echo form_input( $cCorreo1User); ?>
	  		</div>
	  	</div>

	  	<div class="row">
	  		<div class="col-md-6 form-group">
	  		<label>Correo Alterno de Usuario:</label>
	  		<?php echo form_input( $cCorreo2User); ?>
	  		</div>
	  	</div>

	  	<div class="row">
	  		<div class="col-md-6 form-group">
	  		<label>Programa Federal:</label>
	  		
	  		<?php 
	  		$ProgramasFederalesCombo['0']='Seleccione';
            echo form_dropdown('cbo_programa_federal',$ProgramasFederalesCombo,set_value('cbo_programa_federal',0),'class="form-control" id="cbo_programa_federal"');
	  		?>
	  		</div>
	  	</div>

	  	<div class="row">
	  		<div class="col-md-6 form-group">
	  		<label>Componente Federal:</label>
	  		<?php 
	  		$ComponentesFederalesCombo['0']='Seleccione';
            echo form_dropdown('cbo_componente_federal',$ComponentesFederalesCombo,set_value('cbo_componente_federal',0),'class="form-control" id="cbo_componente_federal"');
	  		?>
	  		</div>
	  	</div>

	  	<div class="row">
	  		<div class="col-md-6 form-group">
	  		<label>DDR:</label>
	  		<?php 
	  		$DDRCombo['0']='No Aplica';
            echo form_dropdown('cbo_ddr',$DDRCombo,$selected = 0,'class="form-control" id="cbo_iddr"');
	  		?>
	  		</div>
	  	</div>

	    <!--Panel content-->
	  </div>
	  <div class="panel-footer">
	    <input type="submit" name="btnGrabaUsuario" value="Registrarse" class="btn btn-primary" />
	    
	  </div>
	</div>
</div>

