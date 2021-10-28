@extends('layout')

@section('titulo')
    Tareas
@endsection

@section('content')

<div>
    <div class="card">
        @if($tareas->count())
            <div class="card-body">
                <table id="tabla_tareas" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha vencimiento</th>
                            <th>Titulo</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tareas as $tarea)
                            <tr>
                                <td>{{ $tarea->vencimiento }}</td>
                                <td>{{ $tarea->titulo }}</td>
                                <td>{{ $tarea->estado }}</td>
                                <td><a href = "{{ route('tareas.show', $tarea->id)}}" class="btn"> <i class="fas fa-info-circle"></i></a></td>
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
            "info":     false
        });
    } );
</script>
@endsection