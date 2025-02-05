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


?>

</body>
</html>


