<?php
require __DIR__ . '/../vendor/autoload.php';

    use TECWEB\MYAPI\Products;

    $productos = new Products('marketzone');
    $productos->search( $_GET['search'] );
    echo $productos->getData();
?>