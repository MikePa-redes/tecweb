<?php
include('database.php');

header('Content-Type: application/json'); // Especificar tipo de respuesta JSON

// Obtener los datos enviados desde AJAX
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'], $data['nombre'], $data['precio'], $data['unidades'], $data['modelo'], $data['marca'], $data['detalles'])) {
    $id = mysqli_real_escape_string($conexion, $data['id']);
    $nombre = mysqli_real_escape_string($conexion, $data['nombre']);
    $precio = floatval($data['precio']);
    $unidades = intval($data['unidades']);
    $modelo = mysqli_real_escape_string($conexion, $data['modelo']);
    $marca = mysqli_real_escape_string($conexion, $data['marca']);
    $detalles = mysqli_real_escape_string($conexion, $data['detalles']);

    // Consulta SQL para actualizar el producto
    $query = "UPDATE productos 
              SET nombre = '$nombre', precio = $precio, unidades = $unidades, modelo = '$modelo', marca = '$marca', detalles = '$detalles' 
              WHERE id = '$id'";

    if (mysqli_query($conexion, $query)) {
        $response = ["status" => "success", "message" => "Producto actualizado correctamente"];
    } else {
        $response = ["status" => "error", "message" => "Error al actualizar: " . mysqli_error($conexion)];
    }
} else {
    $response = ["status" => "error", "message" => "Datos incompletos"];
}

// Cerrar conexión y enviar respuesta JSON
mysqli_close($conexion);
echo json_encode($response, JSON_PRETTY_PRINT);
exit();
