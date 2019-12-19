    <!-- MODAL OCULTO Y VACIO PARA AÑADIR UNA EXPERIENCIA -->
    <div id="addTripModal" class="addTripModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="card-body modal-content">

                <div id="modalAddTripAlert" style="display: none;" role="alert">

                </div>
                <div class="modal-header">
                    <h5 class="modal-title text-warning">Comparte con el mundo tus Trips !!</h5>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tripTitle">Título</label>
                            <input type="text" class="form-control" id="tripTitle" placeholder="es un título, no escribas mas de 50 caracteres ;)" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="tripResume">Resumen</label>
                            <textarea class="form-control" id="tripResume" rows="2" placeholder="escribe aqui una breve resumen de tu experiència (de 100 a 150 carácteres)"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tripDescription">Descripción</label>
                            <textarea class="form-control" id="tripDescription" rows="5" cols="50" placeholder="cuentanoslo todo !"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tripLocation">Ubicación</label>
                            <input type="text" class="form-control" id="tripLocation" placeholder="País, ciudad, ruta, ...">
                        </div>
                        <div class="form-group">
                            <label for="tripCategory">Categoria</label>
                            <select class="form-control" id="tripCategory">
                                <option>Love</option>
                                <option>Adventure</option>
                                <option>Relax</option>
                            </select>
                        </div>
                        <!--SAQUEMOSNOS DE ENCIMA EL TEMA IMAGEN POR SU COMPLEJIDAD -->
                        <!--<div class="form-group">
                    <label for="tripImg">Image</label>
                    <input type="file" class="form-control" id="tripImg" placeholder="Url of trip image">
                </div>-->
                    </div>
                    <div class="modal-footer">
                        <button id="submitAddTripButton" type="button" class="btn btn-outline-warning text-secondary">CONFIRMAR</button>
                        <button id="cancelAddTripButton" type="button" class="btn btn-outline-danger text-secondary">CANCELAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>