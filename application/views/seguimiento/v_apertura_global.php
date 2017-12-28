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
                    <button onclick="alert('pendiente de desarrollo');" class="btn btn-warning btn-xs" ><i class="glyphicon glyphicon-pencil"></i></button>
                    <button class="btn btn-warning btn-xs" onclick="window.location.href='<?php echo base_url('apertura?id=').$oficio->id_seguimiento;?>'"><i class="glyphicon glyphicon-info-sign"></i></button>                    
                    <button class="btn btn-danger btn-xs" onclick="alert('pendiente de desarrollo');"><i class="glyphicon glyphicon-remove"></i></button>                  

                    <!--$accion = $accion . '<button type="button" value="'.$registro->ID_MUESTRA.'" class="btn btn-danger btn-xs esCancelable" data-toggle="modal" data-target="#myModal" ><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true" data-toggle="tooltip"  title="Cancelar" value="'.$registro->ID_MUESTRA.'"  ></span></button>';-->
                    <button type="button" value="<?php echo $oficio->no_oficio_apertura_seguimiento; ?>" class="btn btn-danger btn-xs actualiza_fecha_acuse" data-toggle="modal" data-target="#myModal" ><span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true" data-toggle="tooltip"  title="Anexar fecha de acuse" value="<?php echo $oficio->no_oficio_apertura_seguimiento; ?>"  ></span></button>
                    
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
<!--*************VENTANA MODAL PARA LOS CASOS DE CANCELACION *********************************-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualización de la Fecha de Acuse</h4> 
      </div> <!--fin de modal header -->

      <div class="modal-body">

        <!-- vamos agregar las alertas -->
        <div id="msg_alerta_modal"></div> 
        <!-- LIMPIAR LOS CAMPOS -->
          
        <?php           
          //variables del detallado del estudio
          $cIdSeguimiento = array( 'id'=>'id_seguimiento','class'=>"form-control",'value'=>'');
          $cNoOficioApertura = array( 'id'=>'id_oficio_apertura','class'=>"form-control",'value'=>'');
          $dFechaAcuse    = array( 'id'=>'id_fecha_acuse','class'=>"form-control",'value'=>'','placeholder'>='formato AAAA-MM-DD');          
          $dFechaAcuse['value'] = date('Y-m-d');
          $cNoOficioApertura['readonly'] = true;
        ?>

        <div class="row">
          <div class="form-group">
                <label  class="col-sm-8 control-label" for="id_cte">No. Oficio Apertura:</label>                    
                <div class="col-sm-10">                        
                    <?php echo form_input($cNoOficioApertura); ?>
                </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group">
                <label  class="col-sm-8 control-label" for="id_cte">Fecha de Acuse:</label>                    
                <div class="col-sm-10">                        
                    <?php echo form_input($dFechaAcuse); ?>
                </div>
          </div>
        </div>
      </div> <!--fin de modal body -->          

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="idBtnCloseModal">Close</button>        
        <button type="button" class="btn btn-primary"  name="idBtnActualizaFechaAcuse" id="idBtnActualizaFechaAcuse">Aplicar</button>
      </div> <!--fin de modal footer -->        
        
    </div> <!--fin de modal content -->
      
  </div> <!--fin de modal dialog -->
</div> <!-- fin de modal fade (dice q esta de mas esta etiqueta-->