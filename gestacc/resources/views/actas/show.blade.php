@extends('layout')

@section('titulo')
    Acta pendiente
@endsection

@section('content')
<div>
    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
        <div class="col-md-12 text-left">
            <div class="card">
                <div class="card-header">
                    <h5><strong>Información del acta</strong></h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4 border-right text-center">
                        <h6><strong>Tipo de reunión:</strong> {{$acta->tipo_reunion}}</h6> 
                        </div>
                        <div class="col-md-4 border-right text-center">
                        <h6><strong>Número de reunión:</strong> {{$acta->numero_reunion}}</h6> 
                        </div>
                        <div class="col-md-4 text-center">
                        <h6><strong>Fecha:</strong> {{$acta->fecha_reunion}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
        <div class="col-md-6 text-left">
            <div class="card">
                <div class="card-header">
                    <h5><b>Tareas pendientes</b></h5>
                </div>
                <div class="card-body">
                    @foreach($temas as $tema)
                        @if($tema['tareas']->count())
                            <h6><b>Tema:</b> {{$tema->titulo}}</h6>
                            <ul>
                                @foreach($tema['tareas'] as $tarea)
                                    <li>{{$tarea->titulo}} <a href = "{{ route('tareas.show', $tarea->id) }}" class="btn"> <i class="fas fa-info-circle"></i></a></li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection