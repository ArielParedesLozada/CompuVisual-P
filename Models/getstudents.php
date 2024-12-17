<?php
include_once('./conexion.php');
$conexion = new Conexion();
$con = $conexion->conectar();
$query = "SELECT * FROM estudiantes";
$result = $con->execute_query($query);
$response = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        array_push($response, $row);
    }
} else {
    $response = json_encode([
        'success' => false,
        'message' => 'Error al cargar los datos',
        'error' => 'Error 404'
    ]);
}
echo json_encode($response);
?>