if (typeof jQuery === 'undefined') {
  throw new Error('Bootstrap\'s JavaScript requires jQuery')
}
/********************************************************/
//AUTHOR: Manu Dávila
//Blog: http://jquery-manual.blogspot.com
/***********************A Q U I  E M P E Z A M O S  L O  D E  E L  J Q U E R Y*****************************/
$(function () {



	// CARGANDO TODOS LOS COMBOS
	$.getJSON("ObtenerDelegacion", function (datos) {				            
		$.each(datos, function(i, item) {
			$.each( item,function(cNombreCampo,item){
				//console.log(cNombreCampo); // nombre del campo
				$("#cboDelegaciones").append("<option value=" + cNombreCampo + ">" + cNombreCampo + "</option>");
			})							    
		});				            
    }); // FIN DEL getJson


    $.getJSON("ObtenerPersonaFisica", function (datos) {				            
		$.each(datos, function(i, item) {
			$.each( item,function(cNombreCampo,item){
				//console.log(cNombreCampo); // nombre del campo
				$("#cboPersonaFisica").append("<option value=" + cNombreCampo + ">" + cNombreCampo + "</option>");
			})							    
		});				            
    }); // FIN DEL getJson

    $.getJSON("ObtenerPersonaMoral", function (datos) {				            
		$.each(datos, function(i, item) {
			$.each( item,function(cNombreCampo,item){
				//console.log(cNombreCampo); // nombre del campo
				$("#cboPersonaMoral").append("<option value=" + cNombreCampo + ">" + cNombreCampo + "</option>");
			})							    
		});				            
    }); // FIN DEL getJson

    $.getJSON("ObtenerRepresentante", function (datos) {				            
		$.each(datos, function(i, item) {
			$.each( item,function(cNombreCampo,item){
				//console.log(cNombreCampo); // nombre del campo
				$("#cboRepresentante").append("<option value=" + cNombreCampo + ">" + cNombreCampo + "</option>");
			})							    
		});				            
    }); // FIN DEL getJson

    $.getJSON("ObtenerPropiedad", function (datos) {				            
		$.each(datos, function(i, item) {
			$.each( item,function(cNombreCampo,item){
				//console.log(cNombreCampo); // nombre del campo
				$("#cboPropiedad").append("<option value=" + cNombreCampo + ">" + cNombreCampo + "</option>");
			})							    
		});				            
    }); // FIN DEL getJson

    $.getJSON("ObtenerProveedor", function (datos) {				            
		$.each(datos, function(i, item) {
			$.each( item,function(cNombreCampo,item){
				//console.log(cNombreCampo); // nombre del campo
				$("#cboProveedor").append("<option value=" + cNombreCampo + ">" + cNombreCampo + "</option>");
			})							    
		});				            
    }); // FIN DEL getJson

    $.getJSON("ObtenerUPP", function (datos) {				            
		$.each(datos, function(i, item) {
			$.each( item,function(cNombreCampo,item){
				//console.log(cNombreCampo); // nombre del campo
				$("#cboUPP").append("<option value=" + cNombreCampo + ">" + cNombreCampo + "</option>");
			})							    
		});				            
    }); // FIN DEL getJson

    /*
    $.getJSON("ObtenerSeguimiento", function (datos) {				            
		$.each(datos, function(i, item) {
			$.each( item,function(cNombreCampo,item){
				console.log(cNombreCampo); // nombre del campo
				$("#cboSeguimiento").append("<option value=" + cNombreCampo + ">" + cNombreCampo + "</option>");
			})							    
		});				            
    }); // FIN DEL getJson
    // FIN DE CARGAR LOS COMBOX
    */


	//var cargando = $("#ajax-loading");  // para el efecto del ajax
	var getUrl = window.location;
	var baseUrlCorta = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	var baseUrlCortaCorta = getUrl .protocol + "//" + getUrl.host + "/";


	// VARIABLES CAPTADAS DE la vista v_convenio
	var tipo_solicitante 	= $("#tipo_solicitante").val()
	var cesionado_usuario 	= $("#cesionado_usuario").val();
	var ano 				= $("#ano").val();
	var id_programa 		= $("#id_programa").val();
	var id_componente 		= $("#id_componente").val();
	var id_incentivo 		= $("#id_incentivo").val();

	BuscarConvenio( tipo_solicitante,cesionado_usuario,ano,id_programa,id_componente,id_incentivo);

	/**********************************************************************************/


	$(document).ajaxStart(function() {	  
	  $("#ajax-loading").show();	 
	});

	$(document).ajaxStop(function() {		
	  	$("#ajax-loading").hide();	    
	});

	/****************************************************************/
	$(".insertar-campo").click(function(){
		
		var boton = $(this).val();
		if (boton == 'delegacion') {
			var cpo = $("#cboDelegaciones").val();
		}
		if (boton == 'personafisica') {
			var cpo = $("#cboPersonaFisica").val();
		}
		if (boton == 'personamoral') {
			var cpo = $("#cboPersonaMoral").val();
		}
		if (boton == 'beneficiario') {
			var cpo = $("#cboBeneficiario").val();
		}
		if (boton == 'representante') {
			var cpo = $("#cboRepresentante").val();
		}
		if (boton == 'propiedad') {
			var cpo = $("#cboPropiedad").val();
		}
		if (boton == 'proveedor') {
			var cpo = $("#cboProveedor").val();
		}
		if (boton == 'upp') {
			var cpo = $("#cboUPP").val();
		}
		if (boton == 'apoyo') {
			var cpo = $("#cboApoyo").val();
		}
		if (boton == 'seguimiento') {
			var cpo = $("#cboSeguimiento").val();
		}
		if (boton == 'tablaconceptos') {
			var cpo = $("#cboTablaConceptos").val();
			var cpo = 'tablaconceptos'; // fijo			
		}
		

		
		if (cpo){
			//alert(cpo);
			cpo = '<strong>((' +cpo + '))</strong>';
			CKEDITOR.instances['editor1'].insertHtml(cpo);
		}
		


	}); // fin de clase insertar campo
	/*********************************************************************/
	
	
	

	//$("#divConvenio").hide();
	//$("#divGrabar").hide();
	//$("#divActualizar").hide();
	//$("#idDivNombreConvenio").hide();
	/*  SELECT */
	//$("#idDivDelegaciones").hide();
	//$("#idDivPersonaFisica").hide();
	//$("#idDivPersonaMoral").hide();
	//$("#idDivRepresentantes").hide();

	
	//$("#idDivBeneficiarios").hide();
	//$("#idDivProveedores").hide();
	//$("#idDivUPP").hide();
	
	//$("#idDivPropiedad").hide();
	//$("#idDivApoyo").hide();
	//$("#idDivSeguimiento").hide();
	//$("#idDivTablaConceptos").hide();
	


	//$("#idBtnBuscarConvenio").click(function(){
	function BuscarConvenio( tipo_solicitante,cesionado_usuario,ano,id_programa,id_componente,id_incentivo){
		//alert('Buscando el convenio ...!');		
		
		var cTipo 		= tipo_solicitante;
		var cCesionado	= cesionado_usuario;
		var cAno 		= ano;
		var cPrograma 	= id_programa;
		var cComponente = id_componente;
		var cIncentivo	= id_incentivo;		
		
		var cNombreConvenio = 's/n';	


		//alert(cCesionado);
				
		if  (!(cAno && cPrograma && cComponente && cTipo && cCesionado )) {
			alert('Error:Llenar la información Requerida');
			return;
		}

		var datos = { 'ano': cAno , 'programa':cPrograma , 'componente':cComponente , 'incentivo':cIncentivo, 'tipo' : cTipo, 'cesionado':cCesionado,'nombreconvenio':cNombreConvenio};
		//alert( baseUrlCorta+'/buscar_convenio');
			$.ajax({
					type: 'POST',
					url: baseUrlCorta+ "/buscar_convenio",
					data:datos,
					success: function(Resp_Ok){
						//console.log( Resp_Ok);
						//$("#idDivNombreConvenio").show();
						//$("#idDivNombreConvenio").html('Nombre del Convenio:[' + Resp_Ok['NOMBREPLANTILLA']+"]");
						//$("#txtNombreConvenio").val(Resp_Ok['NOMBREPLANTILLA']);
						//$("#divConvenio").show();
						// CARGANDO LA INFORMACION DE LOS CATALOGOS 

				        /*
				        $.getJSON("ObtenerBeneficiario", function (datos) {				            
        					$.each(datos, function(i, item) {
        						$.each( item,function(cNombreCampo,item){
        							console.log(cNombreCampo); // nombre del campo
        							$("#cboBeneficiario").append("<option value=" + cNombreCampo + ">" + cNombreCampo + "</option>");
        						})							    
							});				            
				        }); // FIN DEL getJson 			        

				        $.getJSON("ObtenerConcepto", function (datos) {				            
        					$.each(datos, function(i, item) {
        						$.each( item,function(cNombreCampo,item){
        							console.log(cNombreCampo); // nombre del campo
        							$("#cboApoyo").append("<option value=" + cNombreCampo + ">" + cNombreCampo + "</option>");
        						})							    
							});				            
				        }); // FIN DEL getJson 

				        */   

				        console.log( Resp_Ok);
				        //alert('esto es bueno');
						
						$("#divGrabar").show();
						$("#divActualizar").hide();
						
						if (Resp_Ok['ACCION'] == 'EDICION') {
							CKEDITOR.instances.editor1.setData(Resp_Ok['PLANTILLA']);
							$("#idNombreConvenio").val( Resp_Ok['NOMBREPLANTILLA']);
							console.log( Resp_Ok['NOMBREPLANTILLA']) ;
							//CKEDITOR.instances['editor1'].insertHtml(Resp_Ok['PLANTILLA']);
							//CKEDITOR.instances['editor1'].insertText('ESTA ES UNA PRUEBA DE INSERCION');
							//CKEDITOR.instances.editor1.insertHtml('<p>ESTA ES UNA PRUEBA DE INSERCION</p>');
							//CKEDITOR.instances.editor1.getData()
							$("#divGrabar").hide();
							$("#divActualizar").show();
						}else {
							CKEDITOR.instances.editor1.setData();
							$("#idNombreConvenio").val( '');
						}							
					}
				}) // FIN DEL AJAX---!		

	} //FIN DE LA FUNCION BuscarConvenio
	/***********************************************************/	

	/***********************************************************/
	
	 $(".btnGrabar").click(function(){
	 	cAccion = $(this).val();	 	
	 	
	 	var cAno 		= $("#ano").val();
		var cPrograma 	= $("#id_programa").val();
		var cComponente = $("#id_componente").val();
		var cIncentivo	= $("#id_incentivo").val();
		var cTipo 		= $("#tipo_solicitante").val()
		var cCesionado	= $("#cesionado_usuario").val();		
		var cNombreConvenio = $("#idNombreConvenio").val();


		var cConvenio = CKEDITOR.instances.editor1.getData()

	 	if ( cConvenio == ''  ){
    		alert( 'No existe nada que grabar' );
    		return;
	 	}

	 	if ( cNombreConvenio == ''  ){
    		alert( 'Especifique un nombre al Convenio' );
    		return;
	 	}


	 	
 		if (confirm('Seguro de '+cAccion+' Información')){
 			var datos = { 'ano': cAno , 'programa':cPrograma , 'componente':cComponente , 'incentivo':cIncentivo, 'tipo' : cTipo, 'cesionado':cCesionado,'convenio':cConvenio,'nombreconvenio':cNombreConvenio,'accion':cAccion};
			$.ajax({
				type: 'POST',
				url: baseUrlCorta+ "/grabar_convenio",
				data:datos,
				success: function(Resp_Ok){
					console.log( Resp_Ok);
					alert(cAccion + ' Termino Correctamente (reload)');
					//$(".btnGrabar").hide();
					location.reload();

				} // fin del sucess
			}); // fin del ajax
 		}
	 	
	 })
	
	 

}); 
