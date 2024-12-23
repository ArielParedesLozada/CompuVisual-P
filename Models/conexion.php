<?php

use Dotenv\Dotenv;

// Definir la ruta base del proyecto
define('BASE_PATH', dirname(dirname(__FILE__)));

// Usar ruta absoluta para autoload.php
require BASE_PATH . '/vendor/autoload.php';

class Conexion {
    public function conectar() {
        try {
            $dotenv = Dotenv::createImmutable(BASE_PATH);
            $dotenv->load();
            
            $conexion = mysqli_connect(
                $_ENV['DATABASE_HOST'],
                $_ENV['DATABASE_USER'],
                $_ENV['DATABASE_PASSWORD'],
                $_ENV['DATABASE_NAME'],
                $_ENV['DATABASE_PORT']
            );
            
            if (!$conexion) {
                throw new Exception("Error de conexión: " . mysqli_connect_error());
            }
            
            return $conexion;
            
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
}