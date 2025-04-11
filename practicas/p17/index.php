<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require 'vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/tecweb/practicas/p17');

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hola Mundo Slim");
    return $response;
});

$app->get('/hola[/{nombre}]', function(Request $request, Response $response, $args) {
    $nombre = $args['nombre'] ?? 'Desconocido';
    $response->getBody()->write("Hola, " . $nombre);
    return $response;
});

$app->post('/pruebapost', function ($request, $response, $args) {
    $reqPost = $request->getParsedBody();

    $val1 = $reqPost['val1'] ?? 'No recibido';
    $val2 = $reqPost['val2'] ?? 'No recibido';

    $response->getBody()->write("Valores: $val1 - $val2");
    return $response;
});

$app->get('/testjson', function ($request, $response, $args) {
    $data = [
        [
            "nombre" => "Miguel",
            "apellidos" => "Paredes"
        ],
        [
            "nombre" => "Pedro",
            "apellidos" => "Perez Lopez"
        ]
    ];

    $response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->run();
?>
