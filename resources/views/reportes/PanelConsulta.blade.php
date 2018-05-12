@extends('operativo.layouts.backend')
    @section('content')

    <div class="container-fluid">
        <div class="animated fadeIn"> 
            <div class="card">
                <div class="card-header text-center">
                    <strong>Reportes y Estadísticas</strong>
                </div>
                <div class="card-body">
                    <!-- Metodo VUEJS/ assets/Operativo/AdministracionRuta-->
                    <div id="app">
						<panel></panel>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection