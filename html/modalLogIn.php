<!-- Creación del modal de prueba de log In -->
<div id="logInModal" class="logInModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="card-body modal-content">
                <div  id="modalLogInAlert" style="display: none;"  role="alert">
                   
                </div>
                <form>
                    <div class="form-group">
                        <label for="nickname">Nickname or email</label>
                        <input type="text" class="form-control" id="nicknameLogIn" placeholder=" Hello one more time !" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordLogIn">Password </label>
                        <input type="password" class="form-control" id="passwordLogIn" placeholder=" Enjoy :) " required>
                    </div>
                    <button id="submitLogInButton" type="button" class="btn btn-success">Sig In</button>
                </form>
            </div>
        </div> 
    </div>