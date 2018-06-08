@extends('operativo.layouts.backend')

@section('content')

   
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header text-center"><!-- TAQUILLA -->
                <strong>Registro de Vuelos Entrantes</strong>
            </div>
            <div class="card-body">
            <!-- Metodo VUEJS/ assets/Operativo/Llegada-->
                <Llegada> </Llegada>
            </div>
        </div>
    </div>
</div>

@stop
