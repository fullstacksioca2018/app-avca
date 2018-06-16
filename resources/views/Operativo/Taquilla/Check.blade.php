@extends('operativo.layouts.backend')

@section('content')

   
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header text-center"><!-- TAQUILLA -->
                <strong>Check-in </strong>
            </div>
            <div class="card-body">
            <!-- Metodo VUEJS/ assets/Operativo/Check-->
                <Check> </Check>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="/js/jspdf.plugin.autotable.js"></script>
@endpush

@stop

