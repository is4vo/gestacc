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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                @if($usuario->hasRole(['Miembro', 'Invitado']))
                                    <td>{{$usuario->id}}</td>
                                    <td>{{$usuario->name}}</td>
                                    <td>{{$usuario->email}}</td>
                                    <td>{{$usuario->getRoleNames()[0]}}</td>
                                    <td width="10px">
                                        <a href = "{{ route('usuarios.edit', $usuario->id)}}" class="btn btn-secondary"> <i class="fas fa-pencil-alt"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{-- paginacion --}}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif

        @include('usuarios.crear')
    </div>
</div>

@endsection
