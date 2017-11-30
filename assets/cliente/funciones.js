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
        alert('Trabajando de Manera Local');
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
	$("#btnGrabarApertura").click(function(){



        if (confirm('Grabar el Oficio')){
            //captar variables
            var no_oficio       = $("#no_oficio_apertura").val();
            var fecha_oficio    = $("#fecha_oficio_apertura").val();
            var fecha_acuse     = $("#fecha_acuse_oficio_apertura").val();


            //leyendo la tabla
            var detallado = new Array();
            $('#idTablaTmpDetalleSeguimiento tr').each(function () {

                    var analito = $(this).find("td").eq(0).html();
                    var resultado = $(this).find("td").eq(1).html();
                    var lc = $(this).find("td").eq(2).html();
                    var lmp = $(this).find("td").eq(3).html();
                    var tecnica = $(this).find("td").eq(4).html();
                    if (analito) {
                        detallado.push( analito,resultado,lc,lmp,tecnica);  
                    }           

                });
            console.log( detallado);

            var data = { enc:{'no_oficio':no_oficio,'fecha_oficio':fecha_oficio,'fecha_acuse': fecha_acuse},det:[]}
            
            $.ajax({            
                data: data,
                method: 'POST',
                url: base_url+'/graba_oficio_apertura',
                success: function (htmlResponse){
                    console.log('entro a la funcion sucesso');
                    console.log(htmlResponse);
                    //alert(htmlResponse);
                    
                    if (htmlResponse['SITUACION_REGISTRO']=='EXITO'){
                        $("#divBtnGrabaIDRPlaguicidas").hide();
                        alert('Informe de Resultado Grabado');
                    }
                    
                }
            }); // fin del ajax    
        }// fin de grabar el oficio de apertura
    });
    /**********************************************************************************************/
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
    
    
}); // FIN DEL JQUERY