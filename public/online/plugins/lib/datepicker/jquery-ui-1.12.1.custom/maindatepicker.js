jQuery(function($){
$.datepicker.setDefaults( $.datepicker.regional[ "es" ] );
$( "#soloida" ).datepicker({
minDate:1,
maxDate:"+3M",
firstDay:0,
showAnim:'slideDown',
//showButtonPanel:true,
//closeText:"Cerrar",
constrainInput: true,
defaulDate: 2,
});

});

