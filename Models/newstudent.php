<?php
include_once('./conexion.php');
$conexion = new Conexion();
$con = $conexion->conectar();
$ced = $_POST['cedula'];
$nom = $_POST['nombre'];
$ape = $_POST['apellido'];
$tlf = $_POST['telefono'];
$dir = $_POST['direccion']; 
$params = [
    $ced,
    $nom,
    $ape,
    $tlf,
    $dir
];
$query = "INSERT INTO estudiantes VALUES (?, ?, ?, ?, ?)";
try {
    if (($con->execute_query($query, $params))) {
        echo json_encode(
            [
                'success' => true,
                'message' => 'Se inserto el estudiante'
            ]
        );
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'No se inserto el estudiante'
            ]
        );
    }
} catch (\Throwable $th) {
    echo json_encode(
        [
            'success' => false,
            'message' => 'No se inserto el estudiante',
            'error' => $th->getMessage()
        ]
    );
}
?>