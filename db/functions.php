<?php

/**
 * Función para validar datos de un registro de usuario
 * @param String Campos del formulario Sign In
 *  */
function validate_signIn($nickname, $firstname, $password, $email)
{
    $error = "";

    $error .= validate_empty($nickname, 'Nombre de usuario');
    $error .= validate_empty($firstname, 'Nombre');
    $error .= validate_empty($email, 'Dirección email');
    $error .= validate_empty($password, 'Contraseña');

    $error .= validate_email($email);
    $error .= validate_password($password);

    return $error;
}

function validate_edit_profile($nickname, $treatment, $firstname, $lastname, $description, $user_image, $email, $publicity)
{
    $error = "";

    $error .= validate_empty($treatment, 'Tratamiento');
    $error .= validate_empty($nickname, 'Nombre de usuario');
    $error .= validate_empty($firstname, 'Nombre');
    $error .= validate_empty($lastname, 'Apellido');

    $error .= validate_empty($email, 'Dirección email');
    $error .= validate_empty($publicity, 'Apeptar publicidad');

    $error .= validate_email($email);

    return $error;
}


/**
 * Función para validar que un campo del formulario no està vacio
 * @param mixed Campo que no puede estar vacio
 * @param String Nombre del campo que se mostrará en el mensaje de error
 * @return String error
 */
function validate_empty($field, $msg)
{
    $error = "";
    if (empty($field)) {
        $error .= '<li>El campo ' . $msg . ' no puede estar vacio</li>';
    }
    return $error;
}

/**
 * Función para validar un email
 * @param String email
 * @return String error
 */
function validate_email($email)
{
    $error = "";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<li>El mail introducido no és valido</li>";
    }
    return $error;
}

/**
 * Función para validar un password
 * @param String password
 * @return String error
 */
function validate_password($password)
{
    $error = "";
    if (strlen($password) < 6 || strlen($password) > 12) {
        $error .= "<li>La contraseña debe contener entre 6 y 12 caracteres</li>";
    }
    if (!preg_match("#[0-9]+#", $password)) {
        $error .= "<li>La contraseña debe contener un número</li>";
    }
    if (!preg_match("#[A-Z]+#", $password)) {
        $error .= "<li>La contraseña debe contener una letra mayúscula</li>";
    }
    if (!preg_match("#[a-z]+#", $password)) {
        $error .= "<li>La contraseña debe contener una letra minúscula</li>";
    }
    if (!preg_match('[@_!#$%^&*()<>?/\|}{~:]', $password)) {
        $error .= "<li>La contraseña debe contener un carácter especial</li>";
    }
    return $error;
}

/**
 * Función para cambiar un String a formato título
 * @param String palabra sin formato
 * @return String palabra formateada
 */
function string_to_title($string)
{;
    $string = strtolower($string);
    $string = ucfirst($string);
    return $string;
}

function validateDataEditProfile($nickname, $treatment, $firstname, $lastname, $description, $user_image, $email, $publicity)
{
}


