@extends ('rrhh.layouts.frontend')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12 pt-5">
                <h2 class="text-uppercase text-info">Perfil del cargo</h2>
                <hr>
                {!! $cargo->perfil !!}
            </div>
        </div>

        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#postulacionModal">
            <i class="fas fa-check"></i> Postularme al cargo
        </button>

        <!-- Modal -->
        <div class="modal fade" id="postulacionModal" tabindex="-1" role="dialog"
             aria-labelledby="postulacionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="postulacionModalLabel">Registro de Aspirantes</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('rrhh.frontend.modals.aspirantes_form', ['vacante_id' => $vacante_id, 'cargo_id' => $cargo->cargo_id])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection