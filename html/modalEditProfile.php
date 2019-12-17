<!-- Creación del modal de prueba con todas las clases de boostrap para que se parezca -->
<div id="editProfileModal" class="editProfileModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="card-body modal-content">
            <h2>Edit profile</h2>

            <div id="modalEditProfileAlert" style="display: none;" role="alert">

            </div>
            <form>
                <div class="form-group">
                    <label for="nicknameEdit">Nickname</label>
                    <input type="text" class="form-control" id="nicknameEdit" placeholder="Nickname" >
                </div>
                <div class="form-group">
                    <label for="nameEdit">Name</label>
                    <input type="text" class="form-control" id="nameEdit" placeholder="Name" >
                </div>
                <div class="form-group">
                    <label for="surnameEdit">Surnames</label>
                    <input type="text" class="form-control" id="surnameEdit" placeholder="Surnames" >
                </div>
                <div class="form-group">
                    <label for="oldEmailEdit">Current email address</label>
                    <input type="oldEmailEdit" class="form-control" id="oldEmailEdit" placeholder="Enter email" readonly>
                </div>
                <div class="form-group">
                    <label for="newEmail">New email address</label>
                    <input type="newEmail" class="form-control" id="newEmail" placeholder="Enter new email">
                </div>
                <div class="form-group">
                    <label for="oldPassword">Current password </label>
                    <input type="text" class="form-control" id="oldPassword" readonly>
                </div>
                <div class="form-group">
                    <label for="newPassword">New password </label>
                    <input type="text" class="form-control" id="newPassword" >
                    <input type="text" class="form-control" id="newPasswordRepeat" aria-describedby="passwordHelp">
                    <small id="passwordHelp" class="form-text text-muted">* Must contains minimun one capital
                        letter, one especial char and one number </small>
                </div>
                <button id="submitEditProfileButton" type="button" class="btn btn-success">Confirm</button>
                <button id="cancelEditProfileButton" type="button" class="btn btn-danger">Cancel</button>

            </form>
        </div>
    </div>
</div>