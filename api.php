<?php
session_start();
$_SESSION['IP'] = getRealIP();
$_SESSION['intentos'] = 0;

//Importación conexión DB y funciones
require('DDBB/db_gestor.php');
include('functions.php');


/**
 * apiCode
 * 
 * 101 -> Lista de categorias
 * + resultTotal (LIMIT)
 * + resultPage (Paginacion)
 * + resultOrder (last, rate)
 * + resultWhere (author, category)
 * + resultCondition (nickname, category_name with underscore !!!)
 * 
 * Como por GET no puedo mandar en una URL por ahora las categorias hay que llamarlas con barrabaja y yo luego lo reemplazo
 * Supongo que luego por POST podré quitarlo, pero por ahora me tienen que mandar las categorias como "A_pie" o "Semana_Santa"
 * 
 * 102 -> Detalle de una experiencia
 * 103 -> lista de categorias de un trip
 * 
 * 201 Login
 * 202 Registro Usuario
 * 
 * 
 */


if (isset($_GET['apiCode'])) { //Comprobar que POST['apiCode'] existe
    if (!empty($_GET['apiCode'])) { //Comprobar que el POST['apiCode'] no està vacio
        $code = htmlentities($_GET['apiCode']); //Sanear la entrada del POST['apiCode']

        //Si solo hay apiCode, solo hay estas opciones de SWITCH
        switch ($code) {
            case 001:
                print_r(logged_return());
                break;

            case 101: // code 101 = Lista de experiencias
                if (isset($_GET['resultTotal']) && isset($_GET['resultPage']) && isset($_GET['resultOrder']) && isset($_GET['resultWhere']) && isset($_GET['resultCondition'])) { //Comprobar que POST['apiCode'] existe
                    if (!empty($_GET['resultTotal']) && !empty($_GET['resultPage']) && !empty($_GET['resultOrder']) && !empty($_GET['resultWhere']) && !empty($_GET['resultCondition'])) { //Comprobar que el POST['apiCode'] no està vacio
                        $resultTotal = htmlentities($_GET['resultTotal']); //Sanear la entrada del POST['resultTotal']
                        $resultPage = htmlentities($_GET['resultPage']); //Sanear la entrada del POST['resultPage']
                        $resultOrder = htmlentities($_GET['resultOrder']); //Sanear la entrada del POST['resultOrder']
                        $resultWhere = htmlentities($_GET['resultWhere']); //Sanear la entrada del POST['resultWhere']
                        $resultCondition = htmlentities($_GET['resultCondition']); //Sanear la entrada del POST['resultCondition']
                        listar_trips($resultTotal, $resultPage, $resultOrder, $resultWhere, $resultCondition);
                    } else {
                        echo "Sorry, I've recived some parameter empty";
                    }
                } else {
                    echo "Sorry, I've not recived all parameters";
                }
                break;

            case 102: // code 102 = Información detallada de un trip
                if (isset($_GET['tripId']) && isset($_GET['token']) && isset($_GET['username'])) { //Comprobar que POST existe
                    if (!empty($_GET['tripId']) && !empty($_GET['token']) && !empty($_GET['username'])) { //Comprobar que el POST no està vacio
                        $id = htmlentities($_GET['tripId']); //Sanear la entrada del POST['tripId]
                        $sessionId = htmlentities($_GET['token']); //Sanear la entrada del POST['tripId]
                        $username = htmlentities($_GET['username']); //Sanear la entrada del POST['tripId]

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

            case 103: // code 104 = lista de categorias de un trip
                if (isset($_GET['tripId'])) { //Comprobar que POST['tId'] existe
                    if (!empty($_GET['tripId'])) { //Comprobar que el POST['tId'] no està vacio
                        $id = htmlentities($_GET['tripId']); //Sanear la entrada del POST['tId']
                        categorias_por_trip($id);
                    }
                } else {
                    echo "Invalid user request";
                }
                break;

            case 200:
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
                if (isset($_GET['uId']) && isset($_GET['uId'])) { //Comprobar que POST['uId'] y POST['uPwd'] existe
                    if (!empty($_GET['uPwd']) && !empty($_GET['uPwd'])) { //Comprobar que el POST['uId'] y POST['uPwd'] no està vacio
                        $user = htmlentities($_GET['uId']); //Sanear la entrada del POST['uId']
                        $pwd = htmlentities($_GET['uPwd']); //Sanear la entrada del POST['uPwd']

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
                $nickname = htmlentities($_GET["nickname"]);
                $firstname = htmlentities($_GET["name"]);
                $lastname = htmlentities($_GET["surname"]);
                $password = htmlentities($_GET["password"]);
                $email = htmlentities($_GET["email"]);
                $treatment = htmlentities($_GET["treatment"]);
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
                $nickname = htmlentities($_GET["user_nickname"]);
                $treatment = htmlentities($_GET["user_treatment"]);
                $firstname = htmlentities($_GET["user_name"]);
                $lastname = htmlentities($_GET["user_surname"]);
                $description = htmlentities($_GET["user_description"]);
                $user_image = htmlentities($_GET["user_image"]);
                $email = htmlentities($_GET["user_email"]);
                $publicity = htmlentities($_GET["allow_add"]);
                //Validar datos y respuesta de error
                $error = validate_edit_profile($nickname, $treatment, $firstname, $lastname, $description, $user_image, $email, $publicity);
                if (!empty($error) && $error != "") {
                    echo $error;
                } else { // SI TODO CORRECTO HACER UPDATE
                    editar_usuario($nickname, $treatment, $firstname, $lastname, $description, $user_image, $email, $publicity);
                }
                break;

            default:
                return 'Invalid request !!';
        }
    } else { //De lo contrario --> POST['apiCode'] està vacio
        form_api();
    }
} else { //De lo contrario --> POST['apiCode'] no existe
    form_api();
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
            $resultCondition = str_replace("_", " ", $resultCondition);
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
    //$keys = array_keys($datos[0]);
    //print_r($keys);
    //echo '<hr>';
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
        //$db->die();
        $db = new DB("SELECT * from trip_details WHERE trip_id = " . $id . " GROUP BY trip_id");
        $datos = $db->selectOne();
    }
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
    //print_r($categorias);
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

    ///api.php?apiCode=203&user_nickname=marccc&user_treatment=treat&user_name=name&user_surname=sur&user_email=email@email.com&allow_add=yes&user_description=description&user_image=JPG
    $db = new DB("SELECT user_id FROM `users` WHERE user_nickname = '" . $nickname . "'");
    $id = $db->selectAll();
    $condition = $id[0];


    $sets = array('treatment' => "'" . $treatment . "'", 'firstname' => "'" . $firstname . "'", 'lastname' => "'" . $lastname . "'", 'img_profile' => "'" . $user_image . "'", 'descr' => "'" . $description . "'", 'email' => "'" . $email . "'", 'email' => "'" . $email . "'", 'opt_in' => "'" . $publicity . "'");
    $db1 = new DB("");
    $db1->update('user_details', $sets, $condition);
}

function añadir_experiencia($nickname, $name, $surname, $password, $email, $treatment)
{
}





function getRealIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}
