
<div class="container-fluid">
	<div class="panel panel-primary">
	  <div class="panel-heading"><?php echo $panel_title ?></div>
	  <div class="panel-body">  
	  	

	  	<div class="row">
        <div class="col-md-12 form-group">
          <h3>CRUD Registro de Cedulas de Pertinencia</h3>
          <br />
          <!--<button class="btn btn-success" onclick="window.location.href='<?php echo base_url('registro_cartas_autorizacion');?>'"><i class="glyphicon glyphicon-plus"></i> Agregar Oficio con Cartas de Autorización</button>-->
          <h5>Por Agregar</h5>
          <table id="table_id_cedula_pertinencia_por_agregadar" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Razon Social</th>
                <th>has</th>
                <th>Oficio Remesa</th>                
                <th style="width:125px;">Accion</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($cedulas_posibles as $cedula){ ?>
                <tr>
                  <td><?php echo $cedula->id_seguimiento;?></td>                  
                  <td><?php echo $cedula->nombre_beneficiario_seguimiento;?></td>
                  <td><?php echo $cedula->has_seguimiento;?></td>
                  <td><?php echo $cedula->no_oficio_remesa_seguimiento;?></td>                        

                  
                  <td>                  
                    <!-- ACCION AGREGAR -->
                    <!--<button class="btn btn-info btn-xs" onclick="alert('pendiente de desarrollo');"><i class="glyphicon glyphicon-plus"></i></button>-->
                    
                    <button class="btn btn-info btn-xs" onclick="window.location.href='<?php echo base_url('seguimiento_controller/cedula_pertinencia_individual?id=').$cedula->id_seguimiento;?>'"><i class="glyphicon glyphicon-plus"></i></button>
                  </td>
                </tr>
              <?php }?>     
            </tbody>
       
            <tfoot>
              <tr>                
                <th>ID</th>
                <th>Razon Social</th>
                <th>has</th>
                <th>Oficio Remesa</th>                
                <th style="width:125px;">Accion</th>
              </tr>
            </tfoot>
          </table>



          <!--- *************************** -->
          
          <br />
          <hr>
          <h5>Cedulas de Pertinencia</h5>
          <table id="table_id_cedula_pertinencia_agregadas" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                
                <th>No Solicitud</th>
                <th>Fecha Solicitud</th>
                <th>Fecha Acuse</th>
                <th>Razon Social</th>
                <th>Situación</th>
                <th style="width:125px;">Accion</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($cedulas_agregadas as $cedula){ ?>
                <tr>
                  <td><?php echo $cedula->id_cedula_pertinencia;?></td>                  
                  <td><?php echo $cedula->fecha_solicitud_c_pertinencia;?></td>
                  <td><?php echo $cedula->fecha_acuse_c_pertinencia;?></td>
                  <td><?php echo $cedula->nombre_beneficiario_seguimiento;?></td>
                  <td><?php 
                    if ( $cedula->condiciones_aptas_proyecto_c_pertinencia=='S' ){
                        echo 'Apoyado';
                      }else { 
                        echo 'No Apoyado';
                      }?>
                  </td>            

                  
                  <td>                  
                    <!--<button class="btn btn-warning btn-xs" onclick="edit_cedula(<?php echo $cedula->id_seguimiento_enc;?>)"><i class="glyphicon glyphicon-pencil"></i></button>-->
                    <!-- ACCION MODIFICACION-->
                    <button onclick="alert('pendiente de desarrollo');" class="btn btn-warning btn-xs" ><i class="glyphicon glyphicon-pencil"></i></button>
                    <!--<button class="btn btn-warning btn-xs" onclick="window.location.href='<?php echo base_url('registro_cartas_autorizacion?id=').$cedula->id_seguimiento;?>'"><i class="glyphicon glyphicon-info-sign"></i></button>                    -->
                    
                    
                    <!-- ACCION ELIMINAR -->
                    <button class="btn btn-danger btn-xs" onclick="alert('pendiente de desarrollo');"><i class="glyphicon glyphicon-remove"></i></button>          
                    
                    <!--ACCION FECHA DE ACUSE -->
                    <button type="button" value="<?php echo $cedula->nombre_beneficiario_seguimiento.'/'.$cedula->fecha_acuse_c_pertinencia; ?>" class="btn btn-danger btn-xs actualiza_fecha_acuse_cedula_pertinencia" data-toggle="modal" data-target="#myModal" ><span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true" data-toggle="tooltip"  title="Anexar fecha de acuse" value="<?php echo $cedula->nombre_beneficiario_seguimiento.'/'.$cedula->fecha_acuse_c_pertinencia; ?>"  ></span></button>
                    
                    
                    
                  </td>
                </tr>
              <?php }?>     
            </tbody>
       
            <tfoot>
              <tr>
                
                <th>No Solicitud</th>
                <th>Fecha Solicitud</th>
                <th>Fecha Acuse</th>
                <th>Razon Social</th>
                <th>Situación</th>
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
  function add_oficio_apertura2(){
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
          //$cIdSeguimiento = array( 'id'=>'id_seguimiento','class'=>"form-control",'value'=>'');
          //$cNoOficioRemesa = array( 'id'=>'id_oficio_remesa','class'=>"form-control",'value'=>'');
          
          $cRazonSocial = array('id'=>'id_razon_social','name'=>'id_razon_social','class'=>'form-control');
          $dFechaAcuse    = array( 'id'=>'id_fecha_acuse','class'=>"form-control",'value'=>'','placeholder'>='formato AAAA-MM-DD');          
          $dFechaAcuse['value'] = date('Y-m-d');
          $cNoOficioRemesa['readonly'] = true;

        ?>

        <div class="row">
          <div class="form-group">
                <label  class="col-sm-8 control-label" for="id_cte">Razon Social:</label>
                <div class="col-sm-10">                        
                    <?php echo form_input($cRazonSocial); ?>
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
        <button type="button" class="btn btn-primary"  name="idBtnActualizaFechaAcuseOficioRemesa" id="idBtnActualizaFechaAcuseOficioRemesa">Aplicar</button>
      </div> <!--fin de modal footer -->        
        
    </div> <!--fin de modal content -->
      
  </div> <!--fin de modal dialog -->
</div> <!-- fin de modal fade (dice q esta de mas esta etiqueta-->



<?php
var_dump($cedulas_posibles);
echo '<br/>';
echo '<br/>';
echo '<br/>';

var_dump($cedulas_agregadas)
?>