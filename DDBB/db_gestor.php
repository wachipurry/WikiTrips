<?php

require_once('db_base.php');

/**
 * Classe publica que gestiona las query con la base de datos
 * */

class DB extends DBconn
{
    
    /**
     * Constructor! Hay que pasarle la query SQL especifica a ejecutar
     */
    public function __construct($sql_constructor)
    {
        $this->sql = $sql_constructor;
    }


    public function selectAll() //VISTA default_trips_32
    {

        $this->execute_query($this->sql);
        $resultados = $this->rows;

        return $resultados;
    }
}
