
  $(function() {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
  });


$(document).ready(function(){
 $('#idayvuelta').addClass('oculta');
 $('#multidestino').addClass('oculta');
 $('#vuelo3').hide();
 $('#vuelo4').hide();
 var cont=2;

 $('#btsoloida').click(function(){
  if(!$('#btsoloida').hasClass('active')){
	$('#btsoloida').addClass('active');
   
	$('#btidayvuelta').removeClass('active');
	$('#btmultidestino').removeClass('active');
	$('#idayvuelta').addClass('oculta');
	$('#multidestino').addClass('oculta');

	 $('#soloida').removeClass('oculta');
   
  }
});
 $('#btidayvuelta').click(function(){
  if(!$('#btidayvuelta').hasClass('active')){
	$('#btidayvuelta').addClass('active');
   
	$('#btsoloida').removeClass('active');
	$('#btmultidestino').removeClass('active');
	$('#soloida').addClass('oculta');
	$('#multidestino').addClass('oculta');

	 $('#idayvuelta').removeClass('oculta');
   
  }
});
  $('#btmultidestino').click(function(){
  if(!$('#btmultidestino').hasClass('active')){
	$('#btmultidestino').addClass('active');
   
	$('#btsoloida').removeClass('active');
	$('#btidayvuelta').removeClass('active');
	$('#soloida').addClass('oculta');
	$('#idayvuelta').addClass('oculta');

	 $('#multidestino').removeClass('oculta');
   
  }
});
//fecha de regreso para Ida y Vuelta
$("#fecha_salida2").change(function(){
	$("#fecha_regreso").attr({
	min: $("#fecha_salida2").val(),
	value: $("#fecha_salida2").val()
	})
});

//------MULTIDESTINOOO-----------

//validar fechas de multidestino	
		$("#salida1").change(function(){
				$("#salida2").attr({
				min: $("#salida1").val(),
				value: $("#salida1").val()
				});
								//AJAX
					var origen=$("#origen_id1").val();
					var destino=$("#destino_id1").val();
					var fecha=$("#salida1").val();
					var url="/DetalleVuelo2";
				
					$.getJSON( url,{"origen":origen,"destino":destino,"fecha":fecha}  )
						.done(function(response) {
									$("#resultados_vuelo_1").html(response);
								
						})
						.fail(function( jqXHR, textStatus, errorThrown ) {
							Vue.toasted.show('Ha ocurrido un Error', {
								theme: "primary", 
								position: "bottom-right",  
								duration : 2000
								});
					});
		});
			$("#salida2").change(function(){
				$("#salida3").attr({
				min: $("#salida2").val(),
				value: $("#salida2").val()
				});
						//AJAX
						var origen=$("#origen_id2").val();
						var destino=$("#destino_id2").val();
						var fecha=$("#salida2").val();
						var url="/DetalleVuelo2";
					
						$.getJSON( url,{"origen":origen,"destino":destino,"fecha":fecha}  )
							.done(function(response) {
									construirHTML(response);
							})
							.fail(function( jqXHR, textStatus, errorThrown ) {
								Vue.toasted.show('Ha ocurrido un Error', {
									theme: "primary", 
									position: "bottom-right",  
									duration : 2000
									});
						});
			});
			$("#salida3").change(function(){
				$("#salida4").attr({
				min: $("#salida3").val(),
				value: $("#salida3").val()
				});
						//AJAX
						var origen=$("#origen_id3").val();
						var destino=$("#destino_id3").val();
						var fecha=$("#salida3").val();
						var url="/DetalleVuelo2";
					
						$.getJSON( url,{"origen":origen,"destino":destino,"fecha":fecha}  )
							.done(function(response) {
									construirHTML(response);
							})
							.fail(function( jqXHR, textStatus, errorThrown ) {
								Vue.toasted.show('Ha ocurrido un Error', {
									theme: "primary", 
									position: "bottom-right",  
									duration : 2000
									});
						});
			});

			$("#salida4").change(function(){
						//AJAX
						var origen=$("#origen_id4").val();
						var destino=$("#destino_id4").val();
						var fecha=$("#salida4").val();
						var url="/DetalleVuelo2";
					
						$.getJSON( url,{"origen":origen,"destino":destino,"fecha":fecha}  )
							.done(function(response) {
									construirHTML(response);
							})
							.fail(function( jqXHR, textStatus, errorThrown ) {
								Vue.toasted.show('Ha ocurrido un Error', {
									theme: "primary", 
									position: "bottom-right",  
									duration : 2000
									});
						});
			});
 
//validar destino con siguiente origen

$("#destino_id1").change(function(){
	var idd= $("#destino_id1").val();
	$("#origen_id2 option[value="+idd+"]").attr("selected",true);
	$("#origen_id2").trigger("chosen:updated");

	//AJAX
	var origen=$("#origen_id1").val();
	var destino=$(this).val();
	var fecha=$("#salida1").val();
	var url="/DetalleVuelo2";

	$.getJSON( url,{"origen":origen,"destino":destino,"fecha":fecha}  )
    .done(function(response) {
			$("#resultados_vuelo_1").html(response);
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
			Vue.toasted.show('Ha ocurrido un Error', {
				theme: "primary", 
				position: "bottom-right",  
				duration : 2000
				});
		});

});




$("#destino_id2").change(function(){
	var idd= $("#destino_id2").val();
	$("#origen_id3 option[value="+idd+"]").attr("selected",true);
	$("#origen_id3").trigger("chosen:updated");
  
  	//AJAX
	var origen=$("#origen_id2").val();
	var fecha=$("#salida2").val();
	var destino=$(this).val();
	var url="/DetalleVuelo2";

	$.getJSON( url,{"origen":origen,"destino":destino,"fecha":fecha}  )
    .done(function(response) {
        construirHTML(response);
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
			Vue.toasted.show('Ha ocurrido un Error', {
				theme: "primary", 
				position: "bottom-right",  
				duration : 2000
				});
		});
});





$("#destino_id3").change(function(){
	var idd= $("#destino_id3").val();
	$("#origen_id4 option[value="+idd+"]").attr("selected",true);
	$("#origen_id4").trigger("chosen:updated");
		//AJAX
		var origen=$("#origen_id3").val();
		var fecha=$("#salida3").val();
		var destino=$(this).val();
		var url="/DetalleVuelo2";
	
		$.getJSON( url,{"origen":origen,"destino":destino,"fecha":fecha}  )
			.done(function(response) {
					construirHTML(response);
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
				Vue.toasted.show('Ha ocurrido un Error', {
					theme: "primary", 
					position: "bottom-right",  
					duration : 2000
					});
		});
});

$("#destino_id4").change(function(){
 //AJAX
 var origen=$("#origen_id4").val();
 var destino=$(this).val();
 var fecha=$("#salida4").val();
 var url="/DetalleVuelo2";

 $.getJSON( url,{"origen":origen,"destino":destino,"fecha":fecha}  )
	 .done(function(response) {
			 construirHTML(response);
	 })
	 .fail(function( jqXHR, textStatus, errorThrown ) {
		 Vue.toasted.show('Ha ocurrido un Error', {
			 theme: "primary", 
			 position: "bottom-right",  
			 duration : 2000
			 });
 });

});
//jhgjhg
$("#origen_id1").change(function(){
	Vue.toasted.show('Cargando...', {
		theme: "primary", 
		position: "bottom-right",  
		duration : 2000
		});
	//AJAX
	var origen=$("#origen_id1").val();
	var destino=$("#destino_id1").val();
	var fecha=$("#salida1").val();
	var url="/DetalleVuelo2";
 
	$.JSON( url,{"origen": origen,"destino":destino,"fecha":fecha}  )
		.done(function(response) {
			Vue.toasted.show('Entro al done de ajax...', {
				theme: "primary", 
				position: "bottom-right",  
				duration : 2000
				});
			$("#resultados_vuelo_1").html(response);
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			Vue.toasted.show('Ha ocurrido un Error', {
				theme: "primary", 
				position: "bottom-right",  
				duration : 2000
				});
	});
});

$("#origen_id2").change(function(){
	//AJAX
	var origen=$(this).val();
	var destino=$("#destino_id2").val();
	var fecha=$("#salida2").val();
	var url="/DetalleVuelo2";
 
	$.getJSON( url,{"origen":origen,"destino":destino,"fecha":fecha}  )
		.done(function(response) {
				construirHTML(response);
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			Vue.toasted.show('Ha ocurrido un Error', {
				theme: "primary", 
				position: "bottom-right",  
				duration : 2000
				});
	});
});

$("#origen_id3").change(function(){
	//AJAX
	var origen=$(this).val();
	var destino=$("#destino_id3").val();
	var fecha=$("#salida3").val();
	var url="/DetalleVuelo2";
 
	$.getJSON( url,{"origen":origen,"destino":destino,"fecha":fecha}  )
		.done(function(response) {
				construirHTML(response);
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			Vue.toasted.show('Ha ocurrido un Error', {
				theme: "primary", 
				position: "bottom-right",  
				duration : 2000
				});
	});
});

$("#origen_id4").change(function(){
	//AJAX
	var origen=$(this).val();
	var destino=$("#destino_id4").val();
	var fecha=$("#salida4").val();
	var url="/DetalleVuelo2";
 
	$.getJSON( url,{"origen": origen,"destino":destino,"fecha":fecha}  )
		.done(function(response) {
				construirHTML(response);
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			Vue.toasted.show('Ha ocurrido un Error', {
				theme: "primary", 
				position: "bottom-right",  
				duration : 2000
				});
	});
});


		
 $("#masV").click(function(){
	if(cont<4){
	  cont++;
	  $("#cantidadV").val(cont);
	  var idV="#vuelo"+cont;
	  $(idV).show().css('display', 'flex');
	}
	else{
		Vue.toasted.show('No se puede agregar mas destinos', {
			theme: "primary", 
			 position: "bottom-right",  
			   duration : 2000
		  });
	}
 }); 
  
 $("#menosV").click(function(){
	if(cont>2){
		$("#cantidadV").val(cont);
		var idV="#vuelo"+cont;
		$(idV).hide();
		cont--;
	  }
	  else{
		Vue.toasted.show('Para un solo segmento vaya a la seccion de Sola Ida', {
			theme: "primary", 
			 position: "bottom-right",  
			   duration : 2000
		  });
	}
 });

  
});

