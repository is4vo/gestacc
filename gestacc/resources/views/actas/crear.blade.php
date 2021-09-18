@extends('layout')

@section('titulo')
    Crear acta
@endsection

@section('content')
    <div>
        <form method="POST" action="{{ route('actas.store') }}">
            <div class="card">
                <div class="card-header">
                    <h5><b>Datos de reunión</b></h5>
                </div>
                <div class="card-body">
                    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                        <div class="col-md-4 text-left">
                            <h6><b>Número de reunión:</b></h6>
                            <input type="text" class="form-control" id="numero_reunion" name="numero_reunion" value="{{ $reunion->numero_reunion }}" readonly>
                        </div>
                        <div class="col-md-4 text-left">
                            <h6><b>Tipo de reunión:</b></h6>
                            <input type="text" class="form-control" id="tipo_reunion" name="tipo_reunion" value="{{ $reunion->tipo_reunion }}" readonly>
                        </div>
                        <div class="col-md-4 text-left">
                            <h6><b>Fecha:</b></h6>
                            <input type="date" class="form-control" id="fecha_reunion" name="fecha_reunion" value="{{ $reunion->fecha_reunion }}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                        
                        <div class="col-md-6 text-left">
                            <h6><b>Hora de inicio:</b></h6>
                            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="{{ $reunion->hora_inicio }}">
                        </div>
                        <div class="col-md-6 text-left">
                            <h6><b>Hora de término:</b></h6>
                            <input type="time" class="form-control" id="hora_termino" name="hora_termino" value="{{ $reunion->hora_termino }}">
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
                    <div class="form-group row">
                        <div class="col-md-12">
                            <table class="table table-sm">
                                <thead class="thead-light">
                                    <th>Participante</th>
                                    <th>Asiste</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($asistentes as $asistente)
                                            <td>{{ $asistente->name }}</td>
                                            <td><input type="checkbox" id="asiste"></td>
                                        @endforeach
                                        
                                    </tr>
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
                            <textarea class="form-control" id="comentariosTema" rows="3" placeholder="Ingrese comentarios del tema..."></textarea>
                        </div>

                        <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                            <div class="col-md-12 text-right">
                                <a href="" style="color: gray" data-toggle="modal" data-target="#crearAccion"> <i class="fas fa-plus-circle"></i> Agregar nueva acción</a>
                            </div>
                            <table class="table table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Acción a realizar</th>
                                        <th>Encargado</th>
                                        <th>Fecha vencimiento</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="450px">Enviar correo a Director</td>
                                        <td>Francisca Arenas</td>
                                        <td>12/06/2021</td>
                                        <td width="10px">
                                            <a href = #> <i class="fas fa-pencil-alt"></i></a>
                                        </td>
                                        <td width="10px">
                                            <a href = #> <i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Inscribir curso</td>
                                        <td>Marcelo Fuentes</td>
                                        <td>15/06/2021</td>
                                        <td width="10px">
                                            <a href = #> <i class="fas fa-pencil-alt"></i></a>
                                        </td>
                                        <td width="10px">
                                            <a href = #> <i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h5><b>Varios</b></h5>
                </div>
                <div class="card-body">
                    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                        <h6><b>Título:</b></h6>
                        <input type="text" class="form-control" id="reunion" name="reunion" placeholder="Ingrese título del tema">
                    </div>
                    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                        <textarea class="form-control" id="comentariosTema" rows="3" placeholder="Ingrese comentarios del tema..."></textarea>
                    </div> 
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
    {{-- Incluir modales --}}
    @include('actas.modalNuevaAccion')
    @include('actas.modalAgregarAsistente')

@endsection