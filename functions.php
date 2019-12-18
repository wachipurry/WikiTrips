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
        $error .= "<li>The password must be between 6 and 12 chars</li>";
    }
    if (!preg_match("#[0-9]+#", $password)) {
        $error .= "<li>The password must have one number</li>";
    }
    if (!preg_match("#[A-Z]+#", $password)) {
        $error .= "<li>The password must have minimun one capital letter</li>";
    }
    if (!preg_match("#[a-z]+#", $password)) {
        $error .= "<li>The password must have minimun one small letter</li>";
    }
    if (preg_match('[@_!#$%^&*()<>?/\|}{~:]', $password)) {
        $error .= "<li>The password must have minimun one special character</li>";
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


function form_api()
{
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wikitrips</title>
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!-- Awesome font icons stylesheet-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            h5 {
                border-bottom: 1px solid #17a2b8;
                padding: 30px 0px 5px 0px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h5 class="text-info">manual API de WikiTrips</h5>
            <p class="text-secondary">Faucibus turpis in eu mi bibendum neque. Laoreet non curabitur gravida arcu ac tortor dignissim convallis aenean. Risus in hendrerit gravida rutrum quisque non tellus orci ac. Nunc id cursus metus aliquam eleifend mi in nulla posuere. Fames ac turpis egestas integer. Interdum velit euismod in pellentesque massa placerat duis ultricies. Imperdiet nulla malesuada pellentesque elit eget. Risus in hendrerit gravida rutrum. Pretium viverra suspendisse potenti nullam ac tortor vitae purus faucibus. Quis risus sed vulputate odio ut enim. Est ullamcorper eget nulla facilisi etiam dignissim diam quis. Neque volutpat ac tincidunt vitae semper quis lectus nulla.</p>

            <!--101-->
            <p class="text-seconday"><span class="badge badge-secondary">101</span> Devuelve una lista de trips</p>
            <ul class="alert alert-secondary">
                <li>apiCode=101</li>
                <li>resultTotal -> Un numero (cantidad que se desea recibir) o 'all? para todos</li>
                <li>resultPage -> La página de la consulta (para paginación) (no puede ser 0, minimo 1) <span class="text-info">[no implementado]</span></li>
                <li>resultOrder -> Para especificar el orden ('last' para ultimos primero) ('rate' para mejor valorados primero)</li>
                <li>resultWhere -> Selector de campo (where ...) ('author' para solo un autor) ('category' para solo una categoria)</li>
                <li>resultCondition -> Condición que debe cumplir el where</li>
            </ul>
            <p class="alert alert-info">
                Ej. Ultimos 4 trips ordenados por fecha -> resultTotal=4 & resultPage=1 & resultOrder=<b>last</b> & resultWhere=none & resultCondition=none<br />
                <a href="api.php?apiCode=101&resultTotal=4&resultPage=1&resultOrder=last&resultWhere=none&resultCondition=none" target="_blank">api.php?apiCode=101&resultTotal=4&resultPage=1&resultOrder=last&resultWhere=none&resultCondition=no</a>
            </p>
            <p class="alert alert-info">
                Ej. ultimos 4 trips ordenados por valoracion -> resultTotal=4 & resultPage=1 & resultOrder=<b>rate</b> & resultWhere=none & resultCondition=none<br />
                <a href="api.php?apiCode=101&resultTotal=4&resultPage=1&resultOrder=rate&resultWhere=none&resultCondition=none" target="_blank">api.php?apiCode=101&resultTotal=4&resultPage=1&resultOrder=rate&resultWhere=none&resultCondition=no</a>
            </p>

            <p class="alert alert-info">
                Ej. Todos los trips del autor "capitan" por fecha -> resultTotal=<b>all</b> & resultPage=1 & resultOrder=last & resultWhere=author & resultCondition=capitan<br />
                <a href="api.php?apiCode=101&resultTotal=all&resultPage=1&resultOrder=last&resultWhere=author&resultCondition=capitan" target="_blank">api.php?apiCode=101&resultTotal=all&resultPage=1&resultOrder=last&resultWhere=capitan&resultCondition=capitan</a>
            </p>
            <p class="alert alert-info">
                Ej. Todos los trips de la categoria "A pie" por valoracion -> resultTotal=<b>all</b> & resultPage=1 & resultOrder=rate & resultWhere=category & resultCondition=A_pie<br />
                <a href="api.php?apiCode=101&resultTotal=all&resultPage=1&resultOrder=rate&resultWhere=category&resultCondition=A_pie" target="_blank">api.php?apiCode=101&resultTotal=all&resultPage=1&resultOrder=rate&resultWhere=category&resultCondition=A_pie</a>
            </p>

            <p class="text-seconday"><span class="badge badge-secondary">102</span> Devuelve una lista de los 4 trips con mejor valoración de usuarios (publicos)<br />
                <a href="api.php?apiCode=102">api.php?apiCode=102</a>
            </p>
            <!--102-->
            <p class="text-seconday"><span class="badge badge-secondary">103</span> Devuelve el contenido detallado de un trip (requiere de un id)<br />
                <a href="api.php?apiCode=103&tId=3">api.php?apiCode=103&tId=3</a></p>
            <p class="text-seconday"><span class="badge badge-secondary">104</span> Devuelve una String con la lista de categorias de un trip (requiere de un id)<br />
                <a href="api.php?apiCode=104&tId=3">api.php?apiCode=104&tId=3</a></p>
            <p class="text-seconday"><span class="badge badge-secondary">105</span> Devuelve la valoracón [avg(rate)] de un trip especifio(requiere de un id)<br />
                <a href="api.php?apiCode=105&tId=3">api.php?apiCode=105&tId=3</a></p>

            <p class="text-seconday"><span class="badge badge-info">201</span> Comprobar el password de un usuario dado su nickname</p>
            <p class="text-seconday"><span class="badge badge-info">202</span> Registrar (SignIn) un usuario</p>
            <p class="text-seconday"><span class="badge badge-info">203</span> Editar perfil de un usuario<br />
                <a href="api.php?apiCode=203&user_nickname=marccc&user_treatment=treat&user_name=name&user_surname=sur&user_email=email@email.com&allow_add=yes&user_description=description&user_image=JPG">api.php?apiCode=203&user_nickname=marccc&user_treatment=treat&user_name=name&user_surname=sur&user_email=email@email.com&allow_add=yes&user_description=description&user_image=JPG</a></p>
            <p class="text-seconday"><span class="badge badge-success">301</span> Añadir una experiencia</p>
            <p class="text-seconday"><span class="badge badge-success">302</span> Editar una experiencia</p>
            <p class="text-seconday"><span class="badge badge-success">303</span> Votar una experiencia</p>

            <p class="text-seconday"><span class="badge badge-warning">401</span> Reportar una experiencia</p>
            <p class="text-seconday"><span class="badge badge-warning">402</span> Reportar una usuario</p>


        </div>

    </body>

    </html>
<?php
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
        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#editProfileModal"> EDIAR PERFIL </button>
        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#addTripModal"> AÑADIR TRIP </button>
        <!-- PONGO EL BOTON, PERO NO HACE NADA POR AHORA -->
        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#logInModal"> SALIR </button>
    </p>
        ',
        'html_modalAddTrip' => '
        <!-- Creación del modal de prueba con todas las clases de boostrap para que se parezca -->
        <div id="addTripModal" class="addTripModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="card-body modal-content">
                    <h2>Add trip</h2>
        
                    <div id="modalAddTripAlert" style="display: none;" role="alert">
        
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title text-warning">Comparte con el mundo tus Trips !!</h5>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tripTitle">Título</label>
                                <input type="text" class="form-control" id="tripTitle" placeholder="es un título, no escribas mas de 50 caracteres ;)">
                            </div>
                            <div class="form-group">
                                <label for="tripResume">Resumen</label>
                                <textarea class="form-control" id="tripResume" rows="2" cols="50" placeholder="escribe aqui una breve resumen de tu experiència (de 100 a 150 carácteres)"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tripDescription">Descricónion</label>
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
        ',
        'html_modalEditProfile' => '
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
        
                            <!-- EL NOMBRE DE USUARIO NO PUEDE CANVIAR, HO PETA LA BASE DE DATOS -->
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
                                <input type="text" class="form-control" id="nameEdit" placeholder="escribe aquí tu nombre">
                            </div>
                            <div class="form-group">
                                <label for="surnameEdit">Apellido</label>
                                <input type="text" class="form-control" id="surnameEdit" placeholder="escribe aqui tu apellido">
                            </div>
                            <div class="form-group">
                                <label for="userDescriptionEdit">Cuentanos algo sobre ti</label>
                                <textarea type="text" class="form-control" rows="4" id="userDescriptionEdit" placeholder="una breve descirpcón de no mas de 500 carácteres será suficiente ;)"></textarea>
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
