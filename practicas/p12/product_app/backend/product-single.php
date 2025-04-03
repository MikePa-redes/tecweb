<?php
require __DIR__ . '/../vendor/autoload.php';

    use TECWEB\MYAPI\Products;

    $productos = new Products('marketzone');
    $productos->single( $_POST['id'] );
    echo $productos->getData();
?>