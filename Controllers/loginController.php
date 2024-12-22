<?php
require_once 'Models/loginmodel.php';

class AuthController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new LoginModel();
    }

    public function login($nombre, $contrasenia) {
        $usuario = $this->usuarioModel->verificarCredenciales($nombre, $contrasenia);
        if ($usuario) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['loggedin'] = true;
            header('Location: index.php?action=servicios');
            exit();
        } else {
            $_SESSION['error'] = "Credenciales incorrectas.";
            header('Location: views/login.php');
            exit();
        }
    }
}