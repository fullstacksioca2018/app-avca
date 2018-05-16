@extends('reportes.backend')
    @section('content')
    <breadcrumbpersonal></breadcrumbpersonal>
    <div class="container-fluid">
            <dashboard user="{{ auth()->user()->role }}"></dashboard>
    </div>
    

@endsection