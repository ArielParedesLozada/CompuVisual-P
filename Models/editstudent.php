<?php
include_once('./conexion.php');
$conexion = new Conexion();
$con = $conexion->conectar();
$id = $_GET['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$params = [
    $nombre,
    $apellido,
    $telefono,
    $direccion,
    $id
];
$query = "UPDATE estudiantes SET NOM_EST= ?, APE_EST = ?, TLF_EST = ?, DIR_EST = ? WHERE CED_EST=?";
try {
    if ($con->execute_query($query, $params)) {
        echo json_encode([
            'success' => true,
            'message' => 'Estudiante editado'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Estudiante no editado'
        ]);
    }
} catch (\Throwable $th) {
    echo json_encode([
        'success' => false,
        'message' => 'Estudiante editado',
        'error' => 'Error: '.$th->getMessage()
    ]);
}