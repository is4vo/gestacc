@extends('layout')

@section('titulo')
    Resultados
@endsection

@section('content')

<div>
    <div class="card">
        @if($resultados->count())
            <div class="card-header text-right">
                <a href="{{ route('actas.index') }}" style="color: gray">
                    Limpiar
                </a>
            </div>
            <div class="card-body">
                <table id="tabla_actas" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo de reunión</th>
                            <th>Numero de reunión</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resultados as $acta)
                            <tr>
                                <td>{{ $acta->fecha_reunion }}</td>
                                <td>{{ $acta->tipo_reunion }}</td>
                                <td>{{ $acta->numero_reunion }}</td>
                                <td>{{ $acta->estado }}</td>
                                <td><a href = "{{ route('actas.download', $acta->id)}}" target="_blank" class="btn"><i class="fas fa-file-pdf"></i> </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>

<script>
    $(document).ready( function () {
        $('#tabla_actas').DataTable({
            "info":     false,
            "searching": false
        });
    } );
</script>
    
@endsection