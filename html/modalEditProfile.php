<!-- Creación del modal de prueba con todas las clases de boostrap para que se parezca -->
<div id="editProfileModal" class="editProfileModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="card-body modal-content">
            <h2>Edit profile</h2>

            <div id="modalEditProfileAlert" style="display: none;" role="alert">
            </div>
            <div class="modal-header">
                <h5 class="modal-title text-warning">Ayudanos a saber un poco mas de ti !!</h5>
            </div>
            <form>
                <div class="modal-body">

                    <!-- EL NOOMBRE DE USUARIO NO PUEDE CANVIAR, HO PETA LA BASE DE DATOS -->
                    <!--<div class="form-group">
                    <label for="nicknameEdit">Nickname</label>
                    <input type="text" class="form-control" id="nicknameEdit" placeholder="Pakito69" readonly>
                </div>-->
                    <div class="form-group">
                        <label for="treatment">Como podemos dirigirnos a ti?</label>
                        <select class="form-control" id="treatment">
                            <option>Sr.</option>
                            <option>Sra.</option>
                            <option>Don</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nameEdit">Nombre</label>
                        <input type="text" class="form-control" id="nameEdit" placeholder="escribe aquí tu nombre" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="surnameEdit">Apellido</label>
                        <input type="text" class="form-control" id="surnameEdit" placeholder="escribe aqui tu apellido">
                    </div>
                    <div class="form-group">
                        <label for="userDescriptionEdit">Cuentanos algo sobre ti</label>
                        <textarea type="text" class="form-control" rows="4" id="userDescriptionEdit" placeholder="escribe aqui tu apellido">
                    </div>
                    <div class="form-group">
                        <label for="newEmail">Nueva dirección email</label>
                        <input type="newEmail" class="form-control" id="newEmail" placeholder="hola@wikitrips.cat">
                    </div>
                    <div class="form-group">
                        <label for="publicityEdit">Quieres que te informemos de las ultimas novedades en la web?</label>
                        <select class="form-control" id="publicityEdit">
                            <option>Si</option>
                            <option>No.</option>
                        </select>
                    </div>
                    <!-- EL PASSWORD QUE NO SE CAMBIE POR AHORA, PASO DE UPDATES XUNGOS -->
                    <!--<div class="form-group">
                    <label for="newPassword">New password </label>
                    <input type="text" placeholder="Between 6 and 12 characters" class="form-control" id="newPassword">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="newPasswordRepeat" placeholder="Repeat the password" aria-describedby="passwordHelp">
                    <small id="passwordHelp" class="form-text text-muted">* Must contains minimun one capital
                        letter, one especial char and one number </small>
                </div>-->
                </div>
                <div class="modal-footer">
                    <button id="submitEditProfileButton" type="button" class="btn btn-outline-warning text-secondary">CONFIRMAR</button>
                    <button id="cancelEditProfileButton" type="button" class="btn btn-outline-danger text-secondary">CANCELAR</button>
                </div>
            </form>
        </div>
    </div>
</div>