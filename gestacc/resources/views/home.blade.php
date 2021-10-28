@extends('layout')

@section('titulo')
    Inicio
@endsection

@section('content')

<div>
    <div class="form-group row">
        <div class="col-md-6 text-left">
            <div class="card">
                <div class="card-header">
                    <h5>Mis Reuniones</h5>
                </div>
                <div class="card-body">
                    @if($reuniones->count())
                        <table class="table table-striped">
                            <thead>
                                <th>Fecha</th>
                                <th>Tipo reunion</th>
                                <th>Número reunión</th>
                            </thead>
                            <tbody>
                                @foreach($reuniones as $reunion)
                                <tr>
                                    <td>{{$reunion->fecha_reunion}}</td>
                                    <td>{{$reunion->tipo_reunion}}</td>
                                    <td>{{$reunion->numero_reunion}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <strong>No hay reuniones pendientes</strong>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        @can('reunion')
                            <a href="{{ route('reuniones.index') }}" style="color: grey"> <i class="fas fa-plus-circle"></i> Ver más</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 text-left">
            <div class="card">
                <div class="card-header">
                    <h5>Mis Tareas</h5>
                </div>
                <div class="card-body">
                    @if($tareas->count())
                        <table class="table table-striped">
                            <thead>
                                <th>Fecha vencimiento</th>
                                <th>Tarea</th>
                            </thead>
                            <tbody>
                                @foreach($tareas as $tarea)
                                <tr>
                                    <td>{{$tarea->vencimiento}}</td>
                                    <td>{{$tarea->titulo}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <strong>No hay tareas pendientes</strong>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        @can('tareas')
                            <a href="{{ route('tareas.index') }}" style="color: grey"> <i class="fas fa-plus-circle"></i> Ver más</a>
                        @endcan
                    </div>
                </div>
                <a href="" style="color: red" data-toggle="modal" data-target="#modalAlertas"> <i class="fas fa-plus-circle"></i> Alertas **** </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAlertas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alertas</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <ul class="list-group list-group-flush" style="width: 500px">
                        @foreach($alertas as $alerta)
                            <li class="list-group-item"> 
                                <h6> {{$alerta}}</h6>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#modalAlertas").modal('show');
    });
</script>
@endsection