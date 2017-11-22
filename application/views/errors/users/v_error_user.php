<div class="container-fluid">
	<div class="panel panel-primary">
	  <div class="panel-heading"><?php echo $panel_title ?></div>
	  <div class="panel-body">	  	

	  	<div class="row">
	  		<div class="col-md-12 form-group">
	  			<h6>
 					<?php
 						if (isset($mensaje_error)) {
 							echo '<div class="alert alert-danger" role="alert">' . $mensaje_error. '</div>';
 						}
 						
 					?>
 				</h6>
			


	  		</div>
	  	</div>	  	


	  </div>
	  <div class="panel-footer">
	    <!--<input type="submit" name="btnRegresar" value="Regresar" class="btn btn-error" />-->	    
	  </div>
	</div>
</div>
