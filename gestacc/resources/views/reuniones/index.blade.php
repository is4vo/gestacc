@extends('layout')

@section('titulo')
    Reuniones
@endsection

@section('content')
<div>
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('reuniones.create')}}" > <i class="fas fa-plus"></i> Crear reunión</a>
        </div>
        @if($reuniones->count())
            <div class="card-body">
                <table id="tabla_reuniones" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo reunión</th>
                            <th>Número reunión</th>
                            <th>Hora inicio</th>
                            <th>Hora término</th>
                            <th>Estado</th>
                            <th ></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reuniones as $reunion)
                            <tr>
                                <td>{{$reunion->fecha_reunion}}</td>
                                <td>{{$reunion->tipo_reunion}}</td>
                                <td>{{$reunion->numero_reunion}}</td>
                                <td>{{$reunion->hora_inicio}}</td>
                                <td>{{$reunion->hora_termino}}</td>
                                <td>{{$reunion->estado}}</td>
                                <td>
                                    @if($reunion->estado == "Pendiente")
                                        <a href = "{{ route('actas.create', $reunion->id) }}" class="btn"> <i class="fas fa-file-alt"></i></a>
                                    @endif
                                </td>
                                <td>
                                    @if($reunion->estado == "Pendiente")
                                        <a href = "{{ route('reuniones.cancel', $reunion->id) }}" class="btn" onclick="return confirm('¿Está seguro que desea cancelar?')"> <i style="color: red" class="fas fa-times-circle"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

    </div>
</div>
<script>
    $(document).ready( function () {
        $('#tabla_reuniones').DataTable({
            "info":     false
        });
    } );
</script>
@endsection

