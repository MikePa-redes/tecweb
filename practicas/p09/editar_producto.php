<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $precio = $_POST["precio"];
    $detalles = $_POST["detalles"];
    $unidades = $_POST["unidades"];
    $imagen = $_POST["imagen"];

    $link = new mysqli('localhost', 'root', 'elcaballerodelanoche27', 'marketzone');

    if ($link->connect_errno) {
        die('<p>Error de conexión: ' . htmlspecialchars($link->connect_error) . '</p>');
    }

    $stmt = $link->prepare("UPDATE productos SET nombre=?, marca=?, modelo=?, precio=?, detalles=?, unidades=?, imagen=? WHERE id=?");
    $stmt->bind_param("sssdsisi", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen, $id);

    if ($stmt->execute()) {
        echo "<p>Producto actualizado correctamente.</p>";
        echo '<a href="get_productos_vigentes_v2.php"> get_productos_vigentes_v2 </a>';
        echo '<br>'; 
        echo '<a href="get_productos_xhtml_v2.php" >get_productos_xhtml_v2 </a>';

    } else {
        echo "<p>Error al actualizar el producto: " . htmlspecialchars($stmt->error) . "</p>";
    }

    $stmt->close();
    $link->close();
}
?>
