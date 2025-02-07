<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang=“es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Variables de php</title>
</head>
<body>
<h2>Ejercicio 1: </h2>
<p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7.</p>
<?php  
    require_once __DIR__ . '/src/funciones.php';

    if(isset($_GET['numero'])){
        multiplo_5y7($_GET['numero']);
    }
?>
<h2>Ejercicio 2: </h2>
<p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
secuencia compuesta por: impar, par, impar</p>
<?php  
    require_once __DIR__ . '/src/funciones.php';

    echo numeros_aleatorios();

?>
<h2>Ejercicio 3: </h2>
<p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
pero que además sea múltiplo de un número dado.</p>
<?php  
    require_once __DIR__ . '/src/funciones.php';

    if(isset($_GET['multiplo'])){
        numero_aleatorio_multiplo($_GET['multiplo']);
    }
?>
<h2>Ejercicio 4: </h2>
<p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
a la ‘z’.</p>
<?php  
    $arreglo = [];
    for ($i = 97; $i <= 122; $i++) {
        $arreglo[$i] = chr($i);
    }

    echo "<table border='1'>";
    echo "<tr><th>Índice ASCII</th><th>Letra</th></tr>";

    foreach ($arreglo as $key => $value) {
        echo "<tr><td>$key</td><td>$value</td></tr>";
    }

    echo "</table>";
?>
<h2>Ejercicio 5: </h2>
<p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de
sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de
bienvenida apropiado.</p>
<br>
<form action="http://localhost/tecweb/practicas/p06/index.php" method="post">
        Edad: <input type="text" name="edad"><br>
        Sexo: <input type="text" name="sexo"><br>
        <input type="submit">
    </form>
    <br>

<?php
   if(isset($_POST["edad"]) && isset($_POST["sexo"]))
   {
       if ($_POST["edad"] >= 18 && $_POST["edad"] <= 35 && $_POST["sexo"] == "femenino") {
           echo '<h3>Bienvenida, usted está en el rango de edad permitido.</h3>';
       } else {
           echo '<h3>Rango de edad o sexo incorrecto.</h3>';
       }
   }
?>

<h2>Ejercicio 6: </h2>
<p>Crea en código duro un arreglo asociativo que sirva para registrar el parque vehicular de
una ciudad.</p>

