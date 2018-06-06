function BuscarCedula(i){
        $.ajax({  
            url:'taquilla/BuscarCedula',
            data:{'cedula':$("#Buscarci"+i).val()},
            type:'get',
            dataType: 'json',
            success: function (response){
                if(response=="Cedula No registrada"){
                    Vue.toasted.show(response, {
                        theme: "primary",
                        position: "bottom-right",
                        duration: 2000  
                    });
                $("#firstName"+i).focus();// colocar el foco a nombre 
                $("#documento"+i).val($("#Buscarci"+i).val());
                    }else{ //fin if cedula no registrada
                        Vue.toasted.show('Cargando datos....', {
                            theme: "primary",
                            position: "bottom-right",
                            duration: 2000 
                        });
                        $("#firstName"+i).val(response[0].primerNombre);
                        $("#segundoName"+i).val(response[0].segundoNombre);
                        $("#lastName"+i).val(response[0].apellido);
                        $("#tipo_documento"+i).val(response[0].tipo_documento);
                        $("#documento"+i).val(response[0].documento);
                        $("#fecha_nacimiento"+i).val(response[0].fecha_nacimiento);
                        $("#genero"+i).val(response[0].genero);
                    }//fin else 
            }
         }).fail( function( jqXHR, textStatus, errorThrown ) {
             Vue.toasted.show('---Conexion Perdida con el servidor---', {
                theme: "primary",
                position: "bottom-right",
                duration: 2000 
            });
        }); //fin ajax 
}//fin function