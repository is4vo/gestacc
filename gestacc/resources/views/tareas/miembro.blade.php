@extends('layout')

@section('titulo')
<i class="fas fa-tasks" style="color: #4d5fa7;"></i>
    Tareas
@endsection

@section('content')

<div>
    <ul class="nav nav-tabs" id="tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="todas-tab" data-toggle="tab" href="#todas" role="tab" aria-controls="todas" aria-selected="true">Todas</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="mias-tab" data-toggle="tab" href="#mias" role="tab" aria-controls="mias" aria-selected="false">Mis tareas</a>
        </li>
    </ul>
    <div class="tab-content" id="tabContent">
        <div class="tab-pane fade show active" id="todas" role="tabpanel" aria-labelledby="todas-tab">
            <div class="card">
                @if($tareas_all->count())
                    <div class="card-body">
                        <table id="tabla_tareas_all" class="table table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20%">Fecha vencimiento</th>
                                    <th>Titulo</th>
                                    <th style="width: 15%">Encargado</th>
                                    <th style="width: 15%">Estado</th>
                                    <th style="width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tareas_all as $tarea)
                                    <tr>
                                        <td>{{date('d-m-Y', strtotime($tarea->vencimiento))}}</td>
                                        <td>{{ $tarea->titulo }}</td>
                                        <td> {{$tarea->encargado->name}} </td>
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
        <div class="tab-pane fade show" id="mias" role="tabpanel" aria-labelledby="mias-tab">
            <div class="card">
                @if($tareas->count())
                    <div class="card-body">
                        <table id="tabla_tareas" class="table table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>Fecha vencimiento</th>
                                    <th style="width: 40%">Titulo</th>
                                    <th>Estado</th>
                                    <th style="width: 5%"></th>
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
    </div>
</div>
    
<script>
    $(document).ready( function () {
        $('#tabla_tareas').DataTable({
            "info":     false,
            "order": [0, 'asc']
        });
        $('#tabla_tareas_all').DataTable({
            "info":     false,
            "order": [0, 'asc']
        });
    } );
</script>
@endsection