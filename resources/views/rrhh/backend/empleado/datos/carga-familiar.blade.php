<div class="col-12">

    <h2 class="text-center">Carga familiar</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Cédula</th>
            <th>Nombre y Apellido</th>
            <th>F. Nacimiento</th>
            <th>Sexo</th>
            <th>Parentesco</th>        
        </tr>
        </thead>
        <tbody>
            @foreach ($carga_familiar as $cf)            
            <tr>
                <td>{{ $cf->cedula_beneficiario }}</td>
                <td>{{ $cf->nombre }} {{ $cf->apellido }}</td>
                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $cf->fecha_nacimiento)->format('d/m/Y') }}</td>
                <td>{{ $cf->genero }}</td>
                <td>{{ $cf->parentesco }}</td>                
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('carga-familiar.print', $empleado->empleado_id) }}" class="btn btn-primary">
        <i class="fa fa-print"></i> Imprimir
    </a>
</div>