@extends('operativo.layouts.app')
    @section('content')

    <div class="container-fluid">
        <div class="animated fadeIn"> 
            <div class="card">
                <div class="card-header text-center">
                    <strong>Administracion de Vuelos</strong>
                </div>
                <div class="card-body">
                    <!-- Metodo VUEJS/ assets/Operativo/AdministracionRuta-->
                    <div id="app">
                        <vuelos></vuelos>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="/js/app.js"></script>
                     
@endsection