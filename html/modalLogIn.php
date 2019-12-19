    <!-- MODAL OCULTO DE LOGIN -->
    <div id="logInModal" class="logInModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="card-body modal-content">
                <div id="modalLogInAlert" style="display: none;" role="alert">

                </div>

                <form>
                    <div class="modal-header">
                        <h5 class="modal-title text-warning">Inicia Sesión !</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nickname">Nombre de usuario</label>
                            <input type="text" class="form-control" id="nicknameLogIn" placeholder="Inserta nickname" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="passwordLogIn">Contraseña</label>
                            <input type="password" class="form-control" id="passwordLogIn" placeholder="Inserta contraseña" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submitLogInButton" type="button" class="btn btn-block btn-outline-warning text-secondary">Entrar</button><br>
                        <button id="cancelLogInButton" type="button" class="btn btn-block btn-outline-danger text-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>