function logged_return()
{

    $html_options = "";
    $db = new DB("SELECT cat_name FROM categories");
    $datos = $db->selectAll();
    foreach ($datos as $key => $value) {
        $html_options .= '<option>' . $value['cat_name'] . '</value>';
    }

    $html_logged = array(
        'html_textNav' => '
        <p class="text-seondary">Hola ' . $_SESSION['username'] . ' !' . '
        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#editProfileModal"> EDITAR PERFIL </button>
        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#addTripModal"> AÑADIR TRIP </button>
        <!-- PONGO EL BOTON, PERO NO HACE NADA POR AHORA -->
        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#logInModal" onclick="location.reload()"> SALIR </button>
    </p>
        ',
        'html_modalAddTrip' => '
        <!-- Creación del modal de prueba con todas las clases de boostrap para que se parezca -->
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
                                <input type="text" class="form-control" id="tripTitle" placeholder="Es un título, no escribas mas de 50 caracteres" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="tripResume">Resumen</label>
                                <textarea class="form-control" id="tripResume" rows="2" cols="50" placeholder="Escribe aqui una breve resumen de tu experiència (de 100 a 150 carácteres)"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tripDescription">Descricónion</label>
                                <textarea class="form-control" id="tripDescription" rows="5" cols="50" placeholder="Cuentanoslo todo !"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tripLocation">Ubicación</label>
                                <input type="text" class="form-control" id="tripLocation" placeholder="País, ciudad, ruta, ...">
                            </div>
                            <div class="form-group">
                                <label for="tripCategory">Categoria</label>
                                <select class="form-control" id="tripCategory">
                                '. $html_options .' 
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
                            <button id="cancelAddTripButton" type="button" class="btn btn-outline-danger text-secondary" data-dismiss="modal">CANCELAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        ',
        'html_modalEditProfile' => '
        <!-- Creación del modal de prueba con todas las clases de boostrap para que se parezca -->
        <div id="editProfileModal" class="editProfileModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="card-body modal-content">
                 <div id="modalEditProfileAlert" style="display: none;" role="alert">
                 </div>
                 <div class="modal-header">
                    <h5 class="modal-title text-warning">Ayudanos a saber un poco mas de ti !!</h5>
                 </div>
                 <form>
                    <div class="modal-body">
                       <!-- EL NOMBRE DE USUARIO NO PUEDE CANVIAR, HO PETA LA BASE DE DATOS -->
                       <div class="form-group">
                          <label for="nicknameEdit">Nickname</label>
                          <input type="text" class="form-control" id="nicknameEdit" placeholder="Pakito69" readonly>
                       </div>
                       <div class="form-group">
                          <label for="treatment">Como podemos dirigirnos a ti?</label>
                          <select class="form-control" id="treatment">
                             <option>Sr.</option>
                             <option>Sra.</option>
                             <option>No especificar</option>
                          </select>
                       </div>
                       <div class="form-group">
                          <label for="nameEdit">Nombre</label>
                          <input type="text" class="form-control" id="nameEdit" placeholder="Escribe aquí tu nombre autofocus">
                       </div>
                       <div class="form-group">
                          <label for="surnameEdit">Apellido</label>
                          <input type="text" class="form-control" id="surnameEdit" placeholder="Escribe aqui tu apellido">
                       </div>
                       <div class="form-group">
                          <label for="userDescriptionEdit">Cuentanos algo sobre ti</label>
                          <textarea type="text" class="form-control" rows="4" col="50" id="userDescriptionEdit" placeholder="una breve descripción de no mas de 500 carácteres seria suficiente"></textarea>
                       </div>
                       <div class="form-group">
                          <label for="newEmail">Nueva dirección email</label>
                          <input type="text" class="form-control" id="newEmail" placeholder="hola@wikitrips.cat">
                       </div>
                       <div class="form-group">
                          <label for="publicityEdit">Quieres que te avisemos de las últimas novedades en la web?</label>
                          <select class="form-control" id="publicityEdit">
                             <option>Si</option>
                             <option>No</option>
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
                    <div >
                       <button id="submitEditProfileButton" type="button" class="btn btn-block btn-outline-warning text-secondary">CONFIRMAR</button>
                       <button id="cancelEditProfileButton" type="button" class="btn btn-block btn-outline-danger text-secondary" data-dismiss="modal">CANCELAR</button>
                    </div>
                 </form>
              </div>
           </div>
        </div>
        ',
        'filter' => '

        <div class="col-md-3" style="width:100%">
                <label class="btn btn-block btn-dark">Filter by:</label>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-block btn-outline-dark" id="filterDate">Date</button>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-block btn-outline-dark" id="filterRate">Rate</button>
        </div>
        <div class="col-md-3">
            <!-- Petición ajax para cargarlas-->
            <select class="btn btn-block btn-outline-dark form-control" id="filterCategory">
            ' . $html_options . '
            </select>
        </div>
         ',
        'username' => $_SESSION['username'],
        'token' => session_id()
    );

    return $html_logged;
}
