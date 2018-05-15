function myFunction(){
	alert("entro a my function");
	var adultos=parseInt(document.getElementById('inputadultos1').value);
	var ninos=parseInt(document.getElementById('inputninos1').value);
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
					    alert("Contador contBrz en la posicion"+j+"es: "+contBrz);
			}
		}
	}
	
	sessionStorage.setItem("adultos", adultos);
	sessionStorage.setItem("ninos", ninos);
	sessionStorage.setItem("brazos", contBrz);
	document.getElementById('ninosbrazos').value=contBrz;
	// sessionStorage.setItem("brazos", contBrz); ESTO ES PARA GUARDAR
	// sessionStorage.getItem('key'); ESTO ES PARA RECUPERAR
}

function FunctionVuelo(id){
      alert("entro en funcion vuelo");
    sessionStorage.setItem("vuelo", id);
}

function ComBoleto(){
	alert(sessionStorage.getItem('ninos'));
	document.getElementById('nino').value = sessionStorage.getItem('ninos');
	document.getElementById('adulto').value = sessionStorage.getItem('adultos');
	document.getElementById('brazo').value = sessionStorage.getItem('brazos');
	document.getElementById('vuelo_id').value = sessionStorage.getItem('vuelo');
	return false; 
}