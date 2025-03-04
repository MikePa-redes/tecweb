<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();

    // SE VERIFICA HABER RECIBIDO EL TÉRMINO DE BÚSQUEDA
    if( isset($_POST['search']) ) { // 
        $search = $_POST['search'];

        $query = "SELECT * FROM productos WHERE id LIKE '%{$search}%'";
        
        if ( $result = $conexion->query($query) ) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row; 
            }

            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }

        $conexion->close();
    } 

    echo json_encode($data, JSON_PRETTY_PRINT);
?>
