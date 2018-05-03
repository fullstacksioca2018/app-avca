function myFunction(){

	var adultos=parseInt(document.getElementById('inputadultos').value);
	var ninos=parseInt(document.getElementById('inputninos').value);
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
	// sessionStorage.setItem("brazos", contBrz); ESTO ES PARA GUARDAR
	// sessionStorage.getItem('key'); ESTO ES PARA RECUPERAR
}

function FunctionVuelo(id){

    sessionStorage.setItem("vuelo", id);
}

function ComBoleto(){
	alert(sessionStorage.getItem('ninos'));
	document.getElementById('nino').value = sessionStorage.getItem('ninos');
	return false; 
}