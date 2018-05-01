$(function() {

	var i = 0;

		$('#agregar1').click(function() {

			if(i < 3){
				 i = i + 1;

				$('#prueba:last').append('<div class="col col-md-4  col-lg-3"><label for="exampleFormControlSelect1" class="h">Desde:</label><div class="form-group"><select data-placeholder="Ciudad-Aeropuerto" id="seleccionar" class="" tabindex="2"><option value="#">Cuidad o aeropuerto</option>@foreach ($sucursales as $sucursal)<option value="{{ $sucursal->id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>@endforeach</select><i class="fa fa-map-marker prefix icociudad2"></i><i class="fa fa-plane prefix inputwithicon4" aria-hidden="true"></i></div></div> '
				   );

				$("#seleccionar").attr("class", "chosen-select");
			}
		});


		 $("#borrar1").click(function() {

		 	if (i != 0) { 
		 		i = i - 1; 
	     		$("#destroy").remove();
	         }

	         else if(i == 0){
	     			i = 0;
	     		}
			
	     });

});
	

	