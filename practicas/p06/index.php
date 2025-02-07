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

</body>
</html>

