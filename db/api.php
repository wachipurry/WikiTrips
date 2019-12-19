<?php
session_start();
$_SESSION['IP'] = getRealIP();
$_SESSION['intentos'] = 0;

//Importación conexión DB y funciones
require('db_gestor.php');
include('functions.php');
if (isset($_POST['readme'])) {
    if (!empty($_POST['readme'])) {
        $readme = htmlentities($_POST['readme']);
        if ($readme === 'demo') {
            include('../apiDoc.php');
        }
    }
}

/**
 * Primero de todo, comprobar que llega un apiCode para con un SWITCH redirigir la consulta API
 * @param apiCode Que debe estar en el POST
 */
if (isset($_POST['apiCode'])) { //Comprobar que POST['apiCode'] existe
    if (!empty($_POST['apiCode'])) { //Comprobar que el POST['apiCode'] no està vacio
        $code = htmlentities($_POST['apiCode']); //Sanear la entrada del POST['apiCode']

        //Si solo hay apiCode, solo hay estas opciones de SWITCH
        switch ($code) {

            case 001: // Code 001
                // Asi evitamos los default y los mensages de error del switxh
                break;

            case 002: // Code 002 = comprobar que hay una session creada
                print_r(logged_return());
                break;


            case 101: // code 101 = Lista de experiencias
                if (isset($_POST['resultTotal']) && isset($_POST['resultPage']) && isset($_POST['resultOrder']) && isset($_POST['resultWhere']) && isset($_POST['resultCondition'])) { //Comprobar que POST['apiCode'] existe
                    if (!empty($_POST['resultTotal']) && !empty($_POST['resultPage']) && !empty($_POST['resultOrder']) && !empty($_POST['resultWhere']) && !empty($_POST['resultCondition'])) { //Comprobar que el POST['apiCode'] no està vacio
                        $resultTotal = htmlentities($_POST['resultTotal']); //Sanear la entrada del POST['resultTotal']
                        $resultPage = htmlentities($_POST['resultPage']); //Sanear la entrada del POST['resultPage']
                        $resultOrder = htmlentities($_POST['resultOrder']); //Sanear la entrada del POST['resultOrder']
                        $resultWhere = htmlentities($_POST['resultWhere']); //Sanear la entrada del POST['resultWhere']
                        $resultCondition = htmlentities($_POST['resultCondition']); //Sanear la entrada del POST['resultCondition']
                        listar_trips($resultTotal, $resultPage, $resultOrder, $resultWhere, $resultCondition);
                    } else {
                        echo "Sorry, I've recived some parameter empty";
                    }
                } else {
                    echo "Sorry, I've not recived all parameters";
                }
                break;

            case 102: // code 102 = Información detallada de un trip
                if (isset($_POST['tripId']) && isset($_POST['token']) && isset($_POST['username'])) { //Comprobar que POST existe
                    if (!empty($_POST['tripId']) && !empty($_POST['token']) && !empty($_POST['username'])) { //Comprobar que el POST no està vacio
                        $id = htmlentities($_POST['tripId']); //Sanear la entrada del POST['tripId]
                        $sessionId = htmlentities($_POST['token']); //Sanear la entrada del POST['tripId]
                        $username = htmlentities($_POST['username']); //Sanear la entrada del POST['tripId]

                        //Si el ID de session y el nombre de usuario son los mismos recividos
                        if (($sessionId == session_id()) && ($username == $_SESSION['username'])) {
                            consulta_102($id, $username);
                        }
                    } else {
                        echo "Sorry, Some parameters are empty";
                    }
                } else {
                    echo "Sorry, I've missed some parameter";
                }
                break;

            case 103: // code 103 = lista de categorias de un trip
                if (isset($_POST['tripId'])) { //Comprobar que POST['tId'] existe
                    if (!empty($_POST['tripId'])) { //Comprobar que el POST['tId'] no està vacio
                        $id = htmlentities($_POST['tripId']); //Sanear la entrada del POST['tId']
                        categorias_por_trip($id);
                    }
                } else {
                    echo "Invalid user request";
                }
                break;

            case 200: // 200 = NO USADO, Era comprobar que existe una session al entrar a la página
                if (isset($_SESSION['username'])) { //Comprobar que POST['uId'] y POST['uPwd'] existe
                    if (!empty($_SESSION['username'])) {
                        $html_logged = logged_return();
                        //Encode y retorno de JSON
                        $pintar = json_encode($html_logged);
                        echo $pintar;
                    }
                } else {
                    echo false;
                }


            case 201: // code 201 = login
                if (isset($_POST['uId']) && isset($_POST['uId'])) { //Comprobar que POST['uId'] y POST['uPwd'] existe
                    if (!empty($_POST['uPwd']) && !empty($_POST['uPwd'])) { //Comprobar que el POST['uId'] y POST['uPwd'] no està vacio
                        $user = htmlentities($_POST['uId']); //Sanear la entrada del POST['uId']
                        $pwd = htmlentities($_POST['uPwd']); //Sanear la entrada del POST['uPwd']

                        if ($_SESSION['intentos'] < 3) {
                            if (comprobar_login($user, $pwd)) {
                                $_SESSION['username'] = $user;
                                $_SESSION['intentos'] = 0;
                                //Preparar array de datos para AJAX
                                $html_logged = logged_return();
                                //Encode y retorno de JSON
                                $pintar = json_encode($html_logged);
                                echo $pintar;
                            } else {
                                $_SESSION['intentos']++;
                                echo 'false';
                            }
                        } else {
                            echo "MAXIMO de INTENTOS";
                        }
                    }
                } else {
                    echo "Invalid user request";
                }
                break;

            case 202: // code 202 = registro de usuario
                $nickname = htmlentities($_POST["nickname"]);
                $firstname = htmlentities($_POST["name"]);
                $lastname = htmlentities($_POST["surname"]);
                $password = htmlentities($_POST["password"]);
                $email = htmlentities($_POST["email"]);
                $treatment = htmlentities($_POST["treatment"]);
                //Validar datos y respuesta de error
                $error = validate_signIn($nickname, $firstname, $password, $email);

                if (!empty($error) && $error != "") {
                    echo $error;
                } else { // SI TODO CORRECTO HACER INSERT
                    $firsname = string_to_title($firstname);
                    $lastname = string_to_title($lastname);
                    insertar_usuario($nickname, $firstname, $lastname, $password, $email, $treatment);
                }
                break;

            case 203: // apiCode 203 = Editar perfil de usuario
                $nickname = htmlentities($_POST["user_nickname"]);
                $treatment = htmlentities($_POST["user_treatment"]);
                $firstname = htmlentities($_POST["user_name"]);
                $lastname = htmlentities($_POST["user_surname"]);
                $description = htmlentities($_POST["user_description"]);
                $user_image = htmlentities($_POST["user_image"]);
                $email = htmlentities($_POST["user_email"]);
                $publicity = htmlentities($_POST["allow_add"]);
                //Validar datos y respuesta de error
                $error = validate_edit_profile($nickname, $treatment, $firstname, $lastname, $description, $user_image, $email, $publicity);
                if (!empty($error) && $error != "") {
                    echo $error;
                } else { // SI TODO CORRECTO HACER UPDATE
                    editar_usuario($nickname, $treatment, $firstname, $lastname, $description, $user_image, $email, $publicity);
                }
                break;

            case 301: //apiCode = Añadir Trip
                $token = htmlentities($_POST["token"]);
                if (session_id() == $token) {
                    $username = htmlentities($_POST["username"]);
                    $title = htmlentities($_POST["title"]);
                    $resum = htmlentities($_POST["resume"]);
                    $description = htmlentities($_POST["description"]);
                    $category = htmlentities($_POST["category"]);
                    insertar_experiencia($username, $title, $resum, $description, $category);
                } else {
                    echo 'Invalid token';
                }
                break;
            default:
                return 'Invalid request !!';
        }
    } else { //De lo contrario --> POST['apiCode'] està vacio
        echo 'Your code to run this API is empty';
    }
} else { //De lo contrario --> POST['apiCode'] no existe
    echo 'Call me with a code or fuck you';
}


