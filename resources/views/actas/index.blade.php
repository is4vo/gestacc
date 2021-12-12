@extends('layout')

@section('titulo')
<i class="fas fa-folder-open" style="color: #4d5fa7;"></i>
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
                <table id="tabla_actas" class="table table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo de reunión</th>
                            <th>Numero de reunión</th>
                            <th style="width: 12%">Estado</th>
                            @can('actas')
                                <th></th>
                            @endcan
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actas as $acta)
                            <tr>
                                <td>{{date('d-m-Y', strtotime($acta->fecha_reunion))}}</td>
                                <td>{{ $acta->tipo_reunion }}</td>
                                <td>{{ $acta->numero_reunion }}</td>
                                <td> @if($acta->estado == 'Pendiente')
                                    <label style="background-color: rgb(251, 250, 231); color:rgb(128, 104, 38); border-radius:10px; width:100%; text-align: center;">  {{$acta->estado}}  </label>
                                    @elseif($acta->estado == 'Cerrada')
                                    <label style="background-color: rgb(235, 253, 216); color:rgb(1, 80, 1); border-radius:10px; width:100%; text-align: center;">  {{$acta->estado}}  </label>
                                @endif
                                </td>
                                @can('actas')
                                    <td><a href = "{{ route('actas.edit', $acta->id)}}" class="btn"> <i class="fas fa-edit"></i></a></td>
                                @endcan
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
            "order": []
        });
    } );
</script>
    
@endsection