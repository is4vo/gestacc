@extends('layout')

@section('titulo')
    Buscar actas
@endsection

@section('content')

<div>
    <div class="card">
        @if($actas->count())
            <div class="card-header">
                <div class="form-group row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Ingrese palabras clave..." >
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalFiltrar">
                        <i class="fas fa-filter"></i>
                    </button>
                    </div> 
                </div>
            </div>
            <div class="card-body">
                <table id="tabla_actas" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo de reunión</th>
                            <th>Numero de reunión</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actas as $acta)
                            <tr>
                                <td>{{ $acta->fecha_reunion }}</td>
                                <td>{{ $acta->tipo_reunion }}</td>
                                <td>{{ $acta->numero_reunion }}</td>
                                <td>{{ $acta->estado }}</td>
                                <td><a href = "{{ route('actas.download', $acta->id)}}" target="_blank" class="btn"><i class="fas fa-file-pdf"></i> </a></td>
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

<!-- Modal -->
<div class="modal fade" id="modalFiltrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal sideout small</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#tabla_actas').DataTable({
            "info":     false,
            "searching": false
        });
    } );
</script>
    
@endsection