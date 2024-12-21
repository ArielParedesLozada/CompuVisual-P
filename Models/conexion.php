<?php

use Dotenv\Dotenv;

require '../vendor/autoload.php';

class Conexion {
    public function conectar() {
        $dotenvPath = __DIR__ . '/..';
        if (!file_exists($dotenvPath . '/.env')) {
            echo "Archivo no encontrado";
            throw new Exception("El archivo .env no existe en $dotenvPath");
        }
        $dotenv = Dotenv::createImmutable($dotenvPath);
        $dotenv->load();
        $conexion = mysqli_connect($_ENV['DATABASE_HOST'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD'], $_ENV['DATABASE_NAME'], $_ENV['DATABASE_PORT']);
        if (!$conexion) {
            echo "Error de conexion ".mysqli_connect_error();
        } else {
            return $conexion;
        }
    }
}