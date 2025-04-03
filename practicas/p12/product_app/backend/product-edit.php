<?php
require __DIR__ . '/../vendor/autoload.php';

    use TECWEB\MYAPI\Products;

    $productos = new Products('marketzone');
    $productos->edit( json_decode( json_encode($_POST) ) );
    echo $productos->getData();
?>