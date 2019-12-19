    <!-- MODAL OCULTO DE REGISTRO DE NUEVO USUARIO -->
    <div id="sigInModal" class="sigInModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="card-body modal-content">
                <div id="modalSignInAlert" style="display: none;" role="alert">

                </div>
                <div class="modal-header">
                    <h5 class="modal-title text-warning">Registrate y empieza a compartir tus trips !!</h5>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nickname">Nombre de usuario</label>
                            <input type="text" class="form-control" id="nickname" placeholder="escribe aqui tu nombre de usuario" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="treatment">Tratamiento:</label>
                            <select class="form-control" id="treatment">
                                <option>Sr.</option>
                                <option>Sra.</option>
                                <option>Don</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" placeholder="escribe aqui tu nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="surname">Apellido</label>
                            <input type="text" class="form-control" id="surname" placeholder="escribre aqui tu apellido">
                        </div>
                        <div class="form-group">
                            <label for="email">Dirección email</label>
                            <input type="email" class="form-control" id="email" placeholder="hola@wikitrips.cat" required>
                        </div>
                        <div class="form-group">
                            <label for="passwordA">Contraseña </label>
                            <input type="password" class="form-control" id="passwordA" placeholder="Entre 6 y 12 carácteres" aria-describedby="passwordHelp" required>
                            <small id="passwordHelp" class="form-text text-muted">* Debe contener mínimo una letra mayúscula, un numero y un símbolo.</small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="passwordB" placeholder="Repeat the password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submitSignInButton" type="button" class="btn btn-block btn-outline-warning text-secondary">Registrarse</button><br>
                        <button id="cancelSignInButton" type="button" class="btn btn-block btn-outline-danger text-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>