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
    if(!preg_match('/[\'!^£$%&*()}{@#~?><>,|=_+¬-]/', $password)){
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
{ }


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
            <p class="text-seconday"><span class="badge badge-secondary">101</span> Devuelve una lista de los ultimos 4 trips insertados (publicos)<br />
                <a href="api.php?apiCode=101">api.php?apiCode=101</a></p>
            <p class="text-seconday"><span class="badge badge-secondary">102</span> Devuelve una lista de los 4 trips con mejor valoración de usuarios (publicos)<br />
                <a href="api.php?apiCode=102">api.php?apiCode=102</a></p>

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
    /*    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $nickname)){
                $error .= "<li>The nickname must not have especials chard</li>";
            }
            if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name)){
                $error .= "<li>The name must not have especials chars</li>";
            }
            if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $surname)){
                $error .= "<li>The surnames must not have especials chars</li>";
            }
            if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $treatment)){
                $error .= "<li>The treatment must not have especials chars</li>";
            }
            if(!preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $email)){
                $error .= "<li>The email must not have especials chars</li>";
            }*/

}
