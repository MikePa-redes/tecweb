<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>
<body>
    <p>
        <a href="https://validator.w3.org/markup/check?uri=referer">
            <img src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" />
        </a>
    </p>
    <h3>Lista de Productos con Unidades &le; <?php echo htmlspecialchars($_GET['tope'] ?? ''); ?></h3>
    
    <?php
    if (isset($_GET['tope']) && is_numeric($_GET['tope'])) {
        $tope = intval($_GET['tope']);

        $link = mysqli_connect('localhost', 'root', 'elcaballerodelanoche27', 'marketzone');

        if ($link === false) {
            die('<p>Error de conexión: ' . htmlspecialchars(mysqli_connect_error()) . '</p>');
        }

        $sql = "SELECT * FROM productos WHERE eliminado = 0 AND unidades <= $tope";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Precio</th>
                            <th>Unidades</th>
                            <th>Detalles</th>
                            <th>Imagen</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>' . htmlspecialchars($row['id']) . '</td>
                        <td>' . htmlspecialchars($row['nombre']) . '</td>
                        <td>' . htmlspecialchars($row['marca']) . '</td>
                        <td>' . htmlspecialchars($row['modelo']) . '</td>
                        <td>' . htmlspecialchars($row['precio']) . '</td>
                        <td>' . htmlspecialchars($row['unidades']) . '</td>
                        <td>' . htmlspecialchars($row['detalles']) . '</td>
                        <td><img src="' . htmlspecialchars($row['imagen']) . '" width="100" alt="Imagen del producto" /></td>
                        <td>
                            <a href="formulario_productos_v2.html?id=' . $row['id'] . '&nombre=' . urlencode($row['nombre']) . '&marca=' . urlencode($row['marca']) . '&modelo=' . urlencode($row['modelo']) . '&precio=' . $row['precio'] . '&unidades=' . $row['unidades'] . '&detalles=' . urlencode($row['detalles']) . '&imagen=' . urlencode($row['imagen']) . '" class="btn btn-warning">Editar</a>
                        </td>
                      </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p>No hay productos con unidades menores o iguales a ' . htmlspecialchars($tope) . '.</p>';
        }

        mysqli_close($link);
    } else {
        echo '<p>Error: Parámetro "tope" no válido o no proporcionado.</p>';
    }
    ?>
</body>
</html>
