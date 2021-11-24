@extends('layout')

@section('titulo')
<i class="fas fa-folder-open" style="color: #4d5fa7;"></i> 
    Agregar adenda
@endsection

@section('content')
<div>
    <form method="POST" action="{{ route('actas.update', $acta->id) }}">
    @csrf
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
        <div class="form-group row">
            <div class="col-md-12 text-left">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5>Adendas:</h5>
                    </div>
                    <div class="card-body">
                        @error('adendas')
                                <p style="color: red; font-size:11px">{{ $message }}</p>
                            @enderror
                        <textarea class="form-control" name="adendas" rows="3">{{$acta->adendas}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12 text-right">
                <button class="btn btn-primary" type="submit" id="submit"><i class="fas fa-save"></i> Guardar</button>
                    <button class="btn btn-secondary" id="cancelar"> <i class="fas fa-times"></i> Cancelar</button>
            </div>
        </div>
    </form>
</div>

<script>
    $("#cancelar").click(function(){
        if(confirm('¿Está seguro que desea cancelar?')){
            window.history.back();
            return false;
        }
    });

    $("#submit").click(function(){
        if(confirm('¿Está seguro que desea guardar?')){
            $('#whole_page_loader').show();
        }
    });

    window.onbeforeunload = function() {
        event.preventDefault();
        var $post = {};
        $post.id = "{{$acta->id}}";
        $post._token = document.getElementsByName("_token")[0].value;
        $.ajax({
            url: "{{route('actas.cambiar_estado')}}", 
            type: 'get',
            data: $post,
            cache: false,
        });
    };
</script>
@endsection