<?php
$array = [
    "ABC1234" => [
        "Auto" => [
            "marca" => "Toyota",
            "modelo" => 2022,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Juan Pérez",
            "ciudad" => "Ciudad de México",
            "direccion" => "Av. Reforma 123"
        ]
    ],
    "XYZ5678" => [
        "Auto" => [
            "marca" => "Honda",
            "modelo" => 2021,
            "tipo" => "hatchback"
        ],
        "Propietario" => [
            "nombre" => "María López",
            "ciudad" => "Guadalajara",
            "direccion" => "Calle Juárez 456"
        ]
    ],
    "LMN9876" => [
        "Auto" => [
            "marca" => "Ford",
            "modelo" => 2020,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Carlos Ramírez",
            "ciudad" => "Monterrey",
            "direccion" => "Blvd. Constitución 789"
        ]
    ],
    "DEF2468" => [
        "Auto" => [
            "marca" => "Mazda",
            "modelo" => 2019,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Laura Gómez",
            "ciudad" => "Puebla",
            "direccion" => "Calle 5 de Mayo 321"
        ]
    ],
    "GHI1357" => [
        "Auto" => [
            "marca" => "Chevrolet",
            "modelo" => 2018,
            "tipo" => "hatchback"
        ],
        "Propietario" => [
            "nombre" => "Roberto Sánchez",
            "ciudad" => "Tijuana",
            "direccion" => "Av. Revolución 654"
        ]
    ],
    "JKL8642" => [
        "Auto" => [
            "marca" => "Nissan",
            "modelo" => 2022,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Fernanda Torres",
            "ciudad" => "León",
            "direccion" => "Calle Insurgentes 789"
        ]
    ],
    "MNO7531" => [
        "Auto" => [
            "marca" => "Volkswagen",
            "modelo" => 2021,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Jorge Herrera",
            "ciudad" => "Mérida",
            "direccion" => "Av. Montejo 234"
        ]
    ],
    "PQR1593" => [
        "Auto" => [
            "marca" => "BMW",
            "modelo" => 2020,
            "tipo" => "hatchback"
        ],
        "Propietario" => [
            "nombre" => "Sofía Medina",
            "ciudad" => "Querétaro",
            "direccion" => "Blvd. Bernardo Quintana 987"
        ]
    ],
    "STU4826" => [
        "Auto" => [
            "marca" => "Audi",
            "modelo" => 2019,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Daniel Vargas",
            "ciudad" => "Toluca",
            "direccion" => "Calle Morelos 876"
        ]
    ],
    "VWX2048" => [
        "Auto" => [
            "marca" => "Kia",
            "modelo" => 2018,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Elena Rodríguez",
            "ciudad" => "Chihuahua",
            "direccion" => "Av. Universidad 543"
        ]
    ],
    "YZA3875" => [
        "Auto" => [
            "marca" => "Hyundai",
            "modelo" => 2022,
            "tipo" => "hatchback"
        ],
        "Propietario" => [
            "nombre" => "Ricardo Montes",
            "ciudad" => "San Luis Potosí",
            "direccion" => "Calle Hidalgo 432"
        ]
    ],
    "BCD6294" => [
        "Auto" => [
            "marca" => "Peugeot",
            "modelo" => 2021,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Gabriela Suárez",
            "ciudad" => "Cancún",
            "direccion" => "Av. Bonampak 210"
        ]
    ],
    "EFG7382" => [
        "Auto" => [
            "marca" => "Mercedes-Benz",
            "modelo" => 2020,
            "tipo" => "sedan"
        ],
        "Propietario" => [
            "nombre" => "Alejandro Castro",
            "ciudad" => "Culiacán",
            "direccion" => "Calle Obregón 765"
        ]
    ],
    "HIJ8392" => [
        "Auto" => [
            "marca" => "Tesla",
            "modelo" => 2019,
            "tipo" => "hatchback"
        ],
        "Propietario" => [
            "nombre" => "Paula Fernández",
            "ciudad" => "Aguascalientes",
            "direccion" => "Blvd. Colosio 987"
        ]
    ],
    "KLM9405" => [
        "Auto" => [
            "marca" => "Subaru",
            "modelo" => 2018,
            "tipo" => "camioneta"
        ],
        "Propietario" => [
            "nombre" => "Hugo Ortega",
            "ciudad" => "Veracruz",
            "direccion" => "Calle Independencia 123"
        ]
    ]
];

print_r($array);
?>

<br><br>
<form action="http://localhost/tecweb/practicas/p06/index.php" method="post">
        Matricula: <input type="text" name="matricula"><br>
        <input type="submit">
    </form>
    <br>

    <?php
if(isset($_POST["matricula"]))
{
    $matricula = strtoupper(trim($_POST["matricula"]));

    if(!empty($matricula) && array_key_exists($matricula, $array))
    {
        echo "<h3>Información del vehículo con matrícula: $matricula</h3>";
        echo "Marca: " . $array[$matricula]["Auto"]["marca"] . "<br>";
        echo "Modelo: " . $array[$matricula]["Auto"]["modelo"] . "<br>";
        echo "Tipo: " . $array[$matricula]["Auto"]["tipo"] . "<br><br>";

        echo "<h4>Propietario</h4>";
        echo "Nombre: " . $array[$matricula]["Propietario"]["nombre"] . "<br>";
        echo "Ciudad: " . $array[$matricula]["Propietario"]["ciudad"] . "<br>";
        echo "Dirección: " . $array[$matricula]["Propietario"]["direccion"] . "<br>";
    }
    else
    {
        echo "<h3>Matrícula no encontrada en el registro.</h3>";
    }
}
?>



</body>
</html>

