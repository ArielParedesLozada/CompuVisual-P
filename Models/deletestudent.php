<?php
include_once('./conexion.php');
$conexion = new Conexion();
$con = $conexion->conectar();
$id = $_POST['cedula'];
$params = [
    $id
];
$query = "DELETE FROM estudiantes WHERE CED_EST = ?";
try {
    if ($con->execute_query($query, $params)) {
        $response = array(
            'success' => true,
            'message' => 'Objeto eliminado'

        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'No se encuentra el objeto'
            
        );
    }
    echo json_encode($response);    
} catch (\Throwable $th) {
    $response = array(
        'success' => false,
        'message' => 'Error interno. No se elimino',
        'error' => $th->getMessage()
    );
    echo json_encode($response);
}
?>