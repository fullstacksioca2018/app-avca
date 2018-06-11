@extends('reportes.backend')
    @section('content')
    <div class="content-header">
      <div class="container-fluid">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <a href="{{ URL::to('/reportes')}}"><li class="breadcrumb-item">Inicio </li></a>
                <li class="breadcrumb-item active"> / Proyección</li>
            </ol>
          </div><!-- /.col -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="animated fadeIn"> 
            <div class="card">
                <div class="card-header text-center">
                    <strong>Proyección y Pronostico</strong>
                </div>
                <div class="card-body">
                    <!-- Metodo VUEJS/ assets/Operativo/AdministracionRuta-->
                    
                    <div id="app">
						<pronostico user="Gerente General"></pronostico>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection