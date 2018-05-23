
$(function () {
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });
});


$(document).ready(function () {
	$('#idayvuelta').addClass('oculta');
	$('#multidestino').addClass('oculta');
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

		}
	});
	//fecha de regreso para Ida y Vuelta
	$("#fecha_salida2").change(function () {
		$("#fecha_regreso").attr({
			min: $("#fecha_salida2").val(),
			value: $("#fecha_salida2").val()
		})
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
	   $.ajax({  //transformar datos a json para enviarlos
		url:'taquilla/DetalleVuelo2',
		data:{"origen":origen,"destino":destino,"fecha":fecha},
		type:'get',
		dataType: 'json',
		success: function algo(response){
			
			var html='';
			html+="<strom>Vuelos Disponibles:</strom>";
			html+="<div class='form-group'>";	
			html+="<table class='text-center'>"
			html+="<tr >";
			html+="<th>Origen  </th>";
			html+="<th>Destino </th>";
			html+="<th>Fecha </th>";
			html+="<th>Hora </th>";
			html+="<th> - </th>";
			html+="</tr>";
			
			for (var i=0; i<response.length;i++)
				{
					if(response[i].estado=="abierto")
					{
						html+="<tr >";
						html+="<th>"+response[i].segmentos[0].origen+"</th>";
						html+="<th>"+response[i].segmentos[0].destino+"</th>";
						var elementos = response[i].fecha.split(' ');
						html+="<th>"+elementos[0]+"</th>";
						html+="<th>"+elementos[1]+"</th>";
						html+="<th> - </th>";
						html+="</tr>";
					}//fin if vuelos disponibles
				}//fin for
			 html+="</table></div></div>";
			$("#resultados_vuelo_1").html(html);	
		},
		statusCode: {
		   404: function() {
			  alert('web not found');
		   }
		}
	 }).fail( function( jqXHR, textStatus, errorThrown ) {
		alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
	}); 
	
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

		$.ajax({  //transformar datos a json para enviarlos
			url:'taquilla/DetalleVuelo2',
			data:{"origen":origen,"destino":destino,"fecha":fecha},
			type:'get',
			dataType: 'json',
			success: function (response) {
				$("#resultados_vuelo_2").html(response);
			},
			statusCode: {
			404: function() {
				alert('web not found');
			}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
			alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
		}); 
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
		
		$.ajax({  //transformar datos a json para enviarlos
			url:'taquilla/DetalleVuelo2',
			data:{"origen":origen,"destino":destino,"fecha":fecha},
			type:'get',
			dataType: 'json',
			success: function (response) {
				$("#resultados_vuelo_3").html(response);
			},
			statusCode: {
			404: function() {
				alert('web not found');
			}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
			alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
		}); 
	});

	$("#salida4").change(function () {
		//AJAX
		var origen=$("#origen_id4").val();
		var destino=$("#destino_id4").val();
		var fecha=$("#salida4").val();
		
		$.ajax({  //transformar datos a json para enviarlos
			url:'taquilla/DetalleVuelo2',
			data:{"origen":origen,"destino":destino,"fecha":fecha},
			type:'get',
			dataType: 'json',
			success: function (response) {
				$("#resultados_vuelo_4").html(response);
			},
			statusCode: {
			404: function() {
				alert('web not found');
			}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
			alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
		}); 
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

	   $.ajax({  //transformar datos a json para enviarlos
		url:'taquilla/DetalleVuelo2',
		data:{"origen":origen,"destino":destino,"fecha":fecha},
		type:'get',
		dataType: 'json',
		success: function (response) {
			$("#resultados_vuelo_1").html(response);
		},
		statusCode: {
		   404: function() {
			  alert('web not found');
		   }
		}
	 }).fail( function( jqXHR, textStatus, errorThrown ) {
		alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
	}); 

	});


	$("#destino_id2").change(function () {
		var idd = $("#destino_id2").val();
		$("#origen_id3 option[value=" + idd + "]").attr("selected", true);
		$("#origen_id3").trigger("chosen:updated");

				//AJAX
			var origen=$("#origen_id2").val();
			var destino=$("#destino_id2").val();
			var fecha=$("#salida2").val();

			$.ajax({  //transformar datos a json para enviarlos
				url:'taquilla/DetalleVuelo2',
				data:{"origen":origen,"destino":destino,"fecha":fecha},
				type:'get',
				dataType: 'json',
				success: function (response) {
					$("#resultados_vuelo_2").html(response);
				},
				statusCode: {
				404: function() {
					alert('web not found');
				}
				}
			}).fail( function( jqXHR, textStatus, errorThrown ) {
				alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
			}); 
	});


	$("#destino_id3").change(function () {
		var idd = $("#destino_id3").val();
		$("#origen_id4 option[value=" + idd + "]").attr("selected", true);
		$("#origen_id4").trigger("chosen:updated");
			//AJAX
		var origen=$("#origen_id3").val();
		var destino=$("#destino_id3").val();
		var fecha=$("#salida3").val();
		
		$.ajax({  //transformar datos a json para enviarlos
			url:'taquilla/DetalleVuelo2',
			data:{"origen":origen,"destino":destino,"fecha":fecha},
			type:'get',
			success: function (response) {
				$("#resultados_vuelo_3").html(response);
			},
			statusCode: {
			404: function() {
				alert('web not found');
			}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
			alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
		}); 
	});

	$("#destino_id4").change(function () {
			//AJAX
		var origen=$("#origen_id4").val();
		var destino=$("#destino_id4").val();
		var fecha=$("#salida4").val();
		
		$.ajax({  
			url:'taquilla/DetalleVuelo2',
			data:{"origen":origen,"destino":destino,"fecha":fecha},
			type:'get',
			dataType: 'json',
			success: function (response) {
				$("#resultados_vuelo_4").html(response);
			},
			statusCode: {
			404: function() {
				alert('web not found');
			}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
			alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
		}); 

	});

	$("#origen_id1").change(function () {
		
			//AJAX
		var origen=$("#origen_id1").val();
		var destino=$("#destino_id1").val();
		var fecha=$("#salida1").val();
			
		$.ajax({  //transformar datos a json para enviarlos
			url:'taquilla/DetalleVuelo2',
			data:{"origen":origen,"destino":destino,"fecha":fecha},
			type:'get',
			dataType: 'json',
			success: function (response) {
				var id=
				$("#resultados_vuelo_1").html(response.id);
			},
			statusCode: {
			404: function() {
				alert('web not found');
			}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
			alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
		}); 

	});

	$("#origen_id2").change(function () {
			//AJAX
		var origen=$("#origen_id2").val();
		var destino=$("#destino_id2").val();
		var fecha=$("#salida2").val();
		
		$.ajax({  
			url:'taquilla/DetalleVuelo2',
			data:{"origen":origen,"destino":destino,"fecha":fecha},
			type:'get',
			dataType: 'json',
			success: function (response) {
				$("#resultados_vuelo_2").html(response);
			},
			statusCode: {
			404: function() {
				alert('web not found');
			}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
			alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
		}); 
	});

	$("#origen_id3").change(function () {
			//AJAX
		var origen=$("#origen_id3").val();
		var destino=$("#destino_id3").val();
		var fecha=$("#salida3").val();
		
		$.ajax({  
			url:'taquilla/DetalleVuelo2',
			data:{"origen":origen,"destino":destino,"fecha":fecha},
			type:'get',
			dataType: 'json',
			success: function (response) {
				$("#resultados_vuelo_3").html(response);
			},
			statusCode: {
			404: function() {
				alert('web not found');
			}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
			alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
		}); 
	});

	$("#origen_id4").change(function () {
			//AJAX
		var origen=$("#origen_id4").val();
		var destino=$("#destino_id4").val();
		var fecha=$("#salida4").val();
		$.ajax({  
			url:'taquilla/DetalleVuelo2',
			data:{"origen":origen,"destino":destino,"fecha":fecha},
			type:'get',
			dataType: 'json',
			success: function (response) {
				Vue.toasted.show('Carga de Vuelos completa'+response, {
					theme: "primary",
					position: "bottom-right",
					duration: 2000
				});
				$.each(response, function(){
					$("#resultados_vuelo_4").html($("#resultados_vuelo_4").html()+this.goalone+"</br>");
				});
				
			},
			statusCode: {
			404: function() {
				alert('web not found');
			}
			}
		}).fail( function( jqXHR, textStatus, errorThrown ) {
			alert( 'Error!!'+jqXHR.status+" "+textStatus+" "+errorThrown );
		}); 
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


});

