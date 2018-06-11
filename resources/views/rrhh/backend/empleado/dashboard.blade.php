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
                            @if (auth()->user()->isRole('empleado'))
                            <li class="nav-item">
                                @if (isset($section) ? $section : $section = 0) @endif
                                <a class="{{ $section == 0 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id, 'section' => 0]) }}">
                                    <i class="fa fa-user"></i> Datos personales
                                </a>
                            </li>
                            @endif
                            @if(auth()->user()->isRole('empleado') || auth()->user()->isRole('analista.nomina'))
                            <li class="nav-item">
                                <a class="{{ $section == 1 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id, 'section' => 1]) }}">
                                    <i class="fa fa-vcard"></i> Voucher de pago
                                </a>
                            </li>                            
                            <li class="nav-item">
                                <a class="{{ $section == 2 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id, 'section' => 2]) }}">
                                    <i class="fa fa-users"></i> Carga familiar
                                </a>
                            </li>
                            @endif
                            @if (auth()->user()->isRole('empleado'))
                            <li class="nav-item">
                                <a class="{{ $section == 3 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id, 'section' => 3]) }}">
                                    <i class="fa fa-file-text"></i> Constancia de trabajo
                                </a>
                            </li>
                            @endif

                            @if(auth()->user()->isRole('analista.area') || auth()->user()->isRole('gerente'))
                            <li class="nav-item">
                                @if (isset($section) ? $section : $section = 0) @endif
                                <a class="{{ $section == 0 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id, 'section' => 0]) }}">
                                    <i class="fa fa-user"></i> Datos personales
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="{{ $section == 1 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id, 'section' => 1]) }}">
                                    <i class="fa fa-money"></i> Conceptos laborales
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="{{ $section == 2 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id, 'section' => 2]) }}">
                                    <i class="fa fa-users"></i> Carga familiar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="{{ $section == 3 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id, 'section' => 3]) }}">
                                    <i class="fa fa-file-text"></i> Expediente laboral
                                </a>
                            </li>
                            @elseif(auth()->user()->isRole('gerente.sucursal'))
                            <li class="nav-item">
                                <a class="{{ $section == 0 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id, 'section' => 0]) }}">
                                    <i class="fa fa-cog"></i> Asignar grupo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="{{ $section == 1 ? 'nav-link active' : 'nav-link' }}" href="{{ route('dashboard.empleado', ['empleado' => $empleado->empleado_id, 'section' => 1]) }}">
                                    <i class="fa fa-file-text"></i> Expediente laboral
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>

                    <div class="col-12 py-5">

                        @if ($section == 0 && auth()->user()->isRole('empleado'))
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    @include('rrhh.backend.empleado.datos.datos-personales', ['empleado' => $empleado])
                                </div>
                            </div>
                        @elseif ($section == 0 && (auth()->user()->isRole('analista.area') || auth()->user()->isRole('gerente')))
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <datos-personales :empleado="{{ json_encode($empleado) }}" ruta=""></datos-personales>
                                </div>
                            </div>
                        @elseif($section == 0 && auth()->user()->isRole('gerente.sucursal'))
                            <asignar-grupo :empleado="{{ json_encode($empleado) }}"></asignar-grupo>
                        @endif
                        @if($section == 1 && (auth()->user()->isRole('empleado') || auth()->user()->isRole('analista.nomina')))
                            <div class="row">
                                @include('rrhh.backend.empleado.datos.voucher-pago', ['empleado' => $empleado])
                            </div>
                        @elseif($section == 1 && (auth()->user()->isRole('analista.area') || auth()->user()->isRole('gerente')))
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <ingresos-deducciones :empleado="{{ json_encode($empleado) }}"></ingresos-deducciones>
                                </div>
                            </div>
                        @elseif($section == 1 && auth()->user()->isRole('gerente.sucursal'))
                            <expediente-laboral :empleado="{{ json_encode($empleado) }}" ruta=""></expediente-laboral>
                        @endif
                        @if($section == 2 && (auth()->user()->isRole('empleado') || auth()->user()->isRole('analista.nomina')))
                            <div class="row">
                                @include('rrhh.backend.empleado.datos.carga-familiar', ['empleado' => $empleado])
                            </div>
                        @elseif($section == 2 && (auth()->user()->isRole('analista.area') || auth()->user()->isRole('gerente')))
                            <div class="row">
                                <carga-familiar :empleado="{{ json_encode($empleado) }}"></carga-familiar>
                            </div>
                        @endif
                        @if($section == 3  && auth()->user()->isRole('empleado'))
                            <div class="row">
                                @include('rrhh.backend.empleado.datos.constancia-trabajo', ['empleado' => $empleado])
                            </div>
                        @elseif($section == 3  && (auth()->user()->isRole('analista.area') || auth()->user()->isRole('gerente')))
                            <expediente-laboral :empleado="{{ json_encode($empleado) }}" ruta=""></expediente-laboral>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
