@extends('layout')

@section('titulo')
<i class="fas fa-home" style="color: #4d5fa7;"></i>
    Inicio 
    
@endsection

@section('content')

<div>
    @if(count($alertas)>0)
    <div>
        <button data-toggle="modal" data-target="#modalAlertas" type="button" class="btn btn-primary" style="position: fixed; top: 57px; right: 50px;">
            Alertas <span class="badge badge-light">@php echo count($alertas) @endphp</span>
        </button>
    </div>
    @endif
    <div class="form-group row">
        <div class="col-md-6 text-left">
            <div class="card shadow-sm">
                <h5 class="card-header d-flex justify-content-between align-items-center">
                    Mis Reuniones
                    <i class="far fa-calendar-alt fa-2x" style="color: #4d5fa7;"></i>
                </h5>
                <div class="card-body">
                    @if($reuniones->count())
                        <table class="table table-hover text-center">
                            <thead class="thead-light">
                                <th>Fecha</th>
                                <th>Tipo reunion</th>
                                <th style="width: 35%">Número reunión</th>
                            </thead>
                            <tbody>
                                @foreach($reuniones as $reunion)
                                <tr>
                                    <td>{{date('d-m-Y', strtotime($reunion->fecha_reunion))}}</td>
                                    <td>{{$reunion->tipo_reunion}}</td>
                                    <td class="text-center">{{$reunion->numero_reunion}}</td>
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
            <div class="card shadow-sm">
                <h5 class="card-header d-flex justify-content-between align-items-center">
                    Mis Tareas
                    <i class="fas fa-tasks fa-2x" style="color: #4d5fa7;"></i>
                </h5>
                <div class="card-body">
                    @if($tareas->count())
                        <table class="table table-hover text-center">
                            <thead class="thead-light">
                                <th style="width: 35%">Fecha vencimiento</th>
                                <th>Tarea</th>
                            </thead>
                            <tbody>
                                @foreach($tareas as $tarea)
                                <tr>
                                    <td>{{date('d-m-Y', strtotime($tarea->vencimiento))}}</td>
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
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAlertas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <i class="fas fa-exclamation-triangle" style="color: #4d5fa7;"></i>  Alertas</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="max-height: 300px;overflow: scroll;background-color: rgb(250, 249, 249);">
                        @foreach($alertas as $alerta)
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h6> {{$alerta}} </h6>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection