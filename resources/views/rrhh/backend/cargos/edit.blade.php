@extends('rrhh.layouts.backend')

@section('content')
  <div class="col-12">
    <div class="card">
      <div class="card-header text-white bg-info-gradient">Ingrese perfil del cargo</div>
      <div class="card-body">
        <form action="{{ route('cargo.update', $cargo[0]->cargo_id) }}" method="post">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $cargo[0]->titulo }}" readonly>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="area">Área</label>
                <input type="text" name="area" id="area" class="form-control" value="{{ $cargo[0]->nombre }}" readonly>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="area">Tabulador Salarial</label>
                <input type="text" name="area" id="area" class="form-control" value="{{ $cargo[0]->sueldo_base }}" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="perfil">Perfil</label>
            <textarea name="perfil" id="perfil" cols="30" rows="30" class="form-control">
                {{ $cargo[0]->perfil }}
              </textarea>
          </div>

          <div class="form-group">
            <input type="submit" value="Actualizar perfil" class="btn btn-info">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <!-- CK Editor -->
  <script src="/adminlte/plugins/ckeditor/ckeditor.js"></script>
  <script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    ClassicEditor
      .create(document.querySelector('#perfil'))
      .then(function (editor) {
        // The editor instance
      })
      .catch(function (error) {
        console.error(error)
      })
  </script>
@endpush
