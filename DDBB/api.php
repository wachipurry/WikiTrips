<?php

//Importación conexión DB y funciones
require('db_gestor.php');


if (isset($_GET['apiCode'])) { //Comprobar que POST['apiCode] existe
    if (!empty($_GET['apiCode'])) { //Comprobar que el POST['apiCode] no està vacio
        $code = htmlentities($_GET['apiCode']); //Sanear la entrada del POST['apiCode]

        //Iniciamos SWITCH -> segun que apiCode sea el recibido, realizamos una u otra consulta a la BBDD
        switch ($code) {

            case 101: // code 101 = ultimas entradas del home (featured_trips)
                listaHome();
                break;

            case 102: // code 102 = lista completa de experiencias
                listaTrips();
                break;
            default:
                return 'Invalid request !!';
        }
    }
}


/**
 * AQUI DEBEN ESTAR LAS FUNCIONES DE CADA SWITCH
 * 
 * LO ESCRIBIRÉ POCO A POCO YA QUE DEBO ASEGURARME DE QUE COINCIDE CON LAS VISTA
 * QUE QUEREMOS OBTENER DE CADA CASO. -> DEBO PLANTEAR QUE INFO SE REQUIERE EN CADA CONSULTA
 * 
 * JAVI y ALEXEY !!!
 * DE ALGUNA FORMA (Drive, Git, un Readme.txt...) HAY QUE HACER UNA LISTA DE LOS DATOS QUE SE QUIEREN
 * OBTENERE PARA CADA CONSULTA, QUE QUEREMOS QUE SALGA EN LA PANTALLA DE INCIO, QUE CAMPOS EN LA VISTA DETALLADA...
 * 
 * */

function listaHome()
{
    $datos = select("trips");
    $pintar = json_encode($datos);
    echo $pintar;
}

function listaTrips()
{
    $datos = select("featured_trips_2");
    $pintar = json_encode($datos);
    echo $pintar;
}
