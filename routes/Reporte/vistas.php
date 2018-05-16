
<?php 

Route::group(['prefix' => 'reportes','middleware' => ['auth']],function(){

	Route::get('/', function () {
	    return view('reportes.Dashboard');
	});

	Route::get('/panel', function () {
	    return view('reportes.PanelConsulta');
	});
});




 ?>