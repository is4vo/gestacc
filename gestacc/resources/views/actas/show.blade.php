@extends('layout')

@section('titulo')
    Acta pendiente
@endsection

@section('content')
<div>
    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
        <div class="col-md-6 text-left">
            <div class="card">
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
                    <h6><b>Temas:</b></h6>
                    <ul>
                        @foreach($temas as $tema)
                            <li>{{$tema->titulo}}</li>
                        @endforeach
                    </ul>
                    
                </div>
            </div>
        </div>
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