@extends('rrhh.layouts.backend')

@section('content')
    @if(isset($empleado))
        {{--Ficha del empleado--}}
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info-gradient">Empleado</div>
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
                                    @if (isset($menu) ? $menu : $menu = 0) @endif
                                    <a class="{{ $menu == 0 ? 'nav-link active' : 'nav-link' }}" href="{{ route('empleado.accion', 0) }}">
                                        <i class="fa fa-user"></i> Datos personales
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="{{ $menu == 1 ? 'nav-link active' : 'nav-link' }}" href="{{ route('empleado.accion', 1) }}">
                                        <i class="fa fa-vcard"></i> Voucher de pago
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="{{ $menu == 2 ? 'nav-link active' : 'nav-link' }}" href="#">
                                        <i class="fa fa-users"></i> Carga familiar
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="{{ $menu == 3 ? 'nav-link active' : 'nav-link' }}" href="#">
                                        <i class="fa fa-file-text"></i> Expediente laboral
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-12 py-5">
                            @if ($menu == 0)
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        @include('rrhh.backend.empleado.datos.datos-personales', ['empleado' => $empleado])
                                    </div>
                                </div>
                            @endif
                            @if($menu == 1)
                                <div class="row">
                                    @include('rrhh.backend.empleado.datos.voucher-pago', ['empleado' => $empleado])
                                </div>
                            @endif
                            {{--<template v-if="menu == 2">
                                --}}{{--<carga-familiar :empleado="empleado"></carga-familiar>--}}{{--
                            </template>
                            <template v-if="menu == 3">
                                --}}{{--<expediente-laboral :empleado="empleado" :ruta="ruta"></expediente-laboral>--}}{{--
                            </template>--}}
                        </div>
                        {{--<div>
                            --}}{{--
                            <!-- Menu de acciones para el empleado -->
                            --}}{{--<acciones-empleado :ruta="ruta" :empleado="empleado" />--}}{{--
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('scripts')

@endpush