<?php

  include('database.php');

if(isset($_POST['id'])) {
  $product_name = $_POST['name']; 
  $product_description = $_POST['description'];
  $id = $_POST['id'];
  $query = "UPDATE productos SET name = '$product_name', description = '$product_description' WHERE id = '$id'";
  $result = mysqli_query($connection, $query);

  if (!$result) {
    die('Query Failed.');
  }
  echo "Producto editado exitosamente";  

}

?>