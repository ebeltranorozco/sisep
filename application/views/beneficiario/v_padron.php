<?php
//$cNombre			= array( 'name'=>'nombre_usuario', 'class'=>'form-group','value' => set_value('nombre_usuario') );
$cNombreUser     	= array( 'id'=>'nombre_usuario' ,'name'=>'nombre_usuario' ,'class'=>'form-control', 'value'=>set_value('nombre_usuario'));
$cAliasUser     	= array( 'id'=>'alias_usuario' ,'name'=>'alias_usuario' ,'class'=>'form-control', 'value'=>set_value('alias_usuario'));
$cPassUser     		= array( 'id'=>'pass_usuario' ,'name'=>'pass_usuario' ,'class'=>'form-control', 'value'=>set_value('pass_usuario'));
$cPass2User     	= array( 'id'=>'pass2_usuario' ,'name'=>'pass2_usuario' ,'class'=>'form-control', 'value'=>set_value('pass2_usuario'));
$cCorreo1User     	= array( 'id'=>'correo1_usuario' ,'name'=>'correo1_usuario' ,'class'=>'form-control', 'value'=>set_value('correo1_usuario'));
$cCorreo2User     	= array( 'id'=>'correo2_usuario' ,'name'=>'correo2_usuario' ,'class'=>'form-control', 'value'=>set_value('correo2_usuario'));
$cProgramaUser     	= array( 'id'=>'programa_usuario' ,'name'=>'programa_usuario' ,'class'=>'form-control', 'value'=>set_value('programa_usuario'));
$cComponenteUser    = array( 'id'=>'componente_usuario' ,'name'=>'componente_usuario' ,'class'=>'form-control', 'value'=>set_value('componente_usuario'));
$cIncentivoUser     = array( 'id'=>'incentivo_usuario' ,'name'=>'incentivo_usuario' ,'class'=>'form-control', 'value'=>set_value('incentivo_usuario'));
$cCargoUser			= array( 'id'=>'cargo_usuario' ,'name'=>'cargo_usuario' ,'class'=>'form-control', 'value'=>set_value('cargo_usuario'));
?>

<?php
//var_dump($ProgramasFederalesCombo);
//var_dump($data);
?>

<div class="container-fluid">
	<div class="panel panel-primary">
	  <div class="panel-heading"><?php echo $panel_title ?></div>
	  <div class="panel-body">
	  	<!--<form method="POST" action="<?php echo base_url(); ?>login_usuario"  >-->
	  	

	  	<div class="row">
	  		<div class="col-md-12 form-group">
	  			<h6>
 					<?php echo $this->table->generate( $data); ?>
 				</h6>


	  		</div>
	  	</div>	  	



	    <!--Panel content-->
	  </div>
	  <div class="panel-footer">
	    <input type="submit" name="btnContinuar" value="Continuar" class="btn btn-primary" />
	    
	  </div>
	</div>
</div>

