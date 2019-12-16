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

    public function insert($table, $conditions){
        //Crear (concatenando) la query SQL
        $sql = "INSERT INTO " . $table . "(";
        $fields_num = count(array_keys($conditions));
        for ($i = 0; $i < ($fields_num - 1); $i++) {
            $sql .= array_keys($conditions)[$i] . ", ";
        }
        $sql .= array_keys($conditions)[$fields_num - 1] . ') VALUES (';
        $sql2 = "";
        foreach ($conditions as $key => $value) {
            $sql2 .= $value . ", ";
        }
        $res = substr($sql2, 0, -2);
        $sql .= $res . ')';

        //Asignar la SQL generada al atributo de la conexion
        $this->sql =$sql;
        $this->insert_query($this->sql);

        return $this->lastID;
        //echo $this->conn->insert_id;
        

        //echo 'id de usuario insertado = ' . $result;


    }
}
