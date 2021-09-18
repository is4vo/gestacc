@extends('layout')

@section('titulo')
    Usuarios
@endsection

@section('content')
<div>
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#crearUsuario"> <i class="fas fa-plus"></i> Crear usuario</a>
        </div>
        @if($usuarios->count())
            <div class="card-body">
                <table id="tabla_usuarios" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->id}}</td>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>{{$usuario->getRoleNames()[0]}}</td>
                                <td style="width: 50px">
                                    <a href = "{{ route('usuarios.edit', $usuario->id)}}" class="btn"> <i class="fas fa-pencil-alt"></i></a>
                                </td>
                                <td style="width: 50px">
                                    @if($usuario->status == 1)
                                        <a href = "{{ route('usuarios.enable', $usuario->id)}}" class="btn"> <i class="fas fa-eye-slash"></i></a>
                                    @else
                                        <a href = "{{ route('usuarios.enable', $usuario->id)}}" class="btn"> <i class="fas fa-eye"></i></a>
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

        @include('usuarios.crear')
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#tabla_usuarios').DataTable();
    } );
</script>
@endsection

