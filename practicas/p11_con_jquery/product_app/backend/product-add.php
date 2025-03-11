<?php
include_once __DIR__.'/database.php';

// Obtener datos JSON enviados
$producto = file_get_contents('php://input');
$data = array(
    'status'  => 'error',
    'message' => 'Ya existe un producto con ese nombre'
);

if (!empty($producto)) {
    $jsonOBJ = json_decode($producto);

    // Evitar errores si la imagen no está en el JSON
    $imagen = isset($jsonOBJ->imagen) ? mysqli_real_escape_string($conexion, $jsonOBJ->imagen) : "";

    // Validar si ya existe
    $sql = "SELECT * FROM productos 
        WHERE (nombre = '{$jsonOBJ->nombre}' 
        AND modelo = '{$jsonOBJ->modelo}') 
        AND eliminado = 0";

    $result = $conexion->query($sql);

    if ($result->num_rows == 0) {
        $conexion->set_charset("utf8");
        $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', 
                {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$imagen}', 0)";
        
        if ($conexion->query($sql)) {
            $data = array(
                'status'  => 'success',
                'message' => 'Producto agregado'
            );
        } else {
            $data['message'] = "ERROR: No se ejecutó la consulta. " . mysqli_error($conexion);
        }
    }

    $result->free();
    $conexion->close();
}

// Enviar respuesta JSON válida sin espacios en blanco extra
header('Content-Type: application/json');
echo json_encode($data);
exit; 
