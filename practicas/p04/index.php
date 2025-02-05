<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang=“es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Variables de php</title>
</head>
<body>
<p>1.Opciones correctas: $_myvar, $_7var, $myvar, $var7, $_element1. Estas opciones son correctas ya que empiezan con una letra o un guion bajo (underscore), seguido de cualquier
número de letras, números y guion bajo.</p>

<?php
error_reporting(0);

$a = "ManejadorSQL";
$b = 'MySQL';
$c = &$a;

echo "2. $a, ";
echo "$b, ";
echo "$c <br>";

$a = "PHP server";
$b = &$a;

echo "$a, ";
echo "$b, ";
echo "$c <br>";

echo "<p>En el segundo bloque de asignaciones la variable \$a se le asigna PHP server y a la variable \$b se le asigna el contenido de la variable a  <br>";
unset($a);
unset($b);
unset($c);


echo "<br><br> 3):<br>";

$a = "PHP5";
var_dump($a);
echo "<br>";
$z[] = &$a;
var_dump($z);
echo "<br>";
$b = "5a version de PHP";
var_dump($b);
echo "<br>";
@$c = $b*10;
var_dump($c);
echo "<br>";
$a .= $b;
var_dump($a);
echo "<br>";
@$b *= $c;
var_dump($b);
echo "<br>";
$z[0] = "MySQL";
var_dump($z);
echo "<br>";


echo "<br><br> 4):<br>";
echo "GLOBALS['a']: " . $GLOBALS['a'] . "<br>";
echo "GLOBALS['b']: " . $GLOBALS['b'] . "<br>";
echo "GLOBALS['c']: " . $GLOBALS['c'] . "<br>";
echo "GLOBALS['z']: ";
print_r($GLOBALS['z']);
unset($c);
unset($z);
unset($b);
unset($c);

echo "<br><br> 5):<br>";

$a = "7 personas";
$b = (integer) $a;
$a = "9E3";
$c = (double) $a;

echo "\$a: " . $a . "<br>"; 
echo "\$b: " . $b . "<br>"; 
echo "\$c: " . $c . "<br>";
unset($a);
unset($b);
unset($c);

echo "<br><br> 6):<br>";
$a = "0";
$b = "TRUE";
$c = "FALSE";
$d = ($a OR $b);
$e = ($a AND $c);
$f = ($a XOR $b);

var_dump($a); echo "<br>";  
var_dump($b); echo "<br>";  
var_dump($c); echo "<br>";  
var_dump($d); echo "<br>";  
var_dump($e); echo "<br>";  
var_dump($f); echo "<br>";  

$e = "FALSE";
var_export($e, true);
var_export($c, true);
echo "Valor de e: $e <br>";
echo "Valor de c: $c <br>";

echo "<br><br> 7):<br>";
echo "Versión de Apache: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "Versión de PHP: " . phpversion() . "<br>";
echo "Sistema Operativo del Servidor: " . PHP_OS . "<br>";
echo "Idioma del navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br>";




?>

</body>
</html>


