<?php
require __DIR__ . '/../vendor/autoload.php';

    use TECWEB\MYAPI\Products as Products;

    $productos = new Products('marketzone');
    $productos->list();
    echo $productos->getData();
?>