/**
 * Funcion para el tratamiento de los parametros del 101
 */
function listar_trips($resultTotal, $resultPage, $resultOrder, $resultWhere, $resultCondition)
{
    if ($resultTotal != "all") { // Si el total no es TODOS
        if ($resultOrder == "last") { // Si se elige ordenar por LAST
            //Ejecutar consulta SQL RESUMIDA + LIMITE + ORDER BY LAST

            $sql = "SELECT * FROM trips_featured ORDER BY trip_id DESC LIMIT " . $resultTotal;
            consulta_101($sql);
        } else if ($resultOrder == "rate") { // Si se elige ordenar por LAST
            //Ejecutar consulta SQL RESUMIDA + LIMITE + ORDER BY RATE
            $sql = "SELECT * FROM trips_featured ORDER BY trip_rate DESC LIMIT " . $resultTotal;
            consulta_101($sql);
        } else { //Por defecto
            echo "Sorry, I've not understood your resultOrder";
        }
    } else if ($resultTotal == "all") { // Si el total es TODOS
        if ($resultWhere == "author") {
            if ($resultOrder == "last") { // Si se elige ordenar por LAST
                //Ejecutar consulta SQL RESUMIDA + TODAS + WHERE + ORDER BY LAST + PACK
                $sql = "SELECT * FROM trips_published WHERE trip_author = '" . $resultCondition . "' ORDER BY trip_id DESC";
                consulta_101($sql);

                /* PAGINACION NO IMPLEMENTADA
                $sql = "SELECT count(*) AS total_trips FROM trips_list";
                $numTrips = total_trips($sql)[0]['total_trips'];
                echo $numTrips;
                */
            } else if ($resultOrder == "rate") { // Si se elige ordenar por RATE
                //Ejecutar consulta SQL RESUMIDA + TODAS + WHERE + ORDER BY RATE + PACK
                $sql = "SELECT * FROM trips_published WHERE trip_author = '" . $resultCondition . "' ORDER BY trip_rate DESC";
                consulta_101($sql);
            } else {
                echo "Sorry, I've not understood your resultOrder";
            }
        } else if ($resultWhere == "category") {
            //$resultCondition = str_replace("_", " ", $resultCondition); //ESTO ERA PARA CUANDO TIRABAMOS CON GET
            if ($resultOrder == "last") { // Si se elige ordenar por LAST
                //Ejecutar consulta SQL RESUMIDA + TODAS + WHERE + ORDER BY LAST + PACK
                $sql = "SELECT * FROM trips_category WHERE trip_category = '" . $resultCondition . "' ORDER BY trip_id DESC";
                consulta_101($sql);
            } else if ($resultOrder == "rate") { // Si se elige ordenar por RATE
                //Ejecutar consulta SQL RESUMIDA + TODAS + WHERE + ORDER BY RATE + PACK
                $sql = "SELECT * FROM trips_category WHERE trip_category = '" . $resultCondition . "' ORDER BY trip_rate DESC";
                consulta_101($sql);
            } else {
                echo "Sorry, I've not understood your resultOrder";
            }
        } else {
            if ($resultOrder == "last") { // Si se elige ordenar por LAST
                $sql = "SELECT * FROM trips_published ORDER BY trip_id DESC";
                consulta_101($sql);
            } else if ($resultOrder == "rate") { // Si se elige ordenar por RATE
                $sql = "SELECT * FROM trips_published ORDER BY trip_rate DESC";
                consulta_101($sql);
            } else {
                echo "Sorry, I've not understood your resultOrder";
            }
        }
    } else {
        echo "Sorry, I've not understood your resultTotal";
    }
}

