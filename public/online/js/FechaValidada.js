$("#fecha_salida").change(function(){
        $("#fecha_regreso").attr({
          min: $("#fecha_salida").val(),
          value: $("#fecha_salida").val()
        })
 });