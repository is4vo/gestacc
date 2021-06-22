<div class="modal fade" id="crearAccion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="modalProfileLabel">Crear acción</h5>
            </div>
            <form method="" action="">
                @csrf

                <div class="modal-body">
                    
                    <div class="card">
        
                        <div class="card-body">

                                <div class="form-group row">
                                    <label for="accion" class="col-md-4 col-form-label text-md-right">{{ __('Accion:') }}</label>
        
                                    <div class="col-md-7">
                                        <input id="accion" type="text" class="form-control @error('accion') is-invalid @enderror" name="accion" required autocomplete="name" autofocus placeholder="Ingrese accion a realizar">
        
                                        @error('accion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="encargado" class="col-md-4 col-form-label text-md-right">{{ __('Encargado:') }}</label>
        
                                    <div class="col-md-7">
                                        <select for="encargado" id="encargado" name="encargado" class="form-control">
                                            {{-- @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                            @endforeach --}}

                                    </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fechaVencimiento" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de vencimiento:') }}</label>
        
                                    <div class="col-md-7">
                                        <input id="fechaVencimiento" type="text" class="form-control @error('fechaVencimiento') is-invalid @enderror" name="fechaVencimiento" required autocomplete="fechaVencimiento" autofocus placeholder="Ingrese fecha de vencimiento">
        
                                        @error('fechaVencimiento')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Guardar</button>
                    <button class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#fechaVencimiento').mask('00/00/0000');
        })
</script>