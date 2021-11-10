@extends('layout')

@section('titulo')
<i class="fas fa-folder-open" style="color: #4d5fa7;"></i> 
    Acta pendiente
@endsection

@section('content')
<div>
    <div class="form-group row">
        <div class="col-md-4 text-left">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5>Información del acta</h5>
                </div>
                <div class="card-body">
                    <h6>Tipo de reunión: {{$acta->tipo_reunion}}</h6> 
                    <hr>
                    <h6>Número de reunión: {{$acta->numero_reunion}}</h6> 
                    <hr>
                    <h6>Fecha: {{date('d-m-Y', strtotime($acta->fecha_reunion))}}</h6>
                    <hr>
                    <h6>Hora de inicio: {{date('H:i', strtotime($acta->hora_inicio))}}</h6> 
                    <hr>
                    <h6>Hora de término: {{date('H:i', strtotime($acta->hora_termino))}}</h6>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-left">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5>Temas y comentarios</h5>
                </div>
                <div class="card-body">
                    @foreach($temas as $tema)
                        <h6>Tema {{$loop->index+1}}: {{$tema->titulo}}</h6>
                        
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
    @if($acta->adendas!=NULL)
    <div class="form-group row">
        <div class="col-md-12 text-left">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5>Adendas</h5>
                </div>
                <div class="card-body">
                    <p>{{$acta->adendas}}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="form-group row">
        <div class="col-md-12 text-right">
            <a href="{{route('actas.edit', $acta->id)}}" class="btn" style="border-color: rgb(172, 172, 172);color: rgb(94, 94, 94)"><i class="fas fa-edit"></i> Agregar adenda</a>
            <a class="btn btn-secondary" onclick="return confirm('¿Está seguro que desea rechazar? El acta seguirá pendiente.')" href="{{ route('actas.pendientes') }}" id="cancelar"> <i class="fas fa-times"></i> Rechazar</a>
            <a onclick="return confirm('¿Está seguro que desea aprobar?')" href="{{ route('actas.aprobar', $acta->id) }}" class="btn" style="background-color: green; color: white;" id="submit"><i class="fas fa-check"></i> Aprobar</a>
        </div>
    </div>
</div>

@endsection