<div class="container-fluid">
	<div class="panel panel-primary">
	  <div class="panel-heading"><?php echo $panel_title ?></div>
	  <div class="panel-body">
	  	
	  	<div class="row">
	  		<div class="col-md-12 form-group">
	  			<?php 
	  				$nombre = $data->nombre_usuario;
	  				echo '<p>Liga de confirmacion registrada correctamente ['.$nombre.']; esperar la verificación del su usuario por parte del encargado<br>cualquier duda o comentario hacerla llegar al área de sistemas.</p>';
	  			?>	  			
	  		</div>
	  	</div>	  	

	    <!--Panel content-->
	  </div>
	  <div class="panel-footer">
	    <input type="button" name="btnLogin" onclick="window.location.href='<?php echo base_url("login"); ?>'" value="Login" class="btn btn-primary" />
	    
	  </div>
	</div>
</div>
