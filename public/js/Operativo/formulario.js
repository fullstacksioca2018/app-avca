

function FunctionVuelo(id){
   
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