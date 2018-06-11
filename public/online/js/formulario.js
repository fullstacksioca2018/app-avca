function myFunction(tipo){
	var adultos=parseInt(document.getElementById('inputadultos'+tipo).value);
	var ninos=parseInt(document.getElementById('inputninos'+tipo).value);
	var edades=[];
	var contBrz=0;
	for (var i = 0; i < ninos; i++) {
		var name='edad'+i;
		if(parseInt(document.getElementsByName(name)[0].value)<=1){
			var brz='brazo'+i;
			var radios=document.getElementsByName(brz);
			for (var j = 0; j < radios.length; j++) {
				if(radios[j].checked)
					if(radios[j].value=='En brazo')
						contBrz++;
			}
		}
	}
	
	sessionStorage.setItem("adultos", adultos);
	sessionStorage.setItem("ninos", ninos);
	sessionStorage.setItem("brazos", contBrz);
	document.getElementById('ninosbrazos'+tipo).value=contBrz;
	// sessionStorage.setItem("brazos", contBrz); ESTO ES PARA GUARDAR
	// sessionStorage.getItem('key'); ESTO ES PARA RECUPERAR
}

function FunctionVuelo(id){

    sessionStorage.setItem("vuelo", id);
}

function ComBoleto(){
	//alert(sessionStorage.getItem('ninos'));
	document.getElementById('nino').value = sessionStorage.getItem('ninos');
	document.getElementById('adulto').value = sessionStorage.getItem('adultos');
	document.getElementById('brazo').value = sessionStorage.getItem('brazos');
	document.getElementById('vuelo_id').value = sessionStorage.getItem('vuelo');
	return false; 
}

function BoletoReservado(){
	//alert(sessionStorage.getItem('ninos'));
	alert('estoy aqui');
	document.getElementById('ReservaNino').value = sessionStorage.getItem('ninos');
	document.getElementById('ReservaAdulto').value = sessionStorage.getItem('adultos');
	document.getElementById('ReservaBrazo').value = sessionStorage.getItem('brazos');
	document.getElementById('ReservaVuelo_id').value = sessionStorage.getItem('vuelo');
	return false; 
}