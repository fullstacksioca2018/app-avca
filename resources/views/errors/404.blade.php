@extends('rrhh.layouts.error')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/rrhh/fonts.css') }}">    
    <link rel="stylesheet" href="{{ asset('css/rrhh/error.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="mt-5">Error: 404 Página no encontrada</h2>
                <h1>
                    <span>4</span>
                    <img src="{{ asset('img/rrhh/ghost.png') }}" alt="Ghost">
                    <span>4</span>
                </h1>
                <p>
                    Lo sentimos, la página que está buscando no pudo ser accesada.
                </p>
                <p>
                    Revise la URL ó <a href="javascript:history.back()">Regrese</a>
                </p>
            </div>
        </div>
    </div>
@endsection