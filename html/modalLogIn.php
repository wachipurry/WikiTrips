<!-- Creación del modal de prueba de log In -->
<div id="logInModal" class="logInModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="card-body modal-content">
            <div id="modalLogInAlert" style="display: none;" role="alert">

            </div>

            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nickname">Nombre de usuario</label>
                        <input type="text" class="form-control" id="nicknameLogIn" placeholder=" Bienvenido !" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordLogIn">Contraseña</label>
                        <input type="password" class="form-control" id="passwordLogIn" placeholder=" Enjoy :) " required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submitLogInButton" type="button" class="btn btn-block btn-outline-warning text-secondary" autofocus>Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>