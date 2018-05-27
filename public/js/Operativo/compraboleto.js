 $(document).ready(function () {
    $("#btnbuscar").click(function(){
        alert("entro con el click"+$("#Buscarci").val());
        $.ajax({  
            url:'taquilla/BuscarCedula',
            data:{'cedula':'hola'},
            type:'post',
            dataType: 'json',
            success: function (response){
                Vue.toasted.show('Conexion Exitosa'+response, {
                    theme: "primary",
                    position: "bottom-right",
                    duration: 2000
                });
            }
         }).fail( function( jqXHR, textStatus, errorThrown ) {
            alert(errorThrown);
             Vue.toasted.show(textStatus+'---Conexion Perdida con el servidor---'+jqXHR.status, {
                theme: "primary",
                position: "bottom-right",
                duration: 2000 
            });

        }); //fin ajax 
    });//final buscarci
 
}); //final document ready 