<?php
class EnlacesPaginas{
    public static function enlacesPaginas($input) {
        if ($input=="nosotros" || $input=="servicios" || $input=="contactos") {
            $module = "Views/".$input.".php";
        } else {
            $module = "Views/inicio.php";            
        }
        return $module;
    }
}
?>