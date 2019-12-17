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
 * 103 -> lista 10 experiencias detalladas for fecha
 * 103 -> igual anterior por ratio
 * 105 -> igual anterior por categorias
 * 
 * 
 * 
 */


if (isset($_GET['apiCode'])) { //Comprobar que POST['apiCode'] existe
    if (!empty($_GET['apiCode'])) { //Comprobar que el POST['apiCode'] no està vacio
        $code = htmlentities($_GET['apiCode']); //Sanear la entrada del POST['apiCode']

        //Si solo hay apiCode, solo hay estas opciones de SWITCH
        switch ($code) {
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

                //lista_ultimos_trips($resultType, $resultTotal, $resultPack, $resultOder, $resultCondition);
                break;
                /*
            case 102: // code 103 = lista con info detallada de un trip
                if (isset($_GET['tId'])) { //Comprobar que POST['tId'] existe
                    if (!empty($_GET['tId'])) { //Comprobar que el POST['tId'] no està vacio
                        $id = htmlentities($_GET['tId']); //Sanear la entrada del POST['tId']
                        info_detalle_1_trip($id);
                    } else {
                        echo "Sorry, tId is empty";
                    }
                } else {
                    echo "Sorry, I've not recived tId";
                }
                break;

            case 104: // code 104 = lista de categorias de un trip
                if (isset($_GET['tId'])) { //Comprobar que POST['tId'] existe
                    if (!empty($_GET['tId'])) { //Comprobar que el POST['tId'] no està vacio
                        $id = htmlentities($_GET['tId']); //Sanear la entrada del POST['tId']
                        categorias_1_trip($id);
                    }
                } else {
                    echo "Invalid user request";
                }
                break;
            case 105: // code 105 = Valoración de un trip

                if (isset($_GET['tId'])) { //Comprobar que POST['tId'] existe
                    if (!empty($_GET['tId'])) { //Comprobar que el POST['tId'] no està vacio
                        $id = htmlentities($_GET['tId']); //Sanear la entrada del POST['tId']
                        rating_1_trip($id);
                    }
                } else {
                    echo "Invalid user request";
                }
                break;

*/
            case 201: // code 201 = login
                if (isset($_GET['uId']) && isset($_GET['uId'])) { //Comprobar que POST['uId'] y POST['uPwd'] existe
                    if (!empty($_GET['uPwd']) && !empty($_GET['uPwd'])) { //Comprobar que el POST['uId'] y POST['uPwd'] no està vacio
                        $user = htmlentities($_GET['uId']); //Sanear la entrada del POST['uId']
                        $pwd = htmlentities($_GET['uPwd']); //Sanear la entrada del POST['uPwd']

                        if ($_SESSION['intentos'] < 3) {
                            if (comprobar_login($user, $pwd)) {
                                $_SESSION['username'] = $user;
                                $_SESSION['intentos'] = 0;
                                //INCLUIR HTML PAGINA INICIO USUARIO LOGEADO
                                echo 'true';
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
/*
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


                //default:
                //return 'Invalid request !!';
                */
        }
    } else { //De lo contrario --> POST['apiCode'] està vacio
        form_api();
    }
} else { //De lo contrario --> POST['apiCode'] no existe
    form_api();
}



function getRealIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}


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
            echo "Sorry, I've not understood your resultCondition";
        }
    } else {
        echo "Sorry, I've not understood your resultTotal";
    }
}
function total_trips($sql)
{
    $db = new DB($sql);
    $datos = $db->selectAll();
    return $datos;
}
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


/**101
 * Experiencias Publicas ordenadas por fechas
 * @param Integer $num Tamaño máximo de la consulta
 * @return JSON_Object Array Keys = [ trip_id | trip_name | trip_resum | trip_thumb ]
 * */

/*
function lista_ultimos_trips($num)
{

    $db = new DB('SELECT * from featured_trips_0 LIMIT ' . $num);
    $datos = $db->selectAll();
    //$keys = array_keys($datos[0]);
    //print_r($keys);
    //echo '<hr>';
    $pintar = json_encode($datos);
    echo $pintar;
}

/**102
 * Experiencias Publicas ordenadas por votos
 * @param Integer $num Tamaño máximo de la consulta
 * @return JSON_Object Array Keys = [ trip_id | trip_name | trip_thumb | trip_rate ]
 * */

 /*
function lista_trips_por_rating($num)
{
    $db = new DB('SELECT * from featured_trips_1 LIMIT ' . $num);
    $datos = $db->selectAll();
    //$keys = array_keys($datos[0]);
    //print_r($keys);
    //echo '<hr>';;
    $pintar = json_encode($datos);
    echo $pintar;
}

/**103
 * Información complets de una experincia para vista
 * @param Integer $id Numero ID de la experiencia
 * @return JSON_Object Array Keys = [ trip_id | trip_name | trip_text | trip_author | trip_Date | trip_location | trip_img | trip_alt ]
 * */
function info_detalle_1_trip($id)
{
    // trip_details -> info JOIN de trips
    $db = new DB('SELECT * from trip_details WHERE trip_id = ' . $id);
    $datos = $db->selectAll();

    //Lo intento pero no me sale
    //Estaria bien desde aqui llamar a categorias_1_trip()
    //y añadir el resultado como otro campo en $datos
    //...Y lo mismo con el rating

    $pintar = json_encode($datos);
    echo $pintar;
}

/**104
 * Categorias de una experincia
 * @param Integer $id Numero ID de la experiencia
 * @return Array Categorias en forma de array
 * */
function categorias_1_trip($id)
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

/**105
 * Valoracion media de una experincia
 * @param Integer $id Numero ID de la experiencia
 * @return Integer Valoracion media
 * */
function rating_1_trip($id)
{
    $db = new DB('SELECT trip_rate FROM trip_rating WHERE trip_id = ' . $id);
    $datos = $db->selectAll();
    echo $datos[0]['trip_rate'];
}


/**
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
