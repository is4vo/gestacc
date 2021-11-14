@extends('layout')

@section('titulo')
<i class="fas fa-folder-open" style="color: #4d5fa7;"></i> 
    Resultados
@endsection

@section('content')

<div>
    <div class="card">
        @if($resultados->count())
            <div class="card-header text-right">
                <a href="{{ route('actas.index') }}" style="color: gray">
                    <i class="fas fa-broom"></i> Limpiar filtros
                </a>
            </div>
            <div class="card-body">
                <table id="tabla_actas" class="table table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo de reunión</th>
                            <th>Numero de reunión</th>
                            <th style="width: 12%">Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resultados as $acta)
                            <tr>
                                <td>{{date('d-m-Y', strtotime($acta->fecha_reunion))}}</td>
                                <td>{{ $acta->tipo_reunion }}</td>
                                <td>{{ $acta->numero_reunion }}</td>
                                <td>
                                    @if($acta->estado == 'Pendiente')
                                    <label style="background-color: rgb(251, 250, 231); color:rgb(128, 104, 38); border-radius:10px; width:100%; text-align: center;">  {{$acta->estado}}  </label>
                                    @elseif($acta->estado == 'Cerrada')
                                    <label style="background-color: rgb(235, 253, 216); color:rgb(1, 80, 1); border-radius:10px; width:100%; text-align: center;">  {{$acta->estado}}  </label>
                                @endif
                                </td>
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
            "searching": false,
            "order": [0, 'desc']
        });
    } );
</script>
    
@endsection