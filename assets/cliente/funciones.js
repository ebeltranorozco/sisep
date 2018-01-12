if (typeof jQuery === 'undefined') {
  throw new Error('Bootstrap\'s JavaScript requires jQuery')
}
function number_format(amount, decimals) {  // formatear un numero decimales y coma

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}
/**************************************/
function randomString( nLong  ) {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  if (!nLong){ nLong = 10 ;}

  for (var i = 0; i < nLong; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}
/************************************/
function SeleccionaCartaAutorizacion(thisbutton){   
    
        var i = thisbutton.parentNode.parentNode.rowIndex;     
        //document.getElementById("idTablaTmpBeneficiarios").deleteRow(i);     
        //var nombre = $(i).parents("tr").find("td").eq(0).html();    

        var tabla = document.getElementById('idTablaDetalleTmpCartasApertura'); 
        /*
        cHtml = cHtml + '<td>'+obj[i].id_seguimiento+'</td>';
                            cHtml = cHtml + '<td>'+obj[i].id_padron_beneficiario+'</td>';
                            cHtml = cHtml + '<td>'+obj[i].nombre_beneficiario_seguimiento+'</td>';
                            cHtml = cHtml + '<td>'+obj[i].folio_suri_seguimiento+'</td>';
                            cHtml = cHtml + '<td>'+obj[i].id_concepto+'</td>';
                            cHtml = cHtml + '<td>'+obj[i].nombre_concepto+'</td>';
                            cHtml = cHtml + '<td>'+obj[i].has_seguimiento+'</td>';
                            cHtml = cHtml + '<td>'+obj[i].aportacion_federal_seguimiento+'</td>';
                            cHtml = cHtml + '<td>'+obj[i].aportacion_productor_seguimiento+'</td>';
        */
        var id_seguimiento                      = tabla.rows[i].cells[0].innerHTML;
        var id_padron_beneficiario              = tabla.rows[i].cells[1].innerHTML;
        var nombre_beneficiario_seguimiento     = tabla.rows[i].cells[2].innerHTML;
        var folio_suri_seguimiento              = tabla.rows[i].cells[3].innerHTML;
        var id_concepto                         = tabla.rows[i].cells[4].innerHTML;
        var nombre_concepto                     = tabla.rows[i].cells[5].innerHTML;
        var has_seguimiento                     = tabla.rows[i].cells[6].innerHTML;
        var aportacion_federal_seguimiento      = tabla.rows[i].cells[7].innerHTML;
        var aportacion_productor_seguimiento    = tabla.rows[i].cells[8].innerHTML;

        /*
        var folio_interno           = tabla.rows[i].cells[1].innerHTML;    
        var fecha_folio_suri        = tabla.rows[i].cells[3].innerHTML;
        var sistema_producto        = tabla.rows[i].cells[7].innerHTML;
        var ddr                     = tabla.rows[i].cells[11].innerHTML;
        var nombre_proyecto         = tabla.rows[i].cells[10].innerHTML;
        */
        
        if (confirm('Seleccionar al cliente ['+nombre_beneficiario_seguimiento+']' )){ 
            // asignamos los valores al la otra tabla
            document.getElementById("idTablaDetalleTmpCartasApertura").deleteRow(i);        

            cHtml = '<tr>';
            cHtml = cHtml + '<td>'+id_seguimiento+'</td>';
            cHtml = cHtml + '<td>'+id_padron_beneficiario+'</td>';
            cHtml = cHtml + '<td>'+nombre_beneficiario_seguimiento+'</td>';
            cHtml = cHtml + '<td>'+folio_suri_seguimiento+'</td>';
            cHtml = cHtml + '<td>'+id_concepto+'</td>';
            cHtml = cHtml + '<td>'+nombre_concepto+'</td>';
            cHtml = cHtml + '<td>'+has_seguimiento+'</td>';
            cHtml = cHtml + '<td>'+aportacion_federal_seguimiento+'</td>';
            cHtml = cHtml + '<td>'+aportacion_productor_seguimiento+'</td>';
            cHtml = cHtml + '<td>';
            //cHtml += '<button type="button" class="btn btn-info btn-xs" onclick="SeleccionaCartaAutorizacion(this)" ><span class="glyphicon glyphicon-ok"></span></button>';
            cHtml += '</td>';
            cHtml = cHtml + '</tr>';
                                        
            $("#idTablaDetalleCartasApertura tbody").append(cHtml);

            //$("#btnAgregaBeneficiarios").show();
            //$("#idDivBuscarBeneficiarioApertura").html( '');  // quito los nombres que se buscaron..!
        } // fin del confirmar    
    
    }// fin de funcion SeleccionaCartaAutorizacion
    /****************************************************************************************/
function btnSeleccionaBeneficiario(thisButton){   
    
    var i = thisButton.parentNode.parentNode.rowIndex;     
    //document.getElementById("idTablaTmpBeneficiarios").deleteRow(i);     
    //var nombre = $(i).parents("tr").find("td").eq(0).html();    

    var tabla = document.getElementById('idTablaTmpBeneficiarios'); 
    var id_padron_beneficiario  = tabla.rows[i].cells[0].innerHTML;
    var folio_interno           = tabla.rows[i].cells[1].innerHTML;
    var folio_suri              = tabla.rows[i].cells[2].innerHTML;
    var fecha_folio_suri        = tabla.rows[i].cells[3].innerHTML;    
    var nombre_seleccionado     = tabla.rows[i].cells[4].innerHTML;
    var id_concepto             = tabla.rows[i].cells[5].innerHTML;
    var has                     = tabla.rows[i].cells[6].innerHTML;
    var sistema_producto        = tabla.rows[i].cells[7].innerHTML;    
    var apoyo                   = tabla.rows[i].cells[8].innerHTML;
    var productor               = tabla.rows[i].cells[9].innerHTML;
    var ddr                     = tabla.rows[i].cells[11].innerHTML;
    var nombre_proyecto         = tabla.rows[i].cells[10].innerHTML;
    
    if (confirm('Seleccionar al cliente ['+nombre_seleccionado+']' )){ 
        // asignamos los valores al los input
        $("#id_beneficiario").val(id_padron_beneficiario);
        $("#folio_interno").val(folio_interno);
        $("#folio_suri").val(folio_suri);
        $("#fecha_folio_suri").val(fecha_folio_suri);
        $("#ddr_real").val( ddr );
        $("#nombre_beneficiario_seleccionado").val(nombre_seleccionado);        
        //$("#concepto_real").val(id_concepto);
        $('#cboConceptos option[value="5"]').attr("selected", true);  
        $("#has_real").val(has);
        $("#producto_real").val(sistema_producto);
        $("#monto_apoyo_real").val(apoyo);
        $("#monto_productor_real").val(productor);
        $("#nombre_proyecto").val(nombre_proyecto);

        // habilitando los input y el combobox y el boton
        $("#nombre_beneficiario_seleccionado").prop('readonly',false);
        $("#concepto_real").prop('readonly',false);
        $("#has_real").prop('readonly',false);
        $("#monto_apoyo_real").prop('readonly',false);
        $("#monto_productor_real").prop('readonly',false);
        $("#producto_real").prop('readonly',false);
        $("#cboConceptos").prop('disabled',false);
        $("#nombre_proyecto").prop('readonly',false);

        $("#btnAgregaBeneficiarios").show();

        $("#idDivBuscarBeneficiarioApertura").html( '');  // quito los nombres que se buscaron..!
    } // fin del confirmar    
    
}// fin de funcion EditaRowDetalladoIdrPlagicidas(this)

/************************************/

/*************************************/

/**********************************/
function abrirEnPestana(url) {
        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
}
/********************************************************/
/***********************A Q U I  E M P E Z A M O S  L O  D E  E L  J Q U E R Y*****************************/
$(function () {
	
	//alert($.fn.jquery);

	//alert('entrando el jquery');
    var getUrl = window.location;
    var baseUrlCorta = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var baseUrlCortaCorta = getUrl .protocol + "//" + getUrl.host + "/";
    var base_url = getUrl .protocol + "//" + getUrl.host ;  //2017-11-29

    if(base_url == 'http://localhost') {
        base_url += '/sisep';
        console.log('TRABAJANDO DE MANERA LOCAL');
    }

    //alert(getUrl);
    //alert(baseUrlCorta);
    //alert(baseUrlCortaCorta);

	$('#idTablaPadron tbody').on( 'click', 'button', function () {        
        var i = this.parentNode.parentNode.rowIndex;          

        var tabla = document.getElementById('idTablaPadron'); 
        var id_padron_beneficiario  = tabla.rows[i].cells[0].innerHTML;
        var nombre_beneficiario     = tabla.rows[i].cells[2].innerHTML;       

        
        if (confirm('Seguro procesar el registro ['+nombre_beneficiario+']')){
        	
            url = base_url + '/padron_individual?id='+id_padron_beneficiario;
        	//alert( url );
            //var url="http://localhost/sisep/beneficiario/genera_convenio?id="+id_padron_beneficiario;
            abrirEnPestana(url);	                  
	    }// fin del comfirm
    } );
	

    $('#idTablaPadron').DataTable( {
    	dom: 'lBfrtip',/*Bfrtip*/
            buttons: [
               {
                    extend: 'colvis',
                    columns: ':not(:first-child)',
                },
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
            ],
        "columnDefs": [
        	{
            "targets": [-1],
            "data": null,
            "defaultContent": "<button type='button'  class='btn btn-info btn-xs'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>"            
        	},        	
        	{
                "targets": [ 6 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 7 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 8 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 9 ],
                "visible": false,
                "searchable": false,
            },
            {
                "targets": [ 10 ],
                "visible": false,
                "searchable": false,
            },
            {
            	"targets": [3],
            	"className": "dt-right",
            },
            {
            	"targets": [4],
            	"className": "dt-right",
            },
            {
            	"targets": [5],
            	"className": "dt-right",
            },
        ],
        "language": {
            "lengthMenu": "Visualizar _MENU_ registros por pagina",
            "zeroRecords": "No se encontro nada - lo siento",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros para mostrar",
            "infoFiltered": "(filtrado desde _MAX_ total registro)"
        },
        stateSave: true,
        "lengthMenu": [[50,100,200, -1], [50,100, 200, "All"]]
    } );


	
	
	$("#ajax-loading").hide(); // ocultando la imagen de carga del ajax
	
	/*****************************************************************/ 		
	/* RECIEN AGREGANDO LO DE EL AJAX START */	
	$(document).ajaxStart(function() {	  
	  $("#ajax-loading").show();	 
	  });

	$(document).ajaxStop(function() {		
	  	$("#ajax-loading").hide();	    
	  });

	$.ajaxSetup({
	  error: function( jqXHR, textStatus, errorThrown ) {
	  		//console.log("Errores encontrados");
	  		console.log('Estado de error (TextStatus Error) ='+textStatus);
	  		console.log('error lanzado Throw Error ='+errorThrown);
	  		console.log(jqXHR);

	          if (jqXHR.status === 0) {
	            alert('Not connect: Verify Network.');
	          } else if (jqXHR.status == 404) {
	            alert('Requested page not found [404]');
	          } else if (jqXHR.status == 500) {
	            alert('Internal Server Error [500].');
	          } else if (textStatus === 'parsererror') {
	            alert('Requested JSON parse failed.');
	          } else if (textStatus === 'timeout') {
	            alert('Time out error.');
	          } else if (textStatus === 'abort') {
	            alert('Ajax request aborted.');
	          } else {
	            alert('Uncaught Error: ' + jqXHR.responseText);
	          }
	        }
	}); // fin del ajax setup		

    //$("#tablaDetalleMuestras td:nth-child(7), #tablaDetalleMuestras th:nth-child(7)").hide();  
    //$("#tablaDetalleMuestras td:nth-child(8), #tablaDetalleMuestras th:nth-child(8)").hide();  
	
	var cargando           = $("#ajax-loading");  // para el efecto del ajax
	//var getUrl             = window.location; // obtiene la url exactamente a donde se encuentra
	//var baseUrlCorta       = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    //var base_url           = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	//var baseUrlCortaCorta  = getUrl .protocol + "//" + getUrl.host + "/";
		
	 //$('[data-toggle="tooltip"]').tooltip(); //activando los tooltips
	 /************************************************************/
	 
	 /****************************************************************/
	 
	/**********************************************************/
    $("#btnGeneraConvenio").click(function(){ // es para que genere el convenio desde padron individual
        var tipo_solicitante = $("#tipo_solicitante").val();
        var cesionado_usuario = $("#cesionado_usuario").val();
        var id_padron_beneficiario = $("#id_padron_beneficiario").val();
        //var url="http://localhost/sisep/beneficiario/genera_convenio?t="+tipo_solicitante+"&c="+cesionado_usuario;
        var url= base_url + "/genera_convenio?id="+id_padron_beneficiario;
        abrirEnPestana(url);  
    })
    /********************************************************************************/

    $("#btnPreparaConvenio").click(function(){ //edita convenio o alta boton del padron de beneficiario individual para editar el convenio
        // va a cargar 5 variables requeridas
        var tipo_solicitante = $("#tipo_solicitante").val();
        var cesionado_usuario = $("#cesionado_usuario").val();
        var url= base_url+"/prepara_convenio?t="+tipo_solicitante+"&c="+cesionado_usuario;
        alert( url );
        abrirEnPestana(url); 
    });
    /*********************************************************************************************/
    $("#btnBuscarBeneficiario").click(function(){
        var nombre = $("#nombre_beneficiario").val();
        if (nombre.length >4 ){            
            //alert(base_url+'/buscar_beneficiarios');
            $.ajax({            
                url : base_url+'/buscar_beneficiarios',
                data : { nombre: nombre },                  
                type : 'POST',                  
                dataType : 'json',          
                success : function(jsonResponse) {                    
                    //console.log( jsonResponse);

                    if (jsonResponse['STATUS'] == 'OK') {
                        // HAY Q GENERAR LA TABLA
                        cHtml = '<table id="idTablaTmpBeneficiarios" class="table table-striped table-condensed" summary="Análisis de ventas anuales">';
                        cHtml += '<caption>Listado de Beneficiario(s)</caption>';
                        //cHtml += '<col style="width:10%;" />';
                        //cHtml += '<col style="width:30%;" />';
                        cHtml += '<thead>';
                        cHtml += '<tr>';
                        cHtml += '<th scope="col" style="display:none">ID</th>';                        
                        cHtml += '<th scope="col" style="display:none">Folio Interno</th>';
                        cHtml += '<th scope="col" style="display:none">Folio SURI</th>';
                        cHtml += '<th scope="col" style="display:none">Fecha Folio SURI</th>';
                        cHtml += '<th scope="col">Nombre</th>';
                        cHtml += '<th scope="col" style="display:none">ID Concepto</th>';
                        cHtml += '<th scope="col">has</th>';
                        cHtml += '<th scope="col" style="display:none">Producto</th>';                        
                        cHtml += '<th scope="col">Apoyo</th>';
                        cHtml += '<th scope="col">Aportacion</th>';
                        cHtml += '<th scope="col" style="display:none">Nombre del Proyecto</th>';
                        cHtml += '<th scope="col" style="display:none">DDR</th>';
                        cHtml += '<th scope="col">Accion</th>';
                        cHtml += '</tr>';
                        cHtml += '</thead>';
                        cHtml += '<tbody>';
                        //var x = JSON.parse(jsonResponse.CONSULTA);
                        var arrayNombres = jsonResponse['CONSULTA'];                       

                        $.each(arrayNombres, function(key_index,value){
                            cHtml += '<tr>';
                            cHtml += '<th scope="row" style="display:none">'+value.id_padron_beneficiario+'</th>';
                            cHtml += '<th scope="row" style="display:none">'+value.folio_interno+'</th>';
                            cHtml += '<th scope="row" style="display:none">'+value.folio_suri+'</th>';
                            cHtml += '<th scope="row" style="display:none">'+value.fecha_folio_suri+'</th>';
                            cHtml += '<th scope="row">'+value.nombre_solicitante+'</th>';
                            cHtml += '<th scope="row" style="display:none">'+value.id_concepto+'</th>';
                            cHtml += '<th scope="row">'+number_format(value.has_suri,2)+'</th>';                            
                            cHtml += '<th scope="row" style="display:none">'+value.producto_atender+'</th>';                            
                            cHtml += '<th scope="row">'+number_format(value.apoyo_solicitado,2)+'</th>';
                            cHtml += '<th scope="row">'+number_format(value.aportacion_productor,2)+'</th>';                            
                            cHtml += '<th scope="row" style="display:none">'+value.nombre_proyecto+'</th>';
                            cHtml += '<th scope="row" style="display:none">'+value.id_ddr+'</th>';
                            cHtml += '<th scope="row">';
                            cHtml += '<button type="button" class="btn btn-info btn-xs" onclick="btnSeleccionaBeneficiario(this)" ><span class="glyphicon glyphicon-chevron-right"></span></button>';
                            cHtml += '</th>';
                            cHtml += '</tr>';
                            //console.log(value.nombre_solicitante);
                        });
                        
                        cHtml += '</tbody>';
                        cHtml += '</table><hr>';
                        /*                        
                        $folio_interno                      =array('id'=>'folio_interno','name'=>'folio_interno','class'=>'form-control','value'=>set_value('folio_interno'),'readonly'=>TRUE);
                        $folio_suri                         =array('id'=>'folio_suri','name'=>'folio_suri','class'=>'form-control','value'=>set_value('folio_suri'),'readonly'=>TRUE);
                        $fecha_folio_suri                   =array('id'=>'fecha_folio_suri','name'=>'fecha_folio_suri','class'=>'form-control','value'=>set_value('fecha_folio_suri'),'readonly'=>TRUE);
                        $nombre_beneficiario_seleccionado   =array('id'=>'nombre_beneficiario_seleccionado','name'=>'nombre_beneficiario_seleccionado','class'=>'form-control','value'=>set_value('nombre_beneficiario_seleccionado'),'readonly'=>TRUE);
                        $concepto_real                      =array('id'=>'concepto_real','name'=>'concepto_real','class'=>'form-control','value'=>set_value('concepto_real'),'readonly'=>TRUE);
                        $has_real                           =array('id'=>'has_real','name'=>'has_real','class'=>'form-control','value'=>set_value('has_real'),'readonly'=>TRUE);
                        $monto_apoyo_real                   =array('id'=>'monto_apoyo_real','name'=>'monto_apoyo_real','class'=>'form-control','value'=>set_value('monto_apoyo_real'),'readonly'=>TRUE);
                        $monto_productor_real               =array('id'=>'monto_productor_real','name'=>'monto_productor_real','class'=>'form-control','value'=>set_value('monto_productor_real'),'readonly'=>TRUE);
                        $producto_real                      =array('id'=>'producto_real','name'=>'producto_real','class'=>'form-control','value'=>set_value('producto_real'),'readonly'=>TRUE);

                        */

                        


                        $("#idDivBuscarBeneficiarioApertura").html( cHtml);
                    }else{ alert(jsonResponse['ERROR']);}

                }           
            });
            
            //alert(baseUrlCortaCorta);
        }else{
            alert('debe ingresar un minimo de 4 caracteres');
        }

        //idDivBuscarBeneficiarioApertura

    }); // fin de btnBuscarBeneficiario
    /********************************************************************************************/
    $("#btnAgregaBeneficiarios").click(function(){ // boton agrega beneficiario a la tabla idTablaTmpDetalleSeguimiento
        
        var id_padron_beneficiario  = $("#id_beneficiario").val();
        var folio_interno           = $("#folio_interno").val();
        var folio_suri              = $("#folio_suri").val();
        var fecha_folio_suri        = $("#fecha_folio_suri").val();
        var nombre_seleccionado     = $("#nombre_beneficiario_seleccionado").val();
        //var id_concepto             = $("#cboConceptos").val(); // obtenemo el id del item del combo seleccionado
        //var nombre_concepto         = $("#cboConceptos").html(); // obtenemo el nombre del item del combo seleccionado
        var id_concepto             = $("#cboConceptos option:selected").val();
        var nombre_concepto         = $("#cboConceptos option:selected").text();
        var sistema_producto        = $("#producto_real").val();
        var has                     = $("#has_real").val();
        var apoyo                   = $("#monto_apoyo_real").val();
        var productor               = $("#monto_productor_real").val();
        var ddr                     = $("#ddr_real").val();
        var nombre_proyecto         = $("#nombre_proyecto").val();

        if ($('#idTablaTmpDetalleSeguimiento >tbody >tr').length == 0){
           $("#tablaDetalleMuestras").append("<tbody></tbody>");           
           //alert('agregando un TBODY');
        }

        // agregarmos a la tabla del detallado
        cHtml = '<tr id="'+randomString()+'" >';                                                                                                                                       //formatoNumero(numero, decimales, separadorDecimal, separadorMiles) {
        cHtml += '<td>'+id_padron_beneficiario+'</td>';
        cHtml += '<td>'+nombre_seleccionado+'</td>';
        cHtml += '<td>'+folio_suri+'</td>';
        //cHtml += '<td>'+nombre_proyecto+'</td>';
        cHtml += '<td>'+id_concepto+'</td>'; // oculto
        cHtml += '<td>'+nombre_concepto+'</td>'; 
        cHtml += '<td>'+ddr+'</td>'; // 
        cHtml += '<td>'+has+'</td>';
        cHtml += '<td>'+apoyo+'</td>';
        cHtml += '<td>'+productor+'</td>';       
        
        cHtml += '<td>';        
        //cHtml += '<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal" onclick="DuplicaRowDetalladoEstudio(this,1)" name="B2"><span class="glyphicon glyphicon-copy" data-toggle="tooltip" title="Duplicar Muestra"></span></button>';
        cHtml += '<button type="button" class="btn btn-info btn-xs" onclick="EliminaBeneficiarioTabla(this,1)" ><span class="glyphicon glyphicon-delete" data-toggle="tooltip" title="Eliminar Beneficiario"></span></button>';
        cHtml += '</td>';
        cHtml += '</tr>';
        //console.log( cHtml);
        $("#idTablaTmpDetalleSeguimiento").append(cHtml);        
    });
    /********************************************************************************************/
	$("#btnGrabarApertura").click(function(){ // llamado desde v_apertura_individual

        if (confirm('Grabar el Oficio')){
            //captar variables
            var no_oficio       = $("#no_oficio_apertura").val();
            var fecha_oficio    = $("#fecha_oficio_apertura").val();
            var fecha_acuse     = $("#fecha_acuse_oficio_apertura").val();

            //leyendo la tabla
            var detallado = new Array();
            var data = { enc:{'no_oficio':no_oficio,'fecha_oficio':fecha_oficio,'fecha_acuse': fecha_acuse},det:[]}
            
            $('#idTablaTmpDetalleSeguimiento tr').each(function () {

                    var id_padron_beneficiario  = $(this).find("td").eq(0).html();
                    var nombre_beneficiario     = $(this).find("td").eq(1).html();
                    var folio_suri              = $(this).find("td").eq(2).html();
                    var id_concepto             = $(this).find("td").eq(3).html();
                    var concepto                = $(this).find("td").eq(4).html();
                    var ddr                     = $(this).find("td").eq(5).html();
                    var haz                     = $(this).find("td").eq(6).html();
                    var apoyo                   = $(this).find("td").eq(7).html();
                    var aportacion              = $(this).find("td").eq(8).html();

                    if (id_padron_beneficiario) {
                        detallado.push( id_padron_beneficiario,nombre_beneficiario,folio_suri,id_concepto,concepto,ddr,haz,apoyo,aportacion);
                    }
                });
            console.log( detallado);
            data.det.push( detallado );            
            
            $.ajax({            
                data: data,
                method: 'POST',
                url: base_url+'/graba_oficio_apertura',
                success: function (htmlResponse){
                    console.log('termino sucesso el regreso de la funcion graba_oficio_apertura');
                    console.log(htmlResponse);
                    //alert(htmlResponse);
                    
                    if (htmlResponse['STATUS']=='OK'){
                        $("#idDivGrabarOficioApertura").hide();
                        alert('Oficio de Apertura Grabado');
                    }
                    
                }
            }); // fin del ajax    
        }// fin de grabar el oficio de apertura
    });
    /**********************************************************************************************/
    $("#btnEnviarCorreoOficioApertura").click(function(){
        if (confirm('Mandar Correo de Confirmacion de Oficio de Apertura')){
            //captar variables
            var no_oficio       = $("#no_oficio_apertura").val();
            var fecha_oficio    = $("#fecha_oficio_apertura").val();
            var fecha_acuse     = $("#fecha_acuse_oficio_apertura").val();

            //leyendo la tabla
            var detallado = new Array();
            var data = { enc:{'no_oficio':no_oficio,'fecha_oficio':fecha_oficio,'fecha_acuse': fecha_acuse},det:[]}
            
            $('#idTablaTmpDetalleSeguimiento tr').each(function () {

                    var id_padron_beneficiario  = $(this).find("td").eq(0).html();
                    var nombre_beneficiario     = $(this).find("td").eq(1).html();
                    var folio_suri              = $(this).find("td").eq(2).html();
                    var id_concepto             = $(this).find("td").eq(3).html();
                    var concepto                = $(this).find("td").eq(4).html();
                    var ddr                     = $(this).find("td").eq(5).html();
                    var haz                     = $(this).find("td").eq(6).html();
                    var apoyo                   = $(this).find("td").eq(7).html();
                    var aportacion              = $(this).find("td").eq(8).html();

                    if (id_padron_beneficiario) {
                        detallado.push( id_padron_beneficiario,nombre_beneficiario,folio_suri,id_concepto,concepto,ddr,haz,apoyo,aportacion);
                    }
                });
            console.log( detallado);
            data.det.push( detallado );            
            
            $.ajax({            
                data: data,
                method: 'POST',
                url: base_url+'/enviar_correo_oficio_apertura',
                success: function (htmlResponse){
                    console.log('termino sucesso el regreso de la funcion enviar_correo_oficio_apertura');
                    console.log(htmlResponse);                    
                    
                    if (htmlResponse['STATUS']=='OK'){
                        $("#idDivEnviarCorreoOficioApertura").hide();
                        alert('Correo de Confirmacion de oficio de apertura enviado');
                    }
                    
                }
            }); // fin del ajax    
        }// fin de grabar el oficio de apertura
    });
    /***********************************************************************************************/
    $("#btnGrabarPadron").click(function(){ // graba el montonal de campos del padron
        var accion = 'ALTA';

        if (confirm('Realizar la [' +accion + '] al Padron')){
            //captar variables
            //var cadena = $(this).serialize();
            var dataString = $('#frmGrabaPadronIndividual').serialize();
            console.log( dataString);
            
            $.ajax({            
                data: dataString,
                method: 'POST',
                url: base_url+'/graba_padron_individual',
                success: function (htmlResponse){
                    //console.log('entro a la funcion sucesso');
                    console.log(htmlResponse);
                    //alert(htmlResponse);
                    
                    if (htmlResponse['STATUS']=='OK'){
                        //$("#divBtnGrabaIDRPlaguicidas").hide();
                        alert('Grabado con Exito');
                    }
                    
                }
            }); // fin del ajax    
        }// fin de confirmar la accion 
    });
    /*************************************************************************************/
    $("#btnEnviarCorreoOficioApertura2").click(function(){
        if (confirm('Seguro Enviar Correo de Confirmación')){
            url = base_url + '/enviar_correo';            
            abrirEnPestana(url);
        }
    });
    /*************************************************************************************/
    $("#cboDDR").change(function(){
        //alert('entro');
        $('#idTablaDetalleTmpCartasApertura tbody').empty();
        $('#idTablaDetalleCartasApertura tbody').empty();
        var id_ddr = $(this).val();
        //alert( id_ddr);
        //rellenar la tabla tmp con el nuevo id
        $.ajax({
            data: {'id_ddr':id_ddr},
            dataType: 'json',
            type: 'POST',
            url: base_url+'/obtener_cartas_apertura',
            success: function (htmlResponse){
                console.log(htmlResponse);
                   
                if (htmlResponse['STATUS']=='OK'){
                    //alert('Resolviendo las cartas de apertura retornadas');
                    //var obj = jQuery.parseJSON(htmlResponse['CONSULTA'][0]); // esto funciono
                    var obj = htmlResponse['CONSULTA'];
                    console.log(obj); 

                    $.each(obj,function(i,value){
                        cHtml = '<tr>';
                        cHtml = cHtml + '<td>'+obj[i].id_seguimiento+'</td>';
                        cHtml = cHtml + '<td>'+obj[i].id_padron_beneficiario+'</td>';
                        cHtml = cHtml + '<td>'+obj[i].nombre_beneficiario_seguimiento+'</td>';
                        cHtml = cHtml + '<td>'+obj[i].folio_suri_seguimiento+'</td>';
                        cHtml = cHtml + '<td>'+obj[i].id_concepto+'</td>';
                        cHtml = cHtml + '<td>'+obj[i].nombre_concepto+'</td>';
                        cHtml = cHtml + '<td>'+obj[i].has_seguimiento+'</td>';
                        cHtml = cHtml + '<td>'+obj[i].aportacion_federal_seguimiento+'</td>';
                        cHtml = cHtml + '<td>'+obj[i].aportacion_productor_seguimiento+'</td>';
                        cHtml = cHtml + '<td>';
                        cHtml += '<button type="button" class="btn btn-info btn-xs" onclick="SeleccionaCartaAutorizacion(this)" ><span class="glyphicon glyphicon-ok"></span></button>';
                        cHtml += '</td>';
                        cHtml = cHtml + '</tr>';
                                                    
                        $("#idTablaDetalleTmpCartasApertura tbody").append(cHtml);
                        console.log(value);
                    });
                }                    
            }// fin de la funcion sucess del ajax
        }); // fin del ajax
    });
    /***************************************************************************************/
    
    
    $("#cboDDR").click(function(){
        //alert('entro2');
        //$('#idTablaDetalleTmpCartasApertura tbody').empty();
        //$('#idTablaDetalleCartasApertura tbody').empty();
    });
    /************************************************************************************/
    $("#btnGrabarOficioRemesa").click(function(){
        var no_oficio_apertura              = $("#no_oficio_apertura").val();
        var fecha_oficio_apertura           = $("#fecha_oficio_apertura").val();
        var fecha_acuse_oficio_apertura     = $("#fecha_acuse_oficio_apertura").val();
        
        if (!no_oficio_apertura || !fecha_oficio_apertura || $("#idTablaDetalleCartasApertura >tbody >tr").length==0){
            alert('información incompleta; debe llenar todos los campos requeridos ');
        }else {
            // inicio del ajax
            //var id_ddr = $(this).val();
            //alert( id_ddr);
            //rellenar la tabla tmp con el nuevo id

            if (confirm('Grabar el oficio')){


                var data = { enc:{'no_oficio_apertura':no_oficio_apertura,'fecha_oficio_apertura': fecha_oficio_apertura,'fecha_acuse_oficio_apertura':fecha_acuse_oficio_apertura},det:[]}
                    
                var detallado = new Array();

                $('#idTablaDetalleCartasApertura tr').each(function () {
                    var id_padron_beneficiario = $(this).find("td").eq(1).html();                
                    if (id_padron_beneficiario) {
                        detallado.push( id_padron_beneficiario);  
                    }
                });
                console.log( detallado);
                data.det.push(detallado);

                $.ajax({
                    data: data,
                    dataType: 'json',
                    type: 'POST',
                    url: base_url+'/grabar_oficio_remesa',
                    success: function (htmlResponse){
                        console.log(htmlResponse);
                           
                        if (htmlResponse['STATUS']=='OK'){
                            //alert('Resolviendo las cartas de apertura retornadas');
                            //var obj = jQuery.parseJSON(htmlResponse['CONSULTA'][0]); // esto funciono
                            //var obj = htmlResponse['CONSULTA'];
                            //console.log(obj);

                            $("#idDivGrabarOficioRemesa").hide();
                            $("#idDivGeneraOficioRemesa").show();                        
                        }                    
                    }// fin de la funcion sucess del ajax
                }); // fin del ajax
            } // fin del confirm
        }// fin del of no_oficio fecha y lenght del tr de la tabla
    });    
    /*************************************************************************************/
    function getBase64Image(img) {
        var canvas = document.createElement("canvas");
        canvas.width = img.width;
        canvas.height = img.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);
        var dataURL = canvas.toDataURL();
        return dataURL;
    }
    /*************************************************************************************/
    function getImageFromUrl(url) {
        var img = new Image();
        img.onError = function() {
            alert('Cannot load image: "'+url+'"');
        };        
        img.src = url;
    }
    /******************************************************************************************/
    var createPDF = function() {
        //alert('va');
        html2canvas( document.body,{
            onrendered: function (canvas){
                var img = canvas.toDataURL("image/png");
                var doc = new jsPDF;                
                doc.addImage( img, 'JPEG',20,20);
                //doc.save('prueba.pdf');               
            }
        });

        /*

        var pdf = new jsPDF();
        pdf.text(20,20,"Hola Mundo!");
        pdf.save('mipdf.pdf');

        */

/*

        html2canvas(document.body).then(function(canvas) {
             document.body.appendChild(canvas);
        });       
        

        html2canvas( document.body,{
            onrendered: function (canvas){
                var img = canvas.toDataURL("image/png");
                var doc = new jsPDF;                
                doc.addImage( img, 'JPEG',20,20);
                doc.save('prueba.pdf');               
            }
        });
        //alert('saliendo');
        //doc.save('prueba_canvas_efrain.pdf');
            
*/

        /*
        var doc = new jsPDF('p', 'pt', 'a4');
        var width = doc.internal.pageSize.width;    
        var height = doc.internal.pageSize.height;
        var options = {
             pagesplit: true}

        doc.text(10, 20, 'Crazy Monkey');
        
        var h1=50;
        var aspectwidth1= (height-h1)*(9/16);

        $('body').append('<div id="idDivWhile"></div>');                        
        $("#idDivWhile").html( '<p>PRUEBA DE UN TEST PDF</p>');
        
        //doc.addImage(imgData, 'JPEG', 10, 10, 120, 100, 'monkey');
        doc.addImage(getBase64Image('data:image/png;base64,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', 'PNG'), 10, 10, 120, 100, 'monkey');
        
        /*
        doc.addPage();
        doc.text(10, 20, 'Hello World');

        var h2=30;
        var aspectwidth2= (height-h2)*(9/16);
        doc.addImage(imgData, 'JPEG', 10, h2, aspectwidth2, (height-h2), 'monkey');
        */
        //doc.save('prueba.pdf');
        //doc.output('datauri');
    }; 
    /**********************************/
    $("#btnGeneraOficioRemesaTmp").click(function(){
        //getImageFromUrl('http://www.sagarpa.gob.mx/quienesomos/ci/PublishingImages/_t/sagarpa_jpg.jpg', createPDF);
        createPDF();
    });
    /****************************************************************************************/
    $("#btnGeneraOficioRemesa").click(function(){ // se cancelo y se manejo mediante impresiones_controller
        //variables temporales
        var id_programa     = 36;
        var id_componente   = 3658;
        var id_ddr          = 136;

        if (confirm('Generar el Oficio')){
            
            var data = { enc:{'id_programa':id_programa,'id_componente': id_componente,'id_ddr':id_ddr},det:[]}
            data.det.push(208); // padrones de beneficiario simulado
            data.det.push(2);

            
            $.ajax({
                data: data,
                dataType: 'json',
                type: 'POST',
                url: base_url+'/generar_oficio_remesa',
                success: function (htmlResponse){
                    console.log(htmlResponse);
                       
                    if (htmlResponse['STATUS']=='OK'){
                        //abrirEnPestana(htmlResponse['PLANTILLA']);
                        $("#idDivGrabarOficioRemesa").hide();
                        //$("#idDivGeneraOficioRemesa").hide();
                        //cargar el oficio en una pestaña nueva
                        //alert(htmlResponse['PLANTILLA']);

                        //var pdf = new jsPDF();
                        //pdf.text(30, 30, 'Hello world!');
                        //pdf.save('hello_world.pdf');


                        var pdf = new jsPDF('p', 'pt', 'a4');
                        var specialElementHandlers = {
                            '#editor': function (element, renderer) {
                                return true;
                            }
                        };

                        
                        
                        //var options = { pagesplit: true };

                        //pdf.addHTML(htmlResponse['PLANTILLA'], options, function() { pdf.save("test.pdf"); });

                        //alert($("#idDivPrueba").html());
                        
                        $('body').append('<div id="idDivWhile"></div>');
                        
                        //$("#idDivWhile").html( htmlResponse['PLANTILLA']);
                        $("#idDivWhile").html( '<p>PRUEBA DE UN TEST PDF</p>');

                        var logo = new Image();
                        logo.src = 'http://www.sagarpa.gob.mx/quienesomos/ci/PublishingImages/_t/sagarpa_jpg.jpg';
                        logo.width = 120;

                        var base64 = getBase64Image(document.getElementById("img"));
                        
                        pdf.addImage(base64, 'JPG', 15, 40,148,210);

                        
                        pdf.fromHTML($('#idDivWhile').get(0), 15, 15, {
                            'width': 500,
                            'elementHandlers': specialElementHandlers
                        },function(bla) {pdf.save('prueba.pdf');});
/*
                        pdf.fromHTML($('#idDivWhile').html(), 15, 15, {
                            'width': 170,
                            'elementHandlers': specialElementHandlers
                        });
*/                        
                        //var cNombreFile = htmlResponse['NOMBRE_PLANTILLA']+".PDF";
                        //pdf.save(cNombreFile);
                        //pdf.save('prueba.pdf');
                        


                    }                    
                }// fin de la funcion sucess del ajax
            }); // fin del ajax

        } // fin de generar el oficio
    });
    /*************************************************************************************/
    $(".actualiza_fecha_acuse").click(function(){ // 
        var cIdSeguimiento = $ (this).val();
        $("#id_oficio_apertura").val(cIdSeguimiento);
        //alert('Entro a la funcion en clase de la tabla esCancelable');
        //$("#id_fecha_acuse").val('');        
     });
    /****************************************************************************************/
    $(".actualiza_fecha_acuse_oficio_remesa").click(function(){
        var cOficio_Fecha = $(this).val(); // viene oficio y  fecha acuse separado por / (diagonal)
        var cNoOficio = cOficio_Fecha.substring(0,cOficio_Fecha.indexOf('/'));
        var dFechaAcuse = cOficio_Fecha.substring(cOficio_Fecha.indexOf('/')+1);
        //alert( cNoOficio);
        //alert(cIdSeguimiento);
        //alert( dFechaAcuse);
        if (dFechaAcuse=='0000-00-00') { dFechaAcuse = false;}
        $("#id_oficio_remesa").val(cNoOficio);
        $("#id_fecha_acuse").prop('readonly',false);
        if (dFechaAcuse){
            $("#id_fecha_acuse").val(dFechaAcuse);
            $("#id_fecha_acuse").prop('readonly',true);
            alert('fecha de acuse ya aplicada');
        }
        //alert(cIdSeguimiento);
    });
    /*************************************************************************************/
    $("#idBtnActualizaFechaAcuse").click(function(){ // viene de v_apertura_global --> btn q actualiza unicamente la fecha de acuse
        var cIdSeguimiento = $("#id_seguimiento").val();
        var cNoOficioApertura = $("#id_oficio_apertura").val();
        var dFechaAcuse = $("#id_fecha_acuse").val();        

        if (cNoOficioApertura  && dFechaAcuse ){

            if (confirm('Realizar la Actualizacion de la Fecha de Acuse')){
                var data = { 'no_oficio_apertura': cNoOficioApertura,'fecha_acuse_oficio_apertura':dFechaAcuse};

                $.ajax({
                data: data,
                dataType: 'json',
                type: 'POST',
                url: base_url+'/actualiza_fecha_acuse_oficio_apertura',
                    success: function (htmlResponse){
                        console.log(htmlResponse);
                           
                        if (htmlResponse['STATUS']=='OK'){                    
                            $("#idBtnCloseModal").click();
                            location.reload();                    
                        }// fin del if
                    }// fin de la funcion sucess del ajax
                }); // fin del ajax    
            }            
        }else { // fin del if cIdSeguimiento y dFechaAcuse
            alert('parametros incompletos');
        }
    });
    /*************************************************************************************/
    $("#idBtnActualizaFechaAcuseOficioRemesa").click(function(){ // viene de v_apertura_global --> btn q actualiza unicamente la fecha de acuse
        var cIdSeguimiento = $("#id_seguimiento").val();
        var cNoOficioRemesa = $("#id_oficio_remesa").val();
        var dFechaAcuse = $("#id_fecha_acuse").val();        

        if (cNoOficioRemesa  && dFechaAcuse ){

            if (confirm('Realizar la Actualizacion de la Fecha de Acuse')){
                var data = { 'no_oficio_remesa': cNoOficioRemesa,'fecha_acuse_oficio_remesa':dFechaAcuse};

                $.ajax({
                data: data,
                dataType: 'json',
                type: 'POST',
                url: base_url+'/actualiza_fecha_acuse_oficio_remesa',
                    success: function (htmlResponse){
                        console.log(htmlResponse);
                           
                        if (htmlResponse['STATUS']=='OK'){                    
                            $("#idBtnCloseModal").click();
                            location.reload();                    
                        }// fin del if
                    }// fin de la funcion sucess del ajax
                }); // fin del ajax    
            }            
        }else { // fin del if cIdSeguimiento y dFechaAcuse
            alert('parametros incompletos');
        }
    });
    /*************************************************************************************/
    $("#idBtnGeneraOficioRemesaOK").click(function(){ // traduce de la plantilla el oficio remesa y lo genera y casi casi lo manda x correo
        var no_oficio =$("#no_oficio_remesa").val();
        var fecha_oficio = $("#fecha_oficio_remesa").val();
        var cRuta = base_url + '/impresiones_controller/procesaygenera_oficio_remesa/?no='+no_oficio;
        window.open( cRuta,'_blank');
    });

    /*************************************************************************************/

    /*************************************************************************************/

    /*************************************************************************************/

    /*************************************************************************************/
    
}); // FIN DEL JQUERY