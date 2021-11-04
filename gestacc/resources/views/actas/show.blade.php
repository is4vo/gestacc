@extends('layout')

@section('titulo')
    Acta pendiente
@endsection

@section('content')
<div>
    <div class="form-group row">
        <div class="col-md-6 text-left">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5><strong>Información del acta</strong></h5>
                </div>
                <div class="card-body">
                    <h6><strong>Tipo de reunión:</strong> {{$acta->tipo_reunion}}</h6> 
                    <hr>
                    <h6><strong>Número de reunión:</strong> {{$acta->numero_reunion}}</h6> 
                    <hr>
                    <h6><strong>Fecha:</strong> {{$acta->fecha_reunion}}</h6>
                    <hr>
                    <h6><strong>Hora de inicio:</strong> {{$acta->hora_inicio}}</h6> 
                    <hr>
                    <h6><strong>Hora de término:</strong> {{$acta->hora_termino}}</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-left">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5><b>Temas y comentarios</b></h5>
                </div>
                <div class="card-body">
                    @foreach($temas as $tema)
                        <h6><b>Tema:</b> {{$tema->titulo}}</h6>
                        
                        <h6>Comentarios: {{$tema->comentarios}}</h6> 
                        <h6>Acuerdos y Tareas:</h6>
                        <ul>
                            @foreach($tema['tareas'] as $tarea)
                                <li>{{$tarea->titulo}} 
                                    @if($tarea->tipo == 'Ejecución')
                                        <a href = "{{ route('tareas.show', $tarea->id) }}" class="btn" style="color: gray"> <i class="fas fa-info-circle"></i></a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12 text-right">
            <a onclick="return confirm('¿Está seguro que desea aprobar?')" href="{{ route('acta.aprobar', $acta->id) }}" class="btn" style="background-color: green; color: white;" id="submit"><i class="fas fa-check"></i> Aprobar</a>
            <a class="btn" style="background-color: red; color: white;" id="cancelar"> <i class="fas fa-times"></i> Rechazar</a>
        </div>
    </div>
</div>

@endsection