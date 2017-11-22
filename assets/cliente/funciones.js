if (typeof jQuery === 'undefined') {
  throw new Error('Bootstrap\'s JavaScript requires jQuery')
}

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

	$('#idTablaPadron tbody').on( 'click', 'button', function () {
        //var data = idTablaPadron.row( $(this).parents('tr') ).data();
        //alert( data[0] +"'s salary is: "+ data[ 5 ] );        
        //alert($(this).val());
        if (confirm('Seguro procesar el registro')){

        	url = 'http://localhost/sisep/beneficiario/padron_individual';
        	alert( url );
	        var id = 2;

	        $.ajax({		    
			    url : url,
			    data : { id : 2 },		 		    
			    type : 'POST',		 		    
			    dataType : 'json',		    
			    success : function(jsonResponse) {
			    	alert('salio ok');
			        console.log( jsonResponse);
			    }			
			});
	    }// fin del comfirm
    } );

	/*
    $('#idTablaPadron').on('click','input[type=button]',function(){
    	alert($(this).val());
	});
	*/

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


	var getUrl = window.location;
	var baseUrlCorta = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	var baseUrlCortaCorta = getUrl .protocol + "//" + getUrl.host + "/";

	//alert(getUrl);
	//alert(baseUrlCorta);
	//alert(baseUrlCortaCorta);
	
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
	var getUrl             = window.location; // obtiene la url exactamente a donde se encuentra
	var baseUrlCorta       = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var base_url           = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	var baseUrlCortaCorta  = getUrl .protocol + "//" + getUrl.host + "/";
		
	 //$('[data-toggle="tooltip"]').tooltip(); //activando los tooltips
	 /************************************************************/
	 
	 /****************************************************************/
	 
	/**********************************************************/
    $("#btnGeneraConvenio").click(function(){ // es para que genere el convenio desde padron individual
        var tipo_solicitante = $("#tipo_solicitante").val();
        var cesionado_usuario = $("#cesionado_usuario").val();
        var id_padron_beneficiario = $("#id_padron_beneficiario").val();
        //var url="http://localhost/sisep/beneficiario/genera_convenio?t="+tipo_solicitante+"&c="+cesionado_usuario;
        var url="http://localhost/sisep/beneficiario/genera_convenio?id="+id_padron_beneficiario;
        abrirEnPestana(url);  
    })
    /********************************************************************************/

    $("#btnPreparaConvenio").click(function(){ //edita convenio o alta boton del padron de beneficiario individual para editar el convenio
        // va a cargar 5 variables requeridas
        var tipo_solicitante = $("#tipo_solicitante").val();
        var cesionado_usuario = $("#cesionado_usuario").val();
        var url="http://localhost/sisep/beneficiario/prepara_convenio?t="+tipo_solicitante+"&c="+cesionado_usuario;
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
                        cHtml = '<table class="table table-striped table-condensed" summary="Análisis de ventas anuales">';
                        cHtml += '<caption>Listado de Beneficiario(s)</caption>';
                        cHtml += '<col style="width:10%;" />';
                        cHtml += '<col style="width:30%;" />';
                        cHtml += '<thead>';
                        cHtml += '<tr>';
                        cHtml += '<th scope="col">Nombre</th>';
                        cHtml += '<th scope="col">has</th>';
                        cHtml += '<th scope="col">Apoyo</th>';
                        cHtml += '<th scope="col">Aportacion</th>';
                        cHtml += '<th scope="col">Total</th>';
                        cHtml += '<th scope="col">Accion</th>';
                        cHtml += '</tr>';
                        cHtml += '</thead>';
                        cHtml += '<tbody>';
                        //var x = JSON.parse(jsonResponse.CONSULTA);
                        var x = jsonResponse['CONSULTA'];
                        console.log(x);
                        $.each(x,function(index, value){
                            //console.log('My array has at position ' + index + ', this value: ' + value);
                        });
                        console.log('cambiando');
                        for (var k in x) {
                            z = JSON.parse(k);
                            //console.log(x[k]);
                            
                            //console.log(ch->'nombre_solicitante');
                            console.log(z[0]);
                            z1 = jQuery.parseJSON(k);
                            //console.log(z1);
                        }
                        //var y= JSON.stringify(x[0]);
                        //console.log(y);
                        //alert(y);
                        //alert(x[0]->nombre_solicitante)

                        

                        //aqui me quede.

                        cHtml += '<tr>';                        
                        cHtml += '</tr>';
                        cHtml += '</tbody>';
                        cHtml += '</table>';
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

	
    
}); // FIN DEL JQUERY