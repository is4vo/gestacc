<div class="modal fade" id="agregarAsistente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100"><i class="fas fa-plus" style="color: #4d5fa7;"></i> Agregar asistentes</h5>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                            <div class="form-group row">
                                <ul class="list-group list-group-flush" style="width: 500px">
                                    @foreach($usuarios as $usuario)
                                        @if(!in_array($usuario, $asistentes))
                                            <li class="list-group-item">
                                                <input type="checkbox" name="asistentes[]" value="{{ $usuario->id }},{{$usuario->name}}">   
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
                <button class="btn btn-primary" data-dismiss="modal" id="agregar_asistentes"><i class="fas fa-save"></i> Agregar</button>
                <button class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#agregar_asistentes').click(function(){  
            var list = $('#lista_asistentes td:nth-child(1)').map(function() {
                return $(this).text();
            }).get();
            console.log(list);
            $('input:checked').each(function(){
                var asis = this.value.split(",");
                if (jQuery.inArray(asis[1], list) == -1){
                    $('#lista_asistentes').append('<tr class="dynamic-added"><td><input type="hidden" name="asistentes[]" value="'+asis[0]+'"><label>'+asis[1]+'</label></td><td><input type="checkbox" name="participantes[]" value="'+asis[0]+'"></td></tr>');
                }
            });
        }); 
            
    });
</script>
