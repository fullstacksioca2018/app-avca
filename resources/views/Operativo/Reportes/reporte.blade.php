@extends('operativo.layouts.backend')
    @section('content')

    <div class="container-fluid">
        <div class="animated fadeIn"> 
            <div class="card">
                <div class="card-header text-center">
                    <strong>Reporte de Boletos</strong>
                </div>
                <div class="card-body">
                    <!-- Metodo VUEJS/ assets/Operativo/AdministracionRuta-->
                        <reporteboletos> </reporteboletos>
                </div>
            </div>
        </div>
    </div>

@endsection
