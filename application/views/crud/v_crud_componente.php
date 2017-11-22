<div class="container-fluid">
  <div class="panel panel-primary">
    <div class="panel-heading"><?php echo $panel_title ?></div>
    <div class="panel-body">
      <!--<form method="POST" action="<?php echo base_url(); ?>login_usuario"  >-->
      

      <div class="row">
        <div class="col-md-12 form-group">
          <h3>CRUD Componentes del Sistema</h3>
          <br />

          <button class="btn btn-success" onclick="add_componente()"><i class="glyphicon glyphicon-plus"></i> Agrega Componente</button>

          <br />
          <hr>
          <table id="table_id_componente" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre Componente</th>
                <th style="width:125px;">Accion</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach($componentes as $componente){ ?>
                <tr>
                  <td><?php echo $componente->id_componente;?></td>
                  <td><?php echo $componente->nombre_componente;?></td>
                  
                  <td>
                  
                    <button class="btn btn-warning btn-xs" onclick="edit_componente(<?php echo $componente->id_componente;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                  
                    <button class="btn btn-danger btn-xs" onclick="delete_componente(<?php echo $componente->id_componente;?>)"><i class="glyphicon glyphicon-remove"></i></button>
                  
                  </td>
                </tr>
              <?php }?>     
            </tbody>
       
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Nombre Componente</th>                        
                <th>Accion</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>      



      <!--Panel content-->
    </div>
    <div class="panel-footer">
      <input type="submit" onclick="javascript:window.history.back()" name="btnRegresar" value="Regresar" class="btn btn-primary" />
      
    </div>
  </div>
</div>

<script type="text/javascript">
  
  var save_method; //for save method string
  var table; 
 
  function add_componente() {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
  }
 
  function edit_componente(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
 
      
      //Ajax Load data from ajax
      // obtiene la informacion del cliente  $this->clientes_crud_model->get_cliente_by_id($id); 
    $.ajax({
      url : "<?php echo site_url('/crud_controller/componente_ajax_edit/')?>/" + id, 
      type: "GET",
      dataType: "JSON",
      success: function(data) { 
          $('[name="id_componente"]').val(data.id_componente);
          $('[name="nombre_componente"]').val(data.nombre_componente);        

          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title').text('Modificación Componente'); // Set title to Bootstrap modal title

      }, // fin de funcion sucess
      error: function (jqXHR, textStatus, errorThrown)
      {
          alert('Error get data from ajax');
          console.log(jqxhr.responseText);
      } // fin de funcion error
    }); // fin de ajax
  }// fin de funcion edit_componente

 
 
  function save() {
    var url;
    if(save_method == 'add')
    {
        url = "<?php echo site_url('/crud_controller/componente_add')?>";
    }
    else
    {
      url = "<?php echo site_url('/crud_controller/componente_update')?>";
    }

     // ajax adding data to database
    //alert('metodo de grabado' + save_method);
    $.ajax({
      url : url,
      type: "POST",
      data: $('#form').serialize(),
      dataType: "JSON",
      success: function(data)
      {
         //if success close modal and reload ajax table
        $('#modal_form').modal('hide');
        console.log(data);
        //alert(data);
        location.reload();// for reload a page
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          //alert('Error al Agregar o Actualizar [ ' + errorThrown +']');
          alert( jqXHR.responseText);
          //alert( eval(jqXHR));
          //alert( eval(errorThrown));
          console.log(textStatus, errorThrown,jqXHR);
      }
    });
  } // fin de funcion save
 
  function delete_componente(id) {
    if(confirm('Seguro de Borrar el componente?')) {
      // ajax delete data from database
      $.ajax({
        url : "<?php echo site_url('/crud_controller/componente_delete')?>/"+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {               
           location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          var win = window.open('', '_blank');
          win.document.getElementsByTagName('html')[0].innerText = jqXHR.responseText;
          //$(win).innerText = jqXHR.responseText;
          //win.innerText = jqXHR.responseText ;
          
          //errtext = 'data:text/html;base64,' + window.open(jqXHR.responseText);
          //window.open(errtext, '_self');
          //document.open('text/html', true);
          //document.write(jqXHR.responseText);
          //document.close()

          //window.open('', '_self');
         // $(document).html(jqXHR.responseText);

          //window.open(jqXHR.responseText, "ventana1" , "width=500,height=500,scrollbars=NO") ;
            //window.open(jqXHR.responseText);  
            //alert('Error deleting data');
            console.log( jqXHR);
            console.log(errorThrown);
            console.log(textStatus);
        }
      });// fin del ajax
    } // fin del confirmar borrado
  }// fin funcion delete id
 
</script>
 
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Formulario Componente</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id_componente"/>
          <div class="form-body">

            <div class="form-group">
              <label class="control-label col-md-3">Nombre:</label>
              <div class="col-md-9">
                <input name="nombre_componente" id='nombre_componente' placeholder="Nombre del componente" class="form-control" type="text">
              </div>
            </div> 
            
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Grabar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
