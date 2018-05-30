
$(function () {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
});


$(document).ready(function () {
	$('#idayvuelta').addClass('oculta');
	$('#multidestino').addClass('oculta');
	$('#btsoloida').addClass('active');
	$('#vuelo3').hide();
	$('#vuelo4').hide();
	var cont = 2;

	$('#btsoloida').click(function () {
		if (!$('#btsoloida').hasClass('active')) {
			$('#btsoloida').addClass('active');

			$('#btidayvuelta').removeClass('active');
			$('#btmultidestino').removeClass('active');
			$('#idayvuelta').addClass('oculta');
			$('#multidestino').addClass('oculta');

			$('#soloida').removeClass('oculta');
			$("#resultados_vuelo_1").html('');
			$("#resultados_vuelo_2").html('');
			$("#resultados_vuelo_3").html('');
			$("#resultados_vuelo_4").html('');

		}
	});
	$('#btidayvuelta').click(function () {
		if (!$('#btidayvuelta').hasClass('active')) {
			$('#btidayvuelta').addClass('active');

			$('#btsoloida').removeClass('active');
			$('#btmultidestino').removeClass('active');
			$('#soloida').addClass('oculta');
			$('#multidestino').addClass('oculta');

			$('#idayvuelta').removeClass('oculta');
			$("#resultados_vuelo_1").html('');
			$("#resultados_vuelo_2").html('');
			$("#resultados_vuelo_3").html('');
			$("#resultados_vuelo_4").html('');

		}
	});
	$('#btmultidestino').click(function () {
		if (!$('#btmultidestino').hasClass('active')) {
			$('#btmultidestino').addClass('active');

			$('#btsoloida').removeClass('active');
			$('#btidayvuelta').removeClass('active');
			$('#soloida').addClass('oculta');
			$('#idayvuelta').addClass('oculta');

			$('#multidestino').removeClass('oculta');
			$("#resultados_vuelo_1").html('');
			$("#resultados_vuelo_2").html('');
			$("#resultados_vuelo_3").html('');
			$("#resultados_vuelo_4").html('');

		}
	});
	//validar botones form.
	$("#FormIda").change(function(){
		
		if($("#vuelo_soloida").val()!="0" ){
			$("#btnIda").removeAttr('disabled');
		}
	});
	$("#FormIdayVuelta").change(function(){
		
		if(($("#vuelo_ida").val()!="0" )&&($("#vuelo_regreso").val()!="0" )){
			$("#btnIdayVuelta").removeAttr('disabled');
		}
	});

	$("#FormMultidestino").change(function(){
		
		if(($("#vuelo_1").val()!="0" )&&($("#vuelo_2").val()!="0" )){
			$("#btnMultidestino").removeAttr('disabled');
		}
	});


	//fecha de regreso para Ida y Vuelta
	$("#fecha_salida2").change(function () {
		$("#fecha_regreso").attr({
			min: $("#fecha_salida2").val(),
			value: $("#fecha_salida2").val()
		});
		//AJAX
		var origen=$("#origen_id_retorno").val();
		var destino=$("#destino_id_retorno").val();
		var fecha=$("#fecha_salida2").val();
		var tipo=1;
    CargarAjax(origen,destino,fecha,tipo,"regreso");
	});

	//------MULTIDESTINOOO-----------

	//validar fechas de multidestino	
	$("#salida1").change(function () {
		$("#salida2").attr({
			min: $("#salida1").val(),
			value: $("#salida1").val()
		});
		//AJAX
	var origen=$("#origen_id1").val();
	var destino=$("#destino_id1").val();
	var fecha=$("#salida1").val();
	var tipo=1;
	   CargarAjax(origen,destino,fecha,tipo,"segmento1");
  });

   //fecha salida solo ida
   $("#fecha_salida").change(function () {
	//AJAX
		var origen=$("#origen_id").val();
		var destino=$("#destino_id").val();
		var fecha=$("#fecha_salida").val();
		var tipo=1;
   CargarAjax(origen,destino,fecha,tipo,"soloida");
});

  

  //fecha regreso idayvuelta
  $("#fecha_regreso").change(function () {
	//AJAX
		var origen=$("#destino_id_retorno").val();
		var destino=$("#origen_id_retorno").val();
		var fecha=$("#fecha_regreso").val();
		var tipo=2;
   CargarAjax(origen,destino,fecha,tipo,"regreso");
});

	$("#salida2").change(function () {
		$("#salida3").attr({
			min: $("#salida2").val(),
			value: $("#salida2").val()
		});
			//AJAX
		var origen=$("#origen_id2").val();
		var destino=$("#destino_id2").val();
		var fecha=$("#salida2").val();
		var tipo=2;
		CargarAjax(origen,destino,fecha,tipo,"segmento2");
	});
	$("#salida3").change(function () {
		$("#salida4").attr({
			min: $("#salida3").val(),
			value: $("#salida3").val()
		});
			//AJAX
		var origen=$("#origen_id3").val();
		var destino=$("#destino_id3").val();
		var fecha=$("#salida3").val();
		var tipo=3;
		CargarAjax(origen,destino,fecha,tipo,"segmento3");
	});

	$("#salida4").change(function () {
		//AJAX
		var origen=$("#origen_id4").val();
		var destino=$("#destino_id4").val();
		var fecha=$("#salida4").val();
		var tipo=4;
		CargarAjax(origen,destino,fecha,tipo,"segmento4");
	});

	//validar destino con siguiente origen

	$("#destino_id1").change(function () {
		var idd = $("#destino_id1").val();
		$("#origen_id2 option[value=" + idd + "]").attr("selected", true);
		$("#origen_id2").trigger("chosen:updated");

		//AJAX
	var origen=$("#origen_id1").val();
	var destino=$("#destino_id1").val();
	var fecha=$("#salida1").val();
	var tipo=1;
	CargarAjax(origen,destino,fecha,tipo,"segmento1");

	});

	//solo ida
	$("#destino_id").change(function () {
		//AJAX
	var origen=$("#origen_id").val();
	var destino=$("#destino_id").val();
	var fecha=$("#fecha_salida").val();
	var tipo=1;
	CargarAjax(origen,destino,fecha,tipo,"soloida");

	});
 	//ida y vuelta
	$("#destino_id_retorno").change(function () {
		//AJAX
	var origen=$("#origen_id_retorno").val();
	var destino=$("#destino_id_retorno").val();
	var fecha=$("#fecha_salida2").val();
	var tipo=1;
	CargarAjax(origen,destino,fecha,tipo,"regreso");

	});


	$("#destino_id2").change(function () {
		var idd = $("#destino_id2").val();
		$("#origen_id3 option[value=" + idd + "]").attr("selected", true);
		$("#origen_id3").trigger("chosen:updated");

				//AJAX
			var origen=$("#origen_id2").val();
			var destino=$("#destino_id2").val();
			var fecha=$("#salida2").val();
			var tipo=2;
			CargarAjax(origen,destino,fecha,tipo,"segmento2");
	});


	$("#destino_id3").change(function () {
		var idd = $("#destino_id3").val();
		$("#origen_id4 option[value=" + idd + "]").attr("selected", true);
		$("#origen_id4").trigger("chosen:updated");
			//AJAX
		var origen=$("#origen_id3").val();
		var destino=$("#destino_id3").val();
		var fecha=$("#salida3").val();
		var tipo=3;
		CargarAjax(origen,destino,fecha,tipo,"segmento3");
	});

	$("#destino_id4").change(function () {
			//AJAX
		var origen=$("#origen_id4").val();
		var destino=$("#destino_id4").val();
		var fecha=$("#salida4").val();
		var tipo=4;
		CargarAjax(origen,destino,fecha,tipo,"segmento4");

	});

	$("#origen_id1").change(function () {
		
			//AJAX
		var origen=$("#origen_id1").val();
		var destino=$("#destino_id1").val();
		var fecha=$("#salida1").val();
		var tipo=1;
		CargarAjax(origen,destino,fecha,tipo,"segmento1");

	});
	//origen solo ida
	$("#origen_id").change(function () {
		
		//AJAX
	var origen=$("#origen_id").val();
	var destino=$("#destino_id").val();
	var fecha=$("#fecha_salida").val();
	var tipo=1;
	CargarAjax(origen,destino,fecha,tipo,"soloida");
	});

	//orgien ida y vuelta
	$("#origen_id_retorno").change(function () {
		//AJAX
	var origen=$("#origen_id_retorno").val();
	var destino=$("#destino_id_retorno").val();
	var fecha=$("#fecha_salida2").val();
	var tipo=1;
	CargarAjax(origen,destino,fecha,tipo,"regreso");
	});

	$("#origen_id2").change(function () {
			//AJAX
		var origen=$("#origen_id2").val();
		var destino=$("#destino_id2").val();
		var fecha=$("#salida2").val();
		var tipo=2;
		CargarAjax(origen,destino,fecha,tipo,"segmento2");
	});

	$("#origen_id3").change(function () {
			//AJAX
		var origen=$("#origen_id3").val();
		var destino=$("#destino_id3").val();
		var fecha=$("#salida3").val();
		var tipo=3;
		CargarAjax(origen,destino,fecha,tipo,"segmento3");
	});

	$("#origen_id4").change(function () {
			//AJAX
		var origen=$("#origen_id4").val();
		var destino=$("#destino_id4").val();
		var fecha=$("#salida4").val();
		var tipo=4;
		CargarAjax(origen,destino,fecha,tipo,"segmento4");
	});

	$("#masV").click(function () {
		if (cont < 4) {
			cont++;
			$("#cantidadV").val(cont);
			var idV = "#vuelo" + cont;
			$(idV).show().css('display', 'flex');
		}
		else {
			Vue.toasted.show('No se puede agregar mas destinos', {
				theme: "primary",
				position: "bottom-right",
				duration: 2000
			});
		}
	});

	$("#menosV").click(function () {
		if (cont > 2) {
			$("#cantidadV").val(cont);
			var idV = "#vuelo" + cont;
			$(idV).hide();
			cont--;
		}
		else {
			Vue.toasted.show('Para un solo segmento vaya a la seccion de Sola Ida', {
				theme: "primary",
				position: "bottom-right",
				duration: 2000
			});
		}
	});

	//vuelo solo dia
	$("#vuelo_soloida").change(function(){
		var text=$("#vuelo_soloida option:selected").text();
		var origen=$("#origen"+text).val();
		var destino=$("#destino"+text).val();
		var fecha=$("#fecha"+text).val();
		$("#fecha_salida").val(fecha);
		$("#origen_id option[value=" + origen + "]").attr("selected", true);
		$("#origen_id").trigger("chosen:updated");
		$("#destino_id option[value=" + destino + "]").attr("selected", true);
		$("#destino_id").trigger("chosen:updated");
		$("#tarifasoloida").val($("#precios1"+text).val());
	});

	// vuelo ida y vuelta parte 1
	$("#vuelo_ida").change(function(){
		var text=$("#vuelo_ida option:selected").text();
		var origen=$("#origen"+text).val();
		var destino=$("#destino"+text).val();
		var fecha=$("#fecha"+text).val();
		$("#fecha_salida2").val(fecha);
		$("#origen_id_retorno option[value=" + origen + "]").attr("selected", true);
		$("#origen_id_retorno").trigger("chosen:updated");
		$("#destino_id_retorno option[value=" + destino + "]").attr("selected", true);
		$("#destino_id_retorno").trigger("chosen:updated");
		$("#tarifaida").val($("#precios1"+text).val());
	});
    // vuelo ida y vuelta parte 2
	$("#vuelo_regreso").change(function(){
		var text=$("#vuelo_regreso option:selected").text();
		var fecha=$("#fecha"+text).val();
		$("#fecha_regreso").val(fecha);
		$("#tarifaregreso").val($("#precios2"+text).val());
	});

	//multidestino 1
	$("#vuelo_1").change(function(){
		
		var text=$("#vuelo_1 option:selected").text();
		var origen=$("#origen"+text).val();
		var destino=$("#destino"+text).val();
		var fecha=$("#fecha"+text).val();
		$("#salida1").val(fecha);
		$("#origen_id1 option[value=" + origen + "]").attr("selected", true);
		$("#origen_id1").trigger("chosen:updated");
		$("#destino_id1 option[value=" + destino + "]").attr("selected", true);
		$("#destino_id1").trigger("chosen:updated");
		$("#tarifamultidestino1").val($("#precios1"+text).val());
	});

	//multidestino 2
	$("#vuelo_2").change(function(){
		var text=$("#vuelo_2 option:selected").text();
		var origen=$("#origen"+text).val();
		var destino=$("#destino"+text).val();
		var fecha=$("#fecha"+text).val();
		$("#salida2").val(fecha);
		$("#origen_id2 option[value=" + origen + "]").attr("selected", true);
		$("#origen_id2").trigger("chosen:updated");
		$("#destino_id2 option[value=" + destino + "]").attr("selected", true);
		$("#destino_id2").trigger("chosen:updated");
		$("#tarifamultidestino2").val($("#precios2"+text).val());
	});

	//multidestino 3
	$("#vuelo_3").change(function(){
		var text=$("#vuelo_3 option:selected").text();
		var origen=$("#origen"+text).val();
		var destino=$("#destino"+text).val();
		var fecha=$("#fecha"+text).val();
		$("#salida3").val(fecha);
		$("#origen_id3 option[value=" + origen + "]").attr("selected", true);
		$("#origen_id3").trigger("chosen:updated");
		$("#destino_id3 option[value=" + destino + "]").attr("selected", true);
		$("#destino_id3").trigger("chosen:updated");
		$("#tarifamultidestino3").val($("#precios3"+text).val());
	});

	//multidestino 4
	$("#vuelo_4").change(function(){
		var text=$("#vuelo_4 option:selected").text();
		var origen=$("#origen"+text).val();
		var destino=$("#destino"+text).val();
		var fecha=$("#fecha"+text).val();
		$("#salida4").val(fecha);
		$("#origen_id4 option[value=" + origen + "]").attr("selected", true);
		$("#origen_id4").trigger("chosen:updated");
		$("#destino_id4 option[value=" + destino + "]").attr("selected", true);
		$("#destino_id4").trigger("chosen:updated");
		$("#tarifamultidestino4").val($("#precios4"+text).val());
	});
 
});

