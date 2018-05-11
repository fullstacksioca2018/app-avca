function validarN(event,tipo){
	//alert("entro al validar n con "+event+tipo);
	var adultos=parseInt(document.getElementById('inputadultos'+tipo).value);
	var ninos=parseInt(document.getElementById('inputninos'+tipo).value);
	if((adultos+ninos)>6){
		alert("solo pueden ser 6 personas");
		document.getElementById(event+tipo).value=document.getElementById(event+tipo).value-1;
		var result=document.getElementById(event+tipo).value;
	
	}
	
	if((event+tipo)==('inputninos'+tipo))
		{ console.log("entro a event == inputninos"); insertarInput(tipo);}	
			
}

function insertarInput(tipo){
	document.getElementById('contenedorPersonas'+tipo).innerHTML='';
	var ninos=parseInt(document.getElementById('inputninos'+tipo).value);
	 var elemento='<div class="form-check form-check-inline pt-1 pb-1"><label class="form-check-label " for="inlineRadio1">Los niños mayores de 2 años deben ir sentados.</label></div><div class="form-row">';

	for (var i = 0; i < ninos; i++) {
		elemento=elemento+'<div id="auxedad"><div class="col col-md-12 col-lg-12"><div class="form-group"><label for="exampleFormControlSelect1" class="h"> 	Niño(a): ' +(i+1)+'</label><select class="form-control" name="edad'+i+'" id="" onchange="brazosOpc('+i+')"><option value="#">Edad</option><option value="0">menos de 1</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option></select></div></div><div id="opcninos'+i+'"></div></div><br>';
 	}
 	elemento=elemento+"</div>";
	 $("#contenedorPersonas"+tipo).append(elemento);
}

function brazosOpc(ind){
	var ninos=parseInt(document.getElementById('inputninos'+tipo).value);
	var name='edad'+ind;
	var id="#opcninos"+ind;
	if(parseInt(document.getElementsByName(name)[0].value)<=1){
	var elemento='<div class="form-check form-check-inline ml-3"><input class="form-check-input" type="radio" name="brazo'+ind+'" id="inlineRadio1" value="En brazo" checked><label class="form-check-label " for="inlineRadio1">En brazo</label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="brazo'+ind+'" id="inlineRadio2" value="En asiento"><label class="form-check-label " for="inlineRadio2">En asiento</label></div>';
	 $(id).append(elemento);
	}
	else{
	 $(id).html('');
	}
}