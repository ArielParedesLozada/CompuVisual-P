<?php
class Conexion {
    private $serverName = "localhost";
    private $userName = ""; //tu usuario
    private $password = ""; //la contraseña
    private $port = 0; //El puerto
    private $database = ""; //La base de datos

    public function conectar() {
        $conexion = mysqli_connect($this->serverName, $this->userName, $this->password, $this->database, $this->port);
        if (!$conexion) {
            echo "Error de conexion ".mysqli_connect_error();
        } else {
            return $conexion;
        }
    }

}


?>