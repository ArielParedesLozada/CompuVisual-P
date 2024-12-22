<?php
class LoginModel {
    private $conexion;

    public function __construct() {
        require_once('conexion.php');
        $con = new Conexion();
        $this->conexion = $con->conectar();
    }

    public function verificarCredenciales($nombre, $contrasenia) {
        $query = "SELECT * FROM usuarios WHERE NOM_USU = ? AND CON_USU = ?";
        $stmt = mysqli_prepare($this->conexion, $query);
        mysqli_stmt_bind_param($stmt, "ss", $nombre, $contrasenia);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            return [
                'nombre' => $row['NOM_USU'],
                'id' => $row['ID_USU'] ?? null
            ];
        }
        return false;
    }
}