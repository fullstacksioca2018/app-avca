 $(document).ready(function () {
    $("#btnbuscar").click(function(){
        $.ajax({  
            url:'taquilla/BuscarCedula',
            data:{'cedula':$("#Buscarci").val()},
            type:'get',
            dataType: 'json',
            success: function (response){
                Vue.toasted.show('Cedula Encontrada', {
                    theme: "primary",
                    position: "bottom-right",
                    duration: 2000 
                });
                if(response=="Cedula No registrada"){
                    Vue.toasted.show(response, {
                        theme: "primary",
                        position: "bottom-right",
                        duration: 2000  
                    });
                // $("#firstName").attr(autofocus); colocar el foco a nombre 

                    }else{ //fin if cedula no registrada
                        Vue.toasted.show('Cargando datos....', {
                            theme: "primary",
                            position: "bottom-right",
                            duration: 2000 
                        });
                        $("#firstName0").val(response[0].nombre);
                        $("#lastName0").val(response[0].apellido);
                        $("#tipo_documento0").val(response[0].tipo_documento);
                        $("#documento0").val(response[0].documento);
                        $("#fecha_nacimiento0").val(response[0].fecha_nacimiento);
                        $("#genero0").val(response[0].genero);
                        $("#user_id").val(response[0].id);
                    }//fin else 
            }
         }).fail( function( jqXHR, textStatus, errorThrown ) {
             Vue.toasted.show('---Conexion Perdida con el servidor---', {
                theme: "primary",
                position: "bottom-right",
                duration: 2000 
            });

        }); //fin ajax 
    });//final buscarci
 
}); //final document ready 