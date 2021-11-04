@extends('layout')

@section('titulo')
    Tarea
@endsection

@section('content')
<div>
    <div class="form-group row">
        <div class="col-md-6 text-left">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5><b>Información del acta</b></h5>
                </div>
                <div class="card-body">
                    <h6><b>Tipo de reunión:</b> {{$acta->tipo_reunion}}</h6> 
                    <hr>
                    <h6><b>Número de reunión:</b> {{$acta->numero_reunion}}</h6> 
                    <hr>
                    <h6><b>Fecha:</b> {{$acta->fecha_reunion}}</h6> 
                    <hr>
                    <h6><b>Tema:</b> {{$tema->titulo}}</h6> 
                    <hr>
                    <h6><b>Comentarios:</b> {{$tema->comentarios}}</h6> 
                </div>
            </div>
        </div>
        <div class="col-md-6 text-left">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5><b>Detalles de tarea</b></h5>
                </div>
                <div class="card-body">
                    <h6><b>Título:</b> {{$tarea->titulo}}</h6> 
                    <hr>
                    <h6><b>Encargado:</b> {{$encargado->name}}</h6> 
                    <hr>
                    <h6><b>Vencimiento:</b> {{$tarea->vencimiento}}</h6> 
                    <hr>
                    <h6><b>Estado:</b> {{$tarea->estado}}
                        @can('reunion')
                            <a href = "{{ route('tareas.done', $tarea->id)}}" class="btn" onclick="return confirm('¿Está seguro que desea marcar como realizada?')"> <i style="color: green" class="fas fa-check-circle"></i></a>
                            <a href = "{{ route('tareas.cancel', $tarea->id)}}" class="btn" onclick="return confirm('¿Está seguro que desea cancelar esta tarea?')"> <i style="color: red" class="fas fa-times-circle"></i></a>
                        @endcan
                    </h6> 
                    <hr>
                    <h6><b>Comentarios:</b> 
                        <a href ="" data-toggle="modal" data-target="#agregar_comentario" class="btn"> <i style="color: gray" class="fas fa-plus-circle"></i></a>
                    </h6> 
                    {{$tarea->comentario}}
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal agregar comentario --}}
<div class="modal fade" id="agregar_comentario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100">Agregar comentario</h5>
            </div>
            <form method="POST" action="{{ route('tareas.update', $tarea->id) }}">
                @csrf
                <div class="modal-body">
                    <textarea class="form-control" id="comentarios_tarea" name="comentarios_tarea" rows="3" placeholder="Ingrese comentarios de la tarea..."></textarea>
                        @error('comentarios_tarea')
                            <p style="color: red; font-size:11px">{{ $message }}</p>
                        @enderror
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="agregar_comentario"><i class="fas fa-save"></i> Agregar</button>
                    <button class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection