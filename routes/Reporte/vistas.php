
<?php 
Route::get('/reportes', function () {
    return view('reportes.Dashboard');
});

Route::get('/reportes/panel', function () {
    return view('reportes.PanelConsulta');
});


 ?>