//Esta funci{on estaba para lo de la paginación -> descartado por falta de tiempo
function total_trips($sql)
{
    $db = new DB($sql);
    $datos = $db->selectAll();
    return $datos;
}

function filtro_categorias()
{
    $db = new DB("SELECT cat_name FROM categories");
    $datos = $db->selectAll();
    print_r($datos);
}

/**101
 * Experiencias Publicas ordenadas por fechas
 * @param Integer $num Tamaño máximo de la consulta
 * @return JSON_Object Array Keys = [ trip_id | trip_name | trip_resum | trip_thumb ]
 * */
function consulta_101($sql)
{
    $db = new DB($sql);
    $datos = $db->selectAll();
    $pintar = json_encode($datos);
    echo $pintar;
}

/**102
 * Información complets de una experincia para vista
 * @param Integer $id Numero ID de la experiencia
 * @return JSON_Object Array Keys = [ trip_id | trip_name | trip_text | trip_author | trip_Date | trip_location | trip_img | trip_alt ]
 * */
function consulta_102($id, $username)
{
    // trip_details -> info JOIN de trips
    $db = new DB("SELECT * from trip_details WHERE trip_id = " . $id . " AND rate_user = " . "'" . $username . "'");
    $datos = $db->selectOne();
    if ($datos == false) {

        $db = new DB("SELECT * from trip_details WHERE trip_id = " . $id . " GROUP BY trip_id");
        $datos = $db->selectOne();
    }
    $pintar = json_encode($datos);
    echo $pintar;
}

/**105
 * Información complets de una experincia para vista
 * @param Integer $id Numero ID de la experiencia
 * @return JSON_Object Array Keys = [ trip_id | trip_name | trip_text | trip_author | trip_Date | trip_location | trip_img | trip_alt ]
 * */
