<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = $_POST['nombre'] ?? '';
    $marca    = $_POST['marca'] ?? '';
    $modelo   = $_POST['modelo'] ?? '';
    $precio   = $_POST['precio'] ?? 0;
    $detalles = $_POST['detalles'] ?? '';
    $unidades = $_POST['unidades'] ?? 0;

    @$link = new mysqli('localhost', 'root', 'elcaballerodelanoche27', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

$sql_check = "SELECT id FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
    
if ($stmt_check = $link->prepare($sql_check)) {
    // Enlazar parámetros
    $stmt_check->bind_param("sss", $nombre, $marca, $modelo);
    $stmt_check->execute();
    $stmt_check->bind_result($id);
    
    // Si encuentra un producto, significa que ya existe
    if ($stmt_check->fetch()) {
        echo "Error: El producto ya existe en la base de datos.";
        $stmt_check->close();
        $link->close();
        exit();
    }
    $stmt_check->close();
}
$imagen = 'img/imagen.png';


/** Crear una tabla que no devuelve un conjunto de resultados */
$sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)  VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
if ( $link->query($sql) ) 
{
    echo 'Producto insertado con ID: '.$link->insert_id;
}
else
{
	echo 'El Producto no pudo ser insertado =(';
}

$link->close();

} else {
    echo "Método de solicitud no permitido.";
}
?>
