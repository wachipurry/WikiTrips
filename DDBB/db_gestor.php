<?php


//ImportacióN conexión Db y funciones
require('db_base.php');
//require('functions.php');



/** POR LA MIERDA QUE HACE ESTE ARXHIVO (puente ara classe abstracte) PUEDE QUE ME
 * MONTE LA CONEXION CON PDO EN LUGAR DE MSQLI Y PASE DE CLASSES ABSTRACTAS */

function select($sql_select) //VISTA default_trips_32
{
    $db = new DBconn;


    $db->sql = 'SELECT * FROM ' . $sql_select; // SELECT * FROM default_trips_2
    $db->select();
    $resultados = $db->rows;

    return $resultados;
}
