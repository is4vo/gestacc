@extends('layout')

@section('titulo')
<i class="fas fa-tasks" style="color: #4d5fa7;"></i>
    Mis tareas
@endsection

@section('content')

<div>
    <div class="card">
        @if($tareas->count())
            <div class="card-body">
                <table id="tabla_tareas" class="table table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 20%">Fecha vencimiento</th>
                            <th>Titulo</th>
                            <th style="width: 15%">Estado</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tareas as $tarea)
                            <tr>
                                <td>{{date('d-m-Y', strtotime($tarea->vencimiento))}}</td>
                                <td>{{ $tarea->titulo }}</td>
                                <td>
                                    <label style="background-color: rgb(251, 250, 231); color:rgb(128, 104, 38); border-radius:10px; width:100%; text-align: center;">  {{$tarea->estado}}  </label>
                                </td>
                                <td class="text-center"><a href = "{{ route('tareas.show', $tarea->id)}}" class="btn"> <i class="fas fa-info-circle"></i></a></td>
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
        $('#tabla_tareas').DataTable({
            "info":     false,
            "order": [0, 'asc']
        });
    } );
</script>
@endsection