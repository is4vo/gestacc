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
                            <input type="text" class="form-control" id="reunion" name="reunion" value="658" readonly>
                        </div>
                        <div class="col-md-4 text-left">
                            <h6><b>Tipo de reunión:</b></h6>
                            <input type="text" class="form-control" id="tipoReunion" name="tipoReunion" value="Extraordinaria" readonly>
                        </div>
                        <div class="col-md-4 text-left">
                            <h6><b>Fecha:</b></h6>
                            <input type="text" class="form-control" id="fecha" name="fecha" value="10/06/2021" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                        
                        <div class="col-md-6 text-left">
                            <h6><b>Hora de inicio:</b></h6>
                            <input type="text" class="form-control" id="horaInicio" name="horaInicio" value="11:00">
                        </div>
                        <div class="col-md-6 text-left">
                            <h6><b>Hora de término:</b></h6>
                            <input type="text" class="form-control" id="horaTermino" name="horaTermino" value="12:00">
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
                            <a href="" style="color: gray"> <i class="fas fa-plus-circle"></i> Agregar asistente</a>
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
                                        <td>José Pérez</td>
                                        <td><input type="checkbox" id="asiste"></td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h5><b>Temas</b></h5>
                </div>
                <div class="card-body">
                    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                        <h6><b>Título de tema 1:</b></h6>
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
                    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                        <h6><b>Título de tema 2:</b></h6>
                        <textarea class="form-control" id="comentariosTema" rows="3" placeholder="Ingrese comentarios del tema..."></textarea>
                    </div>
                    <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                        <div class="col-md-12 text-right">
                            <a href="" style="color: gray"> <i class="fas fa-plus-circle"></i> Agregar nueva acción</a>
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
                                    <td width="450px">Enviar correo a secretaria</td>
                                    <td>Francisca Arenas</td>
                                    <td>13/06/2021</td>
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
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h5><b>Temas extras</b></h5>
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
            <div class="form-group row" style="margin-left: 10px; margin-right: 10px">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Guardar</button>
                    <button class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar</button>
                </div>
            </div>

        </form>
    </div>
    @include('actas.nuevaAccion')
    
@endsection