@extends('operativo.layouts.backend')
    @section('content')
@php
dd(\Cache::get('datos'));return;
@endphp
    <div class="container-fluid">
        <div class="animated fadeIn"> 
            <div class="card">
                <div class="card-header text-center">
                    <strong>Administracion de Vuelos</strong>
                </div>
                <div class="card-body">
                    <!-- Metodo VUEJS/ assets/Operativo/AdministracionRuta-->
                  
                        <vuelos></vuelos>
                   
                </div>
            </div>
        </div>
    </div>


                     
@endsection