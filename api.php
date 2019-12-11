<?php

/**
 * @author Roger Calventus
 */

//Importació conexió BD i funcions
require('db_gestor.php');
require('functions.php');
//print_r($_GET);
//echo '<hr>' . $_GET['apiCode'] . 'hola';
//get_header_html('TEST WIKITRIPS');
//Comprovació dades del POST

if (isset($_GET['apiCode'])) {
    if (!empty($_GET['apiCode'])) {
        $code = htmlentities($_GET['apiCode']);
        echo '<hr>' . $code . '<hr>' . '<hr>';
        switch ($code) {
                // code 101 = ultimas entradas del home (featured_trips)
            case 101:
                listaHome();
                break;
                // code 102 = lista completa de experiencias
            case 102:
                listaTrips();
                break;
            default:
                return 'Invalid request !!';
        }
    }
}

function listaHome()
{
    //VISTA d DB debe tener -> 
    $datos = select("featured_trips_0");
    $pintar = json_encode($datos, true);
    echo '<hr>' . "var_dump de JSON" . var_dump($pintar) . '<hr>';

    print_r($pintar);
    return $pintar;
}

function listaTrips()
{
    $datos = select("alltrips");
    $pintar = json_encode($datos, true);
    echo '<hr>' . "var_dump de JSON" . var_dump($pintar) . '<hr>';
    print_r($pintar);


    return $pintar;
}
