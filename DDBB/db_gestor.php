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


    public function selectOne() //VISTA default_trips_32
    {

        $this->single_query($this->sql);
        if ($this->result == false) {
            return false;
        }

        $resultados = $this->rows;
        return $resultados;
    }

    public function selectAll() //VISTA default_trips_32
    {

        $this->execute_query($this->sql);
        $resultados = $this->rows;

        return $resultados;
    }

    public function insert($table, $conditions)
    {
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
        $this->sql = $sql;
        try {
            $this->insert_query($this->sql);
        } catch (Exception $e) {
            echo 'error insert hola123';
        }


        return $this->lastID;
        //echo $this->conn->insert_id;
        //echo 'id de usuario insertado = ' . $result;
    }

    public function update($table, $conditions, $where)
    {
        //Crear (concatenando) la query SQL
        $sql = "UPDATE " . $table . " SET ";

        $sql2 = "";
        foreach ($conditions as $key => $value) {
            $sql2 .= $key . " = " . $value . ", ";
        }
        $res = substr($sql2, 0, -2);
        $id_field = array_keys($where)[0];
        $sql .= $res . ') WHERE ' . $id_field . ' = ' . $where[$id_field];

        $this->sql = $sql;
        $this->update_query($this->sql);
        //Asignar la SQL generada al atributo de la conexion
        //$this->sql =$sql;
        //$this->insert_query($this->sql);
        //echo $sql;
        //return $this->lastID;
        //echo $this->conn->insert_id;
        //echo 'id de usuario insertado = ' . $result;
    }
}
