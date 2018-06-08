@extends ('rrhh.layouts.backend')

@section('breadcrumb')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Sección del empleado</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Inicio</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info-gradient">Empleado {{ $section }}</div>
            <div class="card-body">
                <hr>
                <div class="row mt-3">
                    <div class="col-12">
                        {{-- Datos del empleado --}}
                        @include('rrhh.backend.empleado.datos.datos-empleado', ['empleado' => $empleado])

                        {{--<datos-empleado :ruta="ruta" :empleado="empleado" />--}}
                    </div>
                </div>
                <div class="row py-5">
                    {{-- Acciones del empleado --}}
                    <div class="col-md-10 offset-md-1 text-center">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                @if (isset($section) ? $section : $section = 0) @endif
                                <a class="{{ $section == 0 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', 0) }}">
                                    <i class="fa fa-user"></i> Datos personales
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="{{ $section == 1 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', 1) }}">
                                    <i class="fa fa-vcard"></i> Voucher de pago
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="{{ $section == 2 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', 2) }}">
                                    <i class="fa fa-users"></i> Carga familiar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="{{ $section == 3 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', 3) }}">
                                    <i class="fa fa-file-text"></i> Constancia de trabajo
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-12 py-5">

                        @if ($section == 0)
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    @include('rrhh.backend.empleado.datos.datos-personales', ['empleado' => $empleado])
                                </div>
                            </div>
                        @endif
                        @if($section == 1)
                            <div class="row">
                                @include('rrhh.backend.empleado.datos.voucher-pago', ['empleado' => $empleado])
                            </div>
                        @endif
                        @if($section == 2)
                            <div class="row">
                                @include('rrhh.backend.empleado.datos.carga-familiar', ['empleado' => $empleado])
                            </div>
                        @endif
                        @if($section == 3)
                            <div class="row">
                                @include('rrhh.backend.empleado.datos.constancia-trabajo', ['empleado' => $empleado])
                            </div>
                        @endif
                        {{--<template v-if="menu == 2">
                            --}}{{--<carga-familiar :empleado="empleado"></carga-familiar>--}}{{--
                        </template>
                        <template v-if="menu == 3">
                            --}}{{--<expediente-laboral :empleado="empleado" :ruta="ruta"></expediente-laboral>--}}{{--
                        </template>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
