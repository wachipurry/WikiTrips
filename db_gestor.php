<?php

/**
 * @author Roger Calventus
 */

//Importació conexió BD i funcions
require('db_base.php');
//require('functions.php');



function select($sql_select) //VISTA default_trips_32
{
    $db = new DBconn;

    $db->sql = 'SELECT * FROM ' . $sql_select; // SELECT * FROM default_trips_32
    $db->select();
    $resultados = $db->rows;

    return json_encode($resultados);
   
}

