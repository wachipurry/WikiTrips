<?php
session_start();
$_SESSION['IP'] = getRealIP();
//Importación conexión DB y funciones
require('db_gestor.php');


if (isset($_GET['apiCode'])) { //Comprobar que POST['apiCode'] existe
    if (!empty($_GET['apiCode'])) { //Comprobar que el POST['apiCode'] no està vacio
        $code = htmlentities($_GET['apiCode']); //Sanear la entrada del POST['apiCode']

        //Si solo hay apiCode, solo hay estas opciones de SWITCH
        switch ($code) {
            case 101: // code 101 = ultimas entradas del HOME (featured_trips)
                lista_ultimos_trips(4);
                break;
            case 102: // code 102 = trips con mejor rating para HOME (featured_trips)
                lista_trips_por_rating(4);
                break;

            case 201: // code 201 = login
                if (isset($_GET['uId']) && isset($_GET['uId'])) { //Comprobar que POST['uId'] y POST['uPwd'] existe
                    if (!empty($_GET['uPwd']) && !empty($_GET['uPwd'])) { //Comprobar que el POST['uId'] y POST['uPwd'] no està vacio
                        $user = htmlentities($_GET['uId']); //Sanear la entrada del POST['uId']
                        $pwd = htmlentities($_GET['uPwd']); //Sanear la entrada del POST['uPwd']

                        if ($_SESSION['intentos'] < 3) {
                            if (comprobar_login($user, $pwd)) {
                                $_SESSION['username'] = $user;
                                $_SESSION['intentos'] = 0;
                            } else {
                                $_SESSION['intentos']++;
                            }
                        } else {
                            echo "MAXIMO de INTENTOS";
                        }
                    }
                } else {
                    echo "Invalid user request";
                }
                break;

                //default:
                //return 'Invalid request !!';
        }



        // Si tambien hay un tId
        if (isset($_GET['tId'])) { //Comprobar que POST['tId'] existe
            if (!empty($_GET['tId'])) { //Comprobar que el POST['tId'] no està vacio
                $id = htmlentities($_GET['tId']); //Sanear la entrada del POST['tId']
                switch ($code) {
                    case 103: // code 103 = lista con info detallada de un trip
                        info_detalle_1_trip($id);
                        break;
                    case 104: // code 104 = lista de categorias de un trip
                        categorias_1_trip($id);
                        break;
                    case 105: // code 105 = Valoración de un trip
                        rating_1_trip($id);
                        break;
                        //default:
                        //return 'Invalid request !!';
                }
            }
        } else {
            echo "Invalid tID request";
        }
    }
}



function getRealIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}



/**101
 * Experiencias Publicas ordenadas por fechas
 * @param Integer $num Tamaño máximo de la consulta
 * @return JSON_Object Array Keys = [ trip_id | trip_name | trip_resum | trip_thumb ]
 * */
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

function comprobar_login($nick, $pwd)
{
    $db = new DB("SELECT pwd FROM `user_login` WHERE user_nickname = '" . $nick . "'");
    $datos = $db->selectAll();
    if ($pwd === $datos[0]['pwd']) {
        return true;
    } else {
        return false;
    }
}
