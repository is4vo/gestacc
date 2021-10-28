@extends('layout')

@section('titulo')
    Crear reunión
@endsection

@section('content')

<div>
    <form method="POST" action="{{ route('reuniones.store') }}">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5><b>Datos de reunión</b></h5>
            </div>
            <div class="card-body">
                <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                    <div class="col-md-4 text-left">
                        <h6><b>Tipo de reunión:</b></h6>
                        <select for="tipo_reunion" id="tipo_reunion" name="tipo_reunion" class="form-control" required value="{{ old('tipo_reunion')}}">
                            <option value="Regular">Regular</option>
                            <option value="Extraordinaria">Extraordinaria</option>
                            <option value="Consejo de Escuela">Consejo de Escuela</option>
                        </select>
                        
                        @error('tipo_reunion')
                            <p style="color: red; font-size:11px">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-4 text-left">
                        <h6><b>Número de reunión:</b></h6>
                        <input type="number" class="form-control" id="numero_reunion" name="numero_reunion" placeholder="000" required value="{{$numero_reuniones['regular']}}">

                        @error('numero_reunion')
                            <p style="color: red; font-size:11px">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 text-left">
                        <h6><b>Fecha:</b></h6>
                        <input type="date" class="form-control" id="fecha_reunion" name="fecha_reunion" required value="<?php echo date('Y-m-d'); ?>" min="">

                        @error('fecha_reunion')
                            <p style="color: red; font-size:11px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                    
                    <div class="col-md-6 text-left">
                        <h6><b>Hora de inicio:</b></h6>
                        <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required value="{{ old('hora_inicio')}}">

                        @error('hora_inicio')
                            <p style="color: red; font-size:11px">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-6 text-left">
                        <h6><b>Hora de término:</b></h6>
                        <input type="time" class="form-control" id="hora_termino" name="hora_termino" required value="{{ old('hora_termino')}}">

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
                <h5><b>Asistentes</b></h5>
            </div>
            <div class="card-body">
                @error('asistentes')
                    <p style="color: red; font-size:11px">{{ $message }}</p>
                @enderror
                <ul class="list-group list-group-flush" style="width:100%">
                    @foreach($usuarios as $usuario)
                        <li class="list-group-item">
                            <input type="checkbox" name="asistentes[]" value=" {{$usuario->id}} ">   
                            <label>   {{$usuario->name}}</label>
                        </li>
                    @endforeach
                </ul>
                
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <div class="form-group row">
                    <div class="col-md-8">
                        <h5><b>Temas</b></h5>
                    </div>
                    <div class="col-md-4 text-right">
                        <a name="agregar_tema" id="agregar_tema" style="color: gray" class="btn"> <i class="fas fa-plus-circle"></i> Agregar tema</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @error('lista_temas')
                    <p style="color: red; font-size:11px">{{ $message }}</p>
                @enderror
                @error('lista_temas.*')
                    <p style="color: red; font-size:11px">{{ $message }}</p>
                @enderror
                <table id="lista_temas" class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>  Título de tema</th>
                            <th style="width: 100px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="lista_temas[]" id="tema" value="Varios" readonly>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <div class="col-md-12 text-right">
                <button class="btn btn-primary" type="submit" onclick="return confirm('¿Está seguro que desea guardar?')"><i class="fas fa-save"></i> Guardar</button>
                
                <button class="btn btn-secondary" href="{{url()->previous()}}" onclick="return confirm('¿Está seguro que desea cancelar?')"> <i class="fas fa-times"></i> Cancelar</button>
            </div>
        </div>

    </form>
</div>


<script>
    // Tabla agregar y eliminar temas
    $(document).ready(function(){      
        var i=1;  
        
        $('#agregar_tema').click(function(){  
            var tema = $("#tema").val();
            i++;  
            $('#lista_temas').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="lista_temas[]" placeholder="Ingrese tema" class="form-control"></td><td style="width: 100px"><button type="button" class="btn btn_remove" name="remove" id="'+i+'"> <i class="fas fa-trash-alt"></i></button></td></tr>');  
        });  

        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
        });  
    });

    // Numero de reunion
    $("#tipo_reunion").change(function(){
        var selected = $("#tipo_reunion :selected").val();
        if (selected == "Regular"){
            $("#numero_reunion").val("{{$numero_reuniones['regular']}}");
        }
        else if (selected == "Extraordinaria"){
            $("#numero_reunion").val("{{$numero_reuniones['extraordinaria']}}");
        }
        else {
            $("#numero_reunion").val("{{$numero_reuniones['consejo']}}");
        }
    });
</script>
@endsection