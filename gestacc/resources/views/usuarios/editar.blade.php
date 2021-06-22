@extends('layout')

@section('titulo')
    Editar usuario
@endsection

@section('content')

    <div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
    
                    <div class="modal-body">
                        
                        <div class="card">
            
                            <div class="card-body">
    
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $usuario->name }}" required autocomplete="name" autofocus>
            
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuario->email }}" required autocomplete="email">
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
            
                                        <div class="col-md-6">
                                            <select for="rol" id="rol" name="rol" class="form-control">
                                                @if($usuario->hasRole('Miembro'))
                                                    <option value="Miembro" selected>Miembro</option>
                                                    <option value="Invitado">Invitado</option>
                                                @else
                                                    <option value="Miembro">Miembro</option>
                                                    <option value="Invitado" selected>Invitado</option>
                                                @endif
                                        </select>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit"> <i class="fas fa-save"></i> Guardar</button>
                        <a class="btn btn-secondary" href= "{{ route('usuarios.index') }}"> <i class="fas fa-times"></i> Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection