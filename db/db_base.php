<?php

/**
 * Clase Abstracta con datos protegidos de la conexion a Base de Datos
 */
abstract class DBconn
{

    // Variables estaticas de conexión
    private static $db_servername = "localhost";
    private static $db_username = "a19rogcalrul_ajr";
    private static $db_password = "ajr2019wt";
    private static $db_name = "a19rogcalrul_wikitrips";

    /*
    private static $db_servername = "labs.iam.cat";
    private static $db_username = "a19rogcalrul_ajr";
    private static $db_password = "ajr2019wt";
    private static $db_name = "a19rogcalrul_wikitrips";
    */
    // Variables de entorno
    protected $rows;
    protected $result;
    protected $lastID;
    protected $sql;
    protected $conn;

    // METODO PARA CREAR CONEXION
    private function conn_open()
    {
        $this->conn = new mysqli(self::$db_servername, self::$db_username, self::$db_password, self::$db_name);
        //Si hay error, mensage + die/exit
        if ($this->conn->connect_errno) {
            echo "Error: Fallo al conectarse a MySQL debido a: \n";
            echo "Errno: " . $this->conn->connect_errno . "\n";
            echo "Error: " . $this->conn->connect_error . "\n";
            die;
        }

        //MIRAR SI CHARSET NO ES UTF-8
        if (!$this->conn->set_charset("utf8")) {
            echo "error en set CHARSET";
        }

        /*
        ESTO SE QUEDA AQUI POR SI NOS VUELVE A DAR PROBLEMAS EL CHARSET CUANDO SALGAMOS DE PRODUCCION
        if (TRUE !== $this->conn->query('SET collation_connection = @@collation_database;')) {
            echo "error set collation@@";
        }
        */
    }

    // METODO PARA CERRAR CONEXION
    private function conn_close()
    {
        $this->conn->close();
    }

    abstract protected function selectOne();
    abstract protected function selectAll();
    abstract protected function insert($table, $conditions);
    abstract protected function update($table, $conditions, $id);


    // METODO PARA HACER UNA CONSULTA SIMPLE QUE ESPERA UNA UNICA RESPUESTA
    protected function single_query()
    {
        $this->conn_open();
        //Si hay error, mensage + die/exit
        if (!$resultado = $this->conn->query($this->sql)) {
            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $this->sql . "\n";
            echo "Errno: " . $this->conn->errno . "\n";
            echo "Error: " . $this->conn->error . "\n";
            die;
        }

        //Si la respuesta devuelve 0 filas
        if ($resultado->num_rows === 0) {
            $this->result = false;

            //Si hay respuesta, pasar la info a $rows
        } else if ($resultado->num_rows === 1) {
            $this->result = true;
            $this->rows[0] = $resultado->fetch_assoc();
        }
        $this->conn_close();
    }

    // METODO PARA HACER UNA CONSULTA SELECT
    protected function execute_query()
    {
        $this->conn_open();
        //Si hay error, mensage + die/exit
        if (!$resultado = $this->conn->query($this->sql)) {
            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $this->sql . "\n";
            echo "Errno: " . $this->conn->errno . "\n";
            echo "Error: " . $this->conn->error . "\n";
            die;
        }

        //Si la respuesta devuelve 0 filas
        if ($resultado->num_rows === 0) {
            echo 'La consulta SQL' . $this->sql . ' no ha devuelto ningun resultado';
            die;
            //Si hay respuesta, pasar la info a $rows
        } else if ($resultado->num_rows > 0) {

            for ($i = 0; $i < $resultado->num_rows; $i++) {
                $this->rows[$i] = $resultado->fetch_assoc();
            }
        }
        $this->conn_close();
    }

    // METODO PARA HACER UN INSERT
    function insert_query()
    {
        $this->conn_open();
        if (!$resultado = $this->conn->query($this->sql)) {

            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $this->sql . "\n";
            echo "Errno: " . $this->conn->errno . "\n";
            echo "Error: " . $this->conn->error . "\n";
            die;
        } else {
            $this->lastID = $this->conn->insert_id;
        }
        $this->conn_close();
    }

    function update_query()
    {
        $this->conn_open();
        if (!$resultado = $this->conn->query($this->sql)) {

            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $this->sql . "\n";
            echo "Errno: " . $this->conn->errno . "\n";
            echo "Error: " . $this->conn->error . "\n";
            die;
        } else {
            echo "UPDATE SUCCES!!";
            //$this->lastID = $this->conn->insert_id;
        }
        $this->conn_close();
    }
}

/**
 * TODO LO QUE HAY A PARTIR DE AQUI ESTA PENDIENTE DE IMPLEMENTAR
 * CONSIGAMOS PRIMERO QUE FUNCIONEN LOS SELECT Y LUEGO YA PASAREMOS A LOS INSERT, UPDATE o DELETE
 *  */


/*
    function delete()
    {
        $this->conn_open();
        if (!$resultado = $this->conn->query($this->sql)) {

            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $this->sql . "\n";
            echo "Errno: " . $this->conn->errno . "\n";
            echo "Error: " . $this->conn->error . "\n";
            die;
        } else {
            echo "DELETED SUCCES!!";
            //echo $this->conn->insert_id;
        }
        $this->conn_close();
    }
}
*/