function consulta_105()
{
    $db = new DB("SELECT cat_name from categories");
    $datos = $db->selectAll();
    print_r($datos);
    $pintar = json_encode($datos);
    echo $pintar;
}

/**103
 * Categorias de una experincia
 * @param Integer $id Numero ID de la experiencia
 * @return Array Categorias en forma de array
 * */
function categorias_por_trip($id)
{
    $db = new DB('SELECT category FROM trip_categories WHERE trip_id = ' . $id);
    $datos = $db->selectAll();
    $categorias = array();
    for ($i = 0; $i < count($datos); $i++) {
        array_push($categorias, $datos[$i]['category']);
    }
    $categorias = implode(', ', $categorias);
    echo $categorias;
}


/**201
 * user_login -> Comprueba un password segun id_user
 * @return  (true || false)
 * */
function comprobar_login($nickname, $pwd)
{
    $db = new DB("SELECT pwd FROM `user_login` WHERE user_nickname = '" . $nickname . "'");
    $datos = $db->selectAll();
    if ($pwd === $datos[0]['pwd']) {
        return true;
    } else {
        return false;
    }
}

function insertar_usuario($nickname, $name, $surname, $password, $email, $treatment)
{
    $conditions1 = array('alias' => "'" . $nickname . "'", 'id_status' => 1);
    $db1 = new DB("");
    $newId = $db1->insert('user_details', $conditions1);

    $conditions2 = array('id_user' => $newId, 'firstname' => "'" . $name . "'", 'lastname' => "'" . $surname . "'", 'email' => "'" . $email . "'", 'treatment' => "'" . $treatment . "'");
    $db2 = new DB("");
    $db2->insert('user_profile', $conditions2);

    $conditions3 = array('id_user' => $newId, 'pass' => "'" . $password . "'");
    $db2 = new DB("");
    $db2->insert('pass', $conditions3);
}

function editar_usuario($nickname, $treatment, $firstname, $lastname, $description, $user_image, $email, $publicity)
{

    $db = new DB("SELECT user_id FROM `users` WHERE user_nickname = '" . $nickname . "'");
    $id = $db->selectAll();
    $condition = $id[0];


    $sets = array('treatment' => "'" . $treatment . "'", 'firstname' => "'" . $firstname . "'", 'lastname' => "'" . $lastname . "'", 'img_profile' => "'" . $user_image . "'", 'descr' => "'" . $description . "'", 'email' => "'" . $email . "'", 'email' => "'" . $email . "'", 'opt_in' => "'" . $publicity . "'");
    $db1 = new DB("");
    $db1->update('user_details', $sets, $condition);
}

function insertar_experiencia($username, $title, $resum, $description, $category)
{
    // Recuperar el ID de la cartegoria
    $db = new DB("SELECT id_cat FROM `categories` WHERE cat_name = '" . $category . "'");
    $id = $db->selectOne();
    $id_category = $id[0]['id_cat'];

    // Recuperar el ID del usuario
    $db = new DB("SELECT id_user FROM `user_details` WHERE alias = '" . $username . "'");
    $id = $db->selectOne();
    $id_user = $id[0]['id_user'];

    // Insertar el trip --> IMPORTANTE RECUPERAR EL ID DEL INSERT
    $conditions = array('id_user' => $id_user, 'id_status' => 2, 'title' => "'" . $title . "'", 'summary' => "'" . $resum . "'", 'description' => "'" . $description . "'");
    $db = new DB("");
    $newId = $db->insert('trips', $conditions);

    // Añadir la categoria con el ultimo ID para foreign key
    $conditions = array('id_trip' => $newId, 'id_cat' => $id_category);
    $db = new DB("");
    $db->insert('trips_cat', $conditions);

    // Añadir un voto (falso) con el ultimo ID (usuario admin) ya que si un trip no tiene votos, no sale en la vista de trips publicados
    $fake_rate = random_int(1, 5);
    $conditions = array('id_trip' => $newId, 'id_user' => 1, 'rate' => $fake_rate);
    $db = new DB("");
    $db->insert('ratings', $conditions);

    // Añadir dats de las fotos con el ultimo ID para foreign key (NO SE USA PERO ES NECESSARIO para las foreign keys)
    $conditions = array('id_trip' => $newId, 'img_url_thumb' => "'foto01.jpg'", 'img_url_high' => "'foto01.jpg'", 'img_alt' => "'pie de foto'");
    $db = new DB("");
    $db->insert('media', $conditions);

    echo 'true';
}


function getRealIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}
