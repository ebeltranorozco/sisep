<div class="container-fluid">
	<div class="panel panel-primary">
	  <div class="panel-heading"><?php echo $panel_title ?></div>
	  <div class="panel-body">
	  	<!--<form method="POST" action="<?php echo base_url(); ?>login_usuario"  >-->
	  	

	  	<div class="row">
        <div class="col-md-12 form-group">
          <h3>CRUD Listado de Autorizaciones(Apertura)</h3>
          <br />

          <button class="btn btn-success" onclick="window.location.href='<?php echo base_url('apertura');?>'"><i class="glyphicon glyphicon-plus"></i> Agregar Oficio</button>
          
          <br />
          <hr>
          <table id="table_id_componente" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>No Oficio</th>
                <th>Fecha Oficio</th>
                <th>Fecha Acuse</th>
                <th style="width:125px;">Accion</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($oficios_apertura as $oficio){ ?>
                <tr>
                  <td><?php echo $oficio->id_seguimiento;?></td>
                  <td><?php echo $oficio->no_oficio_apertura_seguimiento;?></td>
                  <td><?php echo $oficio->fecha_oficio_apertura_seguimiento;?></td>
                  <td><?php echo $oficio->fecha_acuse_apertura_seguimiento;?></td>
                  
                  <td>                  
                    <!--<button class="btn btn-warning btn-xs" onclick="edit_oficio(<?php echo $oficio->id_seguimiento_enc;?>)"><i class="glyphicon glyphicon-pencil"></i></button>-->
                    <button class="btn btn-warning btn-xs" onclick="window.location.href='<?php echo base_url('apertura?id=').$oficio->id_seguimiento;?>'"><i class="glyphicon glyphicon-pencil"></i></button>
                    
                    <button class="btn btn-danger btn-xs" onclick="alert('pendiente de desarrollo');"><i class="glyphicon glyphicon-remove"></i></button>                  
                  </td>
                </tr>
              <?php }?>     
            </tbody>
       
            <tfoot>
              <tr>
                <th>ID</th>
                <th>No Oficio</th>
                <th>Fecha Oficio</th>
                <th>Fecha Acuse</th>
                <th style="width:125px;">Accion</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>    	



	    <!--Panel content-->
	  </div>
	  <div class="panel-footer">
	    <input type="button" name="btnRegresar" value="Regresar" class="btn btn-primary" />
	    
	  </div>
	</div>
</div>

<script type="text/javascript">
  function add_oficio_apertura(){
    alert('me pulsadeste');
  }
</script>