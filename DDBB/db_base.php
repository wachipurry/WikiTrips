<?php

// Esta classe deberia ser abstracta
class DBconn
{

    // Estas variables deberian ser PROTECTED
    static $db_servername = "labs.iam.cat";
    static $db_username = "a19rogcalrul_ajr";
    static $db_password = "ajr2019wt";
    static $db_name = "a19rogcalrul_wikitrips";

    // Estas variables deberian ser PRIVATE
    public $rows;
    public $sql;
    public $conn;

    // METODO PARA CREAR CONEXION
    public function conn_open()
    {
        $this->conn = new mysqli(self::$db_servername, self::$db_username, self::$db_password, self::$db_name);

        //MIRAR SI CHARSET NO ES UTF-8
        if (!$this->conn->set_charset("utf8")) {
            echo "error en set CHARSET";
        }
        
        /* ESTO SE QUEDA AQUI POR SI NOS VUELVE A DAR PROBLEMAS EL CHARSET CUANDO SALGAMOS DE PRODUCCION
        if (TRUE !== $this->conn->query('SET collation_connection = @@collation_database;')) {
            echo "error set collation@@";
        }
        */

        if ($this->conn->connect_errno) { //Si error. mensage + die/exit
            echo "Error: Fallo al conectarse a MySQL debido a: \n";
            echo "Errno: " . $this->conn->connect_errno . "\n";
            echo "Error: " . $this->conn->connect_error . "\n";
            die;
        }
    }

    // METODO PARA CERRAR CONEXION
    public function conn_close()
    {
        $this->conn->close();
    }

    // METODO PARA HACER UNA CONSULTA SELECT
    function select()
    {

        $this->conn_open();
        if (!$resultado = $this->conn->query($this->sql)) {

            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $this->sql . "\n";
            echo "Errno: " . $this->conn->errno . "\n";
            echo "Error: " . $this->conn->error . "\n";
            die;
        }

        if ($resultado->num_rows === 0) {
            echo 'La consulta ' .  $this->sql . ' no ha devuelto ningun resultado';
            die;
        } else if ($resultado->num_rows > 0) {

            for ($i = 0; $i < $resultado->num_rows; $i++) {
                $this->rows[$i] = $resultado->fetch_assoc();
            }
        }
        $this->conn_close();
    }

    
    /**
     * 
     * TODO LO QUE HAY A PARTIR DE AQUI ESTA PENDIENTE DE IMPLEMENTAR
     * CONSIGAMOS PRIMERO QUE FUNCIONEN LOS SELECT Y LUEGO YA PASAREMOS A LOS INSERT, UPDATE o DELETE
     * 
     *  */

    function insert()
    {
        $this->conn_open();
        if (!$resultado = $this->conn->query($this->sql)) {

            echo "Error: La ejecución de la consulta falló debido a: \n";
            echo "Query: " . $this->sql . "\n";
            echo "Errno: " . $this->conn->errno . "\n";
            echo "Error: " . $this->conn->error . "\n";
            die;
        } else {
            echo $this->conn->insert_id;
        }
        $this->conn_close();
    }


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
