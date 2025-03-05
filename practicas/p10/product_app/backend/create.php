<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');

    if (!empty($producto)) {
        // SE TRANSFORMA EL STRING JSON A OBJETO PHP
        $jsonOBJ = json_decode($producto, true);

        // SE VERIFICA QUE SE RECIBIERON TODOS LOS DATOS NECESARIOS
        if (
            isset($jsonOBJ['nombre'], $jsonOBJ['marca'], $jsonOBJ['modelo'], 
            $jsonOBJ['precio'], $jsonOBJ['unidades'], $jsonOBJ['detalles'])
        ) {
            $nombre   = trim($jsonOBJ['nombre']);
            $marca    = trim($jsonOBJ['marca']);
            $modelo   = trim($jsonOBJ['modelo']);
            $precio   = floatval($jsonOBJ['precio']);
            $unidades = intval($jsonOBJ['unidades']);
            $detalles = trim($jsonOBJ['detalles']);
            $imagen   = isset($jsonOBJ['imagen']) ? trim($jsonOBJ['imagen']) : "img/default_image.png";

            // VALIDACIÓN: EVITAR PRODUCTOS DUPLICADOS SI "eliminado = 0"
            $query_validacion = "SELECT COUNT(*) AS total FROM productos 
                                WHERE eliminado = 0 
                                AND ((nombre = '$nombre' AND marca = '$marca') OR (marca = '$marca' AND modelo = '$modelo'))";

            $result = $conexion->query($query_validacion);
            $row = $result->fetch_assoc();

            if ($row['total'] > 0) {
                echo '[SERVIDOR] El producto ya existe en la base de datos.';
            } else {
                // INSERTAR EL NUEVO PRODUCTO
                $query_insert = "INSERT INTO productos (nombre, marca, modelo, precio, unidades, detalles, imagen, eliminado) 
                                VALUES ('$nombre', '$marca', '$modelo', $precio, $unidades, '$detalles', '$imagen', 0)";

                if ($conexion->query($query_insert)) {
                    echo '[SERVIDOR] Producto insertado correctamente.';
                } else {
                    die('Query Error: ' . mysqli_error($conexion));
                }
            }

            $conexion->close();
        } else {
            echo '[SERVIDOR] Datos incompletos. Verifique los campos.';
        }
    } else {
        echo '[SERVIDOR] No se recibió información del producto.';
    }
?>
