@extends('layout')

@section('titulo')
    Crear acta
@endsection

@section('content')
    <div>
        <form method="POST" action="{{ route('actas.store', compact('reunion')) }}">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h5><b>Datos de reunión</b></h5>
                </div>
                <div class="card-body">
                    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                        <div class="col-md-4 text-left">
                            <h6><b>Tipo de reunión:</b></h6>
                            <input type="text" class="form-control" id="tipo_reunion" name="tipo_reunion" value="{{ $reunion->tipo_reunion }}" readonly>
                            @error('tipo_reunion')
                                <p style="color: red; font-size:11px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4 text-left">
                            <h6><b>Número de reunión:</b></h6>
                            <input type="text" class="form-control" id="numero_reunion" name="numero_reunion" value="{{ $reunion->numero_reunion }}" readonly>
                            @error('numero_reunion')
                                <p style="color: red; font-size:11px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4 text-left">
                            <h6><b>Fecha:</b></h6>
                            <input type="date" class="form-control" id="fecha_reunion" name="fecha_reunion" value="{{ $reunion->fecha_reunion }}" readonly>
                            @error('fecha_reunion')
                                <p style="color: red; font-size:11px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                        
                        <div class="col-md-6 text-left">
                            <h6><b>Hora de inicio:</b></h6>
                            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="{{ $reunion->hora_inicio }}" required>
                            @error('hora_inicio')
                                <p style="color: red; font-size:11px">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 text-left">
                            <h6><b>Hora de término:</b></h6>
                            <input type="time" class="form-control" id="hora_termino" name="hora_termino" value="{{ $reunion->hora_termino }}" required>
                            @error('hora_termino')
                                <p style="color: red; font-size:11px">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <h5><b>Asistentes</b></h5>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="" style="color: gray" data-toggle="modal" data-target="#agregarAsistente"> <i class="fas fa-plus-circle"></i> Agregar asistente</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @error('asistentes')
                        <p style="color: red; font-size:11px">{{ $message }}</p>
                    @enderror
                    @error('participantes')
                        <p style="color: red; font-size:11px">{{ $message }}</p>
                    @enderror
                    <div class="form-group row">
                        <div class="col-md-12">
                            <table class="table table-striped" id="lista_asistentes">
                                <thead class="thead-light">
                                    <th>Participante</th>
                                    <th style="width: 200px">Asiste</th>
                                </thead>
                                <tbody>
                                    @foreach($asistentes as $asistente)
                                        <tr>
                                            <td><input type="hidden" name="asistentes[]" value="{{$asistente->id}}"><label>{{$asistente->name}}</label></td>
                                            <td><input type="checkbox" name="participantes[]" value="{{$asistente->id}}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h5><b>Temas</b></h5>
                </div>
                <div class="card-body">
                    @foreach($temas as $tema)
                        <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                            <h6><b>{{ $tema->titulo }}</b></h6>
                            <textarea class="form-control" name="comentariosTema[{{$tema->id}}]" rows="3" placeholder="Ingrese comentarios del tema..."></textarea>
                            @error('comentariosTema.*')
                                <p style="color: red; font-size:11px">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                            <div class="col-md-12 text-right">
                                <a name="agregarAccion.{{$tema->id}}" style="color: gray" class="btn" id="agregarAccion.{{$tema->id}}"> <i class="fas fa-plus-circle"></i> Agregar nueva acción</a>
                            </div>
                            <table class="table table-striped" id="lista_acciones{{$tema->id}}">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Acción a realizar</th>
                                        <th>Tipo</th>
                                        <th>Encargado</th>
                                        <th>Fecha vencimiento</th>
                                        <th style="width: 100px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" type="submit" onclick="return confirm('¿Está seguro que desea guardar?')"><i class="fas fa-save"></i> Guardar</button>
                    <button class="btn btn-secondary" onclick="return confirm('¿Está seguro que desea cancelar?')"> <i class="fas fa-times"></i> Cancelar</button>
                </div>
            </div>

        </form>
    </div>
    @include('actas.modalAgregarAsistente')

    <script>
        $(document).ready(function(){ 
            $('.btn').click(function(){  
                var id = $(this).attr("id").split('.')[1]; 
                $('#lista_acciones'+id+'').append('<tr id="row'+id+'" class="dynamic-added"><td><input name="accion'+id+'[]" id="accion'+id+'[]" type="text" class="form-control" required placeholder="Ingrese accion a realizar"></td><td><select for="tipo" id="tipo'+id+'[]" name="tipo'+id+'[]" class="form-control tipo-opt"><option value="Ejecución">Ejecución</option><option value="Acuerdo">Acuerdo</option></select></td><td><select for="encargado" id="encargado'+id+'[]" name="encargado'+id+'[]" class="form-control encargado-opt">@foreach($usuarios as $usuario)<option value="{{$usuario->id}}">{{$usuario->name}}</option>@endforeach</select></td><td><input id="fechaVencimiento'+id+'[]" type="date" class="form-control fecha-opt" name="fechaVencimiento'+id+'[]" required></td><td style="width: 100px"><button type="button" class="btn btn_remove" name="remove"> <i class="fas fa-trash-alt"></i></button></td></tr></tr>'); 
                
            });  

            $(".table").on("click", ".btn_remove", function() {
                $(this).closest("tr").remove();
            });
        });
    </script>

@endsection