function CargarAjax (origen,destino,fecha,tipo,algo)
{
	$.ajax({  
		url:'taquilla/DetalleVuelo2',
		data:{"origen":origen,"destino":destino,"fecha":fecha},
		type:'get',
		dataType: 'json',
		success: function (response){
			mostrar_resultados(response,tipo,algo);
		}
	 }).fail( function( jqXHR, textStatus, errorThrown ) {
		Vue.toasted.show('Conexion Perdida con el servidor '+jqXHR.status, {
			theme: "primary",
			position: "bottom-right",
			duration: 2000
		});
	}); 
}

function mostrar_resultados(response,tipo,algo){
	Vue.toasted.show("Datos Cargados", {
		theme: "primary",
		position: "bottom-right",
		duration: 2000
	});
	$("#vuelo_soloida").empty();
	$("#vuelo_soloida").append("<option value='0'> Ningun Vuelo seleccionado </option>");
	
	if((algo=="regreso")&&(tipo==1)){
		$("#vuelo_ida").empty();
		$("#vuelo_ida").append("<option value='0'> Ningun Vuelo seleccionado </option>");
	}else{
		$("#vuelo_regreso").empty();
		$("#vuelo_regreso").append("<option value='0'> Ningun Vuelo seleccionado </option>");
	}

	if(algo=="segmento1"){
			$("#vuelo_1").empty();
			$("#vuelo_1").append("<option value='0'> Ningun Vuelo seleccionado </option>");
	}else{
		if(algo=="segmento2"){
			$("#vuelo_2").empty();
			$("#vuelo_2").append("<option value='0'> Ningun Vuelo seleccionado </option>");
		}else{
			if(algo=="segmento3"){
			$("#vuelo_3").empty();
			$("#vuelo_3").append("<option value='0'> Ningun Vuelo seleccionado </option>");
			}else{
				$("#vuelo_4").empty();
				$("#vuelo_4").append("<option value='0'> Ningun Vuelo seleccionado </option>");
			}
		}
    }
	if(response != "No hay Vuelos disponibles."){
		var html='';
		html+="<div class='form-group text-center'>";	
		html+="<table class='table table-hover table-striped text-center'>"
		
		for (var i=0; i<response.length;i++)
			{
				if(response[i].estado=="abierto")
				{
					
					html+="<tr >";
					html+="<th>Vuelo: </th>";
					html+="<th>"+response[i].n_vuelo+"</th>";
					var resul=parseInt(response[i].boletos)-parseInt(response[i].boletos_vendidos)-parseInt(response[i].boletos_reservados);
					html+="<th>Boletos: "+resul+"</th>";
					html+="<th>"+response[i].tarifa+" BsS <input type='hidden' id='precios"+tipo+response[i].n_vuelo+"' name='precios"+tipo+response[i].n_vuelo+"' value='"+response[i].tarifa+"'></th>";
					html+="</tr>";
					html+="<tr >";
					html+="<th>"+response[i].segmentos[0].origen.sigla+"<input type='hidden' id='origen"+response[i].n_vuelo+"' value='"+response[i].segmentos[0].origen.sucursal_id+"'> </th>";
					html+="<th>"+response[i].segmentos[0].destino.sigla+"<input type='hidden' id='destino"+response[i].n_vuelo+"' value='"+response[i].segmentos[0].destino.sucursal_id+"'></th>";
					var elementos = response[i].fecha.split(' ');
					
					html+="<th>"+elementos[0]+"<input type='hidden' id='fecha"+response[i].n_vuelo+"' value='"+elementos[0]+"'> </th>";
					html+="<th>"+elementos[1]+"</th>";
					html+="</tr>";
					  
					switch (algo){
						case "soloida":
								$("#vuelo_soloida").append("<option value='"+response[i].id+"'>"+response[i].n_vuelo+"</option>");
						    
							break;
						case "regreso":
		  
							if(tipo==1){
							  $("#vuelo_ida").append("<option value='"+response[i].id+"'>"+response[i].n_vuelo+"</option>");}
							  else{$("#vuelo_regreso").append("<option value='"+response[i].id+"'>"+response[i].n_vuelo+"</option>");}
							break;
						case "segmento"+tipo:
						$("#vuelo_"+tipo).append("<option value='"+response[i].id+"'>"+response[i].n_vuelo+"</option>");
						     
					}
				}//fin if vuelos disponibles
			}//fin for
		 html+="</table></div></div><hr/>";
	    if(algo=="soloida"){
		 $("#resultados_vuelo_"+tipo).html(html);
		 $("#vuelo_soloida").focus();
		}
		else{
			if(algo=="regreso"){
				if(tipo==1){
					$("#resultados_vuelo_"+tipo).html("<div class='form-group'>Ida: </div>"+html);$("#vuelo_ida").focus(); }
				else{
					$("#resultados_vuelo_"+tipo).html("<div class='form-group'>Retorno: </div>"+html);$("#vuelo_regreso").focus();
				}
		  }else
		  {
			$("#resultados_vuelo_"+tipo).html("<div class='form-group'>Segmento: "+tipo+" </div>"+html);$("#vuelo_"+tipo).focus();
		  }
		}	
	}else{
		if(algo=="soloida"){
			$("#resultados_vuelo_"+tipo).html(response);
			$("#vuelo_soloida").append("<option value='0'> Ningun Vuelo seleccionado </option>");
		   }
		   else{
			   if(algo=="regreso"){
				   if(tipo==1)
				   {  
					$("#vuelo_ida").append("<option value='0'> Ningun Vuelo seleccionado </option>");
					$("#resultados_vuelo_"+tipo).html("<div class='form-group'>Ida: </div>"+response);}
				else{$("#resultados_vuelo_"+tipo).html("<div class='form-group'>Regreso: </div>"+response);
				$("#vuelo_regreso").append("<option value='0'> Ningun Vuelo seleccionado </option>");
				}
			 }else
			 {
			   $("#resultados_vuelo_"+tipo).html("<div class='form-group'>Segemento: "+tipo+" </div>"+response);
			   $("#vuelo_"+tipo).append("<option value='0'> Ningun Vuelo seleccionado </option>");
			 }
		   }//fin else
	}//fin else
}