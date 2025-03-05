<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();

    function validarProducto($producto) {
        if (!isset($producto['nombre']) || strlen(trim($producto['nombre'])) === 0 || strlen($producto['nombre']) > 100) {
            return false;
        }

        if (!isset($producto['marca']) || strlen(trim($producto['marca'])) === 0) {
            return false;
        }

        if (!isset($producto['modelo']) || strlen(trim($producto['modelo'])) === 0 || strlen($producto['modelo']) > 25 || !preg_match('/^[A-Za-z0-9]+$/', $producto['modelo'])) {
            return false;
        }

        if (!isset($producto['precio']) || !is_numeric($producto['precio']) || floatval($producto['precio']) <= 99.99) {
            return false;
        }

        if (isset($producto['detalles']) && strlen(trim($producto['detalles'])) > 250) {
            return false;
        }

        if (!isset($producto['unidades']) || !is_numeric($producto['unidades']) || intval($producto['unidades']) < 0) {
            return false;
        }

        return true; 
    }

    if (isset($_POST['search'])) {
        $search = $_POST['search'];

        $query = "SELECT * FROM productos WHERE id LIKE '%{$search}%'";
        
        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch_assoc()) {
                // VALIDAR EL PRODUCTO ANTES DE AGREGARLO AL ARRAY DE RESPUESTA
                if (validarProducto($row)) {
                    $data[] = $row;
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion)); // 
        }

        $conexion->close();
    } 

    echo json_encode($data, JSON_PRETTY_PRINT);
?>
