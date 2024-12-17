<?php
class MVCController 
{
    public function template() {
        include_once('Views/template.php');
    }
    
    public function enlacesPaginas() {
        require_once('Models/model.php');
        if (isset($_GET['action'])) {
            $enlace = $_GET['action'];
        } else {
            $enlace = "inicio.php";
        }
        $respuesta = EnlacesPaginas::enlacesPaginas($enlace);
        include($respuesta);
    }
}

