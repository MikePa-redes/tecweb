<?php
    include_once __DIR__.'/database.php';

    // Arreglo de respuesta
    $data = array(
        'status'  => 'error',
        'message' => 'Faltan datos para actualizar el producto'
    );

    // Validar si se recibió el ID y los demás campos requeridos
    if (isset($_POST['id'], $_POST['nombre'], $_POST['marca'], $_POST['modelo'], $_POST['precio'], $_POST['unidades'])) {
        
        // Sanitizar los datos
        $id = (int) $_POST['id'];
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $marca = mysqli_real_escape_string($conexion, $_POST['marca']);
        $modelo = mysqli_real_escape_string($conexion, $_POST['modelo']);
        $precio = (float) $_POST['precio'];
        $detalles = isset($_POST['detalles']) ? mysqli_real_escape_string($conexion, $_POST['detalles']) : "";
        $unidades = (int) $_POST['unidades'];
        $imagen = isset($_POST['imagen']) && $_POST['imagen'] !== "" ? mysqli_real_escape_string($conexion, $_POST['imagen']) : "https://via.placeholder.com/150";

        // Query de actualización
        $sql = "UPDATE productos 
                SET nombre='$nombre', marca='$marca', modelo='$modelo', precio=$precio, 
                    detalles='$detalles', unidades=$unidades, imagen='$imagen' 
                WHERE id=$id";

        $conexion->set_charset("utf8");

        if ($conexion->query($sql)) {
            $data['status'] = "success";
            $data['message'] = "Producto actualizado correctamente";
        } else {
            $data['message'] = "ERROR: No se ejecutó la consulta: " . mysqli_error($conexion);
        }

        $conexion->close();
    } 

    // Devolver respuesta en JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>
