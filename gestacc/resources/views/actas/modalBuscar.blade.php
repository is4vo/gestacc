<!-- Modal -->
<div class="modal fade" id="modalFiltrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout modal-sm" role="document"> 
        <form method="POST" action="{{ route('actas.buscar')}}">
            @csrf 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filtrar actas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Ingrese palabras clave..." >
                    <hr>
                    <h6> Buscar en:</h6>
                    <div class="container">
                        <input type="checkbox" name="temas">
                        <label for="temas">Temas</label>
                        <br>
                        <input type="checkbox" name="comentarios">
                        <label for="Comentarios">Comentarios</label>
                        <br>
                        <input type="checkbox" name="acuerdos">
                        <label for="acuerdos">Acuerdos</label>
                        <br>
                        <input type="checkbox" name="tareas">
                        <label for="tareas">Tareas</label>
                    </div>
                    <hr>
                    <h6>Tipo de reunión:</h6>
                    <div class="container">
                        <input type="checkbox" name="Regular">
                        <label for="Regular">Regular</label>
                        <br>
                        <input type="checkbox" name="Extraordinaria">
                        <label for="Extraordinaria">Extraordinaria</label>
                        <br>
                        <input type="checkbox" name="Consejo de Escuela">
                        <label for="Consejo de Escuela">Consejo de Escuela</label>
                    </div>
                    <hr>
                    <h6>Rango de fechas: </h6>
                    <div class="container">
                        <label for="fecha_inicial">Fecha inicial:</label>
                        <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" min="">
                        <br>
                        <label for="fecha_final">Fecha final:</label>
                        <input type="date" class="form-control" id="fecha_final" name="fecha_final" min="">
                    </div>
                    
                    <hr>
                    <h6>Otros</h6>
                    <div class="container">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="cerradas" name="cerradas">
                            <label class="custom-control-label" for="cerradas">Mostrar sólo actas cerradas</label>
                        </div>
                        @auth
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="participado" name="participado">
                                <label class="custom-control-label" for="participado">Mostrar sólo actas en que yo he participado</label>
                            </div>
                        @endauth
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="submit">Buscar</button>
                    <button class="btn btn-secondary" id="cancelar">Cancelar</button>
                    
                </div>
            </div>
        </form>
    </div>
</div>