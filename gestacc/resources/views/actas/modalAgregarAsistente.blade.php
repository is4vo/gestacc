<div class="modal fade" id="agregarAsistente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100">Agregar asistentes</h5>
            </div>
            <form onsubmit="agregarAsistentes()">
                @csrf
                <div class="modal-body">
                    
                    <div class="card">
        
                        <div class="card-body">

                                <div class="form-group row">
                                    <ul class="list-group list-group-flush" style="width: 500px">
                                        @foreach($usuarios as $usuario)
                                            @if(!in_array($usuario, $asistentes))
                                                <li class="list-group-item">
                                                    <input type="checkbox" id="asistentes[]" name="asistentes[]" value=" {{$usuario->id}} ">   
                                                    <label>   {{$usuario->name}}</label>
                                                </li>
                                            @endif
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
<p id="asistentes"></p>
<script>
    function agregarAsistentes() {
        var nuevos_asistentes = document.getElementById("asistentes[]").value;
        var asistentes = $asistentes;
        asistentes.push(nuevos_asistentes);
        document.cookie = "asistentes=asistentes";
    }
</script>