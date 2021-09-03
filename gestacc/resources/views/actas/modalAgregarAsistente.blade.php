<div class="modal fade" id="agregarAsistente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="modalProfileLabel">Agregar asistentes</h5>
            </div>
            <form method="" action="">
                @csrf

                <div class="modal-body">
                    
                    <div class="card">
        
                        <div class="card-body">

                                <div class="form-group row">
                                    <ul class="list-group list-group-flush">
                                        @foreach($usuarios as $usuario)
                                            <li class="list-group-item">
                                                <input type="checkbox" id="asiste">   
                                                <label value="{{$usuario->id}}">   {{$usuario->name}}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Agregar</button>
                    <button class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>