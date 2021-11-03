@extends('layout')

@section('titulo')
    Buscar actas
@endsection

@section('content')

<div>
    <div class="card">
        @if($actas->count())
            <div class="card-header text-right">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalFiltrar">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
            <div class="card-body">
                @error('fecha_inicial')
                    <p style="color: red; font-size:11px">{{ $message }}</p>
                @enderror
                @error('fecha_final')
                    <p style="color: red; font-size:11px">{{ $message }}</p>
                @enderror
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
                        @foreach($actas as $acta)
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
@include('actas.modalBuscar')

<script>
    $(document).ready( function () {
        $('#tabla_actas').DataTable({
            "info":     false,
            "searching": false
        });
    } );
</script>
    
@endsection