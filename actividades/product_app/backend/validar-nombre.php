<?php
include_once __DIR__.'/database.php';

$response = array('status' => 'available');

if (isset($_POST['nombre'])) {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    error_log("Nombre recibido: " . $nombre); // Verifica que el nombre se recibe correctamente

    $sql = "SELECT id FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
    $result = $conexion->query($sql);

    if ($result) {
        error_log("Filas encontradas: " . $result->num_rows); // Verifica si hay resultados en la BD
        if ($result->num_rows > 0) {
            $response['status'] = 'exists';
        }
        $result->free();
    } else {
        error_log("Error en la consulta SQL: " . $conexion->error); // Verifica errores en la consulta
    }
}

$conexion->close();
echo json_encode($response);
?>