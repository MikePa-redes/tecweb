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

$imagen = 'img/imagen.png';

/** Crear una tabla que no devuelve un conjunto de resultados */
$sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
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
