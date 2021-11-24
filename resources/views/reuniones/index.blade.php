@extends('layout')

@section('titulo')
<i class="fas fa-handshake" style="color: #4d5fa7;"></i>  
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
                <table id="tabla_reuniones" class="table table-hover text-center">
                    <thead class="thead-light">
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
                                <td>{{date('d-m-Y', strtotime($reunion->fecha_reunion))}}</td>
                                <td>{{$reunion->tipo_reunion}}</td>
                                <td>{{$reunion->numero_reunion}}</td>
                                <td>{{date('H:i', strtotime($reunion->hora_inicio))}}</td>
                                <td>{{date('H:i', strtotime($reunion->hora_termino))}}</td>
                                <td> @if($reunion->estado == 'Pendiente')
                                    <label style="background-color: rgb(251, 250, 231); color:rgb(128, 104, 38); border-radius:10px; width:100%; text-align: center;">  {{$reunion->estado}}  </label>
                                    @elseif($reunion->estado == 'Cancelada')
                                    <label style="background-color: rgb(255, 236, 236); color:rgb(112, 39, 39); border-radius:10px; width:100%; text-align: center;">  {{$reunion->estado}}  </label>
                                    @elseif($reunion->estado == 'Realizada')
                                    <label style="background-color: rgb(235, 253, 216); color:rgb(1, 80, 1); border-radius:10px; width:100%; text-align: center;">  {{$reunion->estado}}  </label>
                                @endif
                                </td>
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
            "info":     false,
            "order": []
        });
    } );
</script>
@endsection

