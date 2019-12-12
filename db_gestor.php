<?php


//ImportacióN conexióN Db y funciones
require('db_base.php');
//require('functions.php');



function select($sql_select) //VISTA default_trips_32
{
    $db = new DBconn;

    $db->sql = 'SELECT * FROM ' . $sql_select; // SELECT * FROM default_trips_2
    $db->select();
    $resultados = $db->rows;

    return $resultados;
   
}

