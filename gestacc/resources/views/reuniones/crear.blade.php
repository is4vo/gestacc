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
                        <h6><b>Número de reunión:</b></h6>
                        <input type="number" class="form-control" id="numero_reunion" name="numero_reunion" placeholder="000" required value="{{ old('numero_reunion')}}">

                        @error('numero_reunion')
                            <p style="color: red; font-size:11px">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-4 text-left">
                        <h6><b>Tipo de reunión:</b></h6>
                        <select for="tipo_reunion" id="tipo_reunion" name="tipo_reunion" class="form-control" required value="{{ old('tipo_reunion')}}">
                            <option value="Semanal">Semanal</option>
                            <option value="Extraordinaria">Extraordinaria</option>
                            <option value="Consejo de Escuela">Consejo de Escuela</option>
                        </select>
                        
                        @error('tipo_reunion')
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
                <ul class="list-group list-group-flush" style="width:100%">
                    @foreach($usuarios as $usuario)
                        <li class="list-group-item">
                            <input type="checkbox" name="asistentes[]" value=" {{$usuario->id}} ">   
                            <label>   {{$usuario->name}}</label>
                        </li>
                    @endforeach
                </ul>
                @error('asistentes')
                    <p style="color: red; font-size:11px">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <h5><b>Temas</b></h5>
            </div>
            <div class="card-body">
                <textarea class="form-control" name="lista_temas" id="lista_temas" rows="3" placeholder="Ingrese temas separados por un salto de línea..."></textarea>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <div class="col-md-12 text-right">
                <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Guardar</button>
                <button class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar</button>
            </div>
        </div>

    </form>
</div>

{{-- @if(session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="fixed">
        <p>{{ session('success') }}</p>
    </div>  
@endif --}}


@endsection