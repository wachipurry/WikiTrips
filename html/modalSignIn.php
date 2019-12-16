<!-- Creación del modal de prueba con todas las clases de boostrap para que se parezca -->
<div id="sigInModal" class="sigInModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="card-body modal-content">
                <div  id="modalSignInAlert" style="display: none;"  role="alert">
                   
                  </div>
                <form>
                    <div class="form-group">
                        <label for="nickname">Nickname</label>
                        <input type="text" class="form-control" id="nickname" placeholder="Nickname" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Surnames</label>
                        <input type="text" class="form-control" id="surname" placeholder="Surname">
                    </div>
                    <div class="form-group">
                        <label for="treatment">Treatment:</label>
                        <select class="form-control" id="treatment">
                            <option>Mr</option>
                            <option>Ms</option>
                            <option>Not specified</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordA">Password </label>
                        <input type="password" class="form-control" id="passwordA" placeholder="Between 6 and 12 characters" aria-describedby="passwordHelp" required>
                        <small id="passwordHelp" class="form-text text-muted">* Must contains minimun one capital
                            letter, one especial char and one number </small>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="passwordB" placeholder="Repeat the password" required>
                    </div>
                    <button id="submitSignInButton" type="button" class="btn btn-success">Sig In</button>
                </form>
            </div>
        </div>
    </div> 