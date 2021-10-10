@extends('layout')

@section('titulo')
    Actas pendientes de cierre
@endsection

@section('content')

<div>
    <div class="card">
        @if($actas->count())
            <div class="card-body">
                <table id="tabla_actas" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID acta</th>
                            <th>Tipo reunión</th>
                            <th>Número reunión</th>
                            <th>Fecha</th>
                            <th ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actas as $acta)
                            <tr>
                                <td>{{$acta->id}}</td>
                                <td>{{$acta->tipo_reunion}}</td>
                                <td>{{$acta->numero_reunion}}</td>
                                <td>{{$acta->fecha_reunion}}</td>
                                <td><a href = "{{ route('actas.show', $acta->id) }}" class="btn"> <i class="fas fa-info-circle"></i></a></td>
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
        $('#tabla_actas').DataTable({
            "info":     false
        });
    } );
</script>
    
@endsection