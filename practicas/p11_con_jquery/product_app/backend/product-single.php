<?php

include('database.php');
$id = $_POST['id'];
$query = "SELECT * FROM productos WHERE id = {$id}";
$result = mysqli_query($conexion, $query);
if(!$result) {
  die('Query Failed'. mysqli_error($conexion));
}

$json = array();
while($row = mysqli_fetch_array($result)) {
  $json[] = array(
    'nombre' => $row['nombre'],
    'precio' => $row['precio'],
    'unidades' => $row['unidades'],
    'modelo' => $row['modelo'],
    'marca' => $row['marca'],
    'detalles' => $row['detalles'],
  );
}
$jsonstring = json_encode($json[0]);
echo $jsonstring;


?>