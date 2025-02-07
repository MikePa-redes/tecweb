<?php 

function multiplo_5y7($num){
    if($num%5==0 && $num%7==0){
        echo '<h3>El número ' .$num. ' es múltiplo de 5 y 7</h3>';
    }
    else 
    if($num%5!=0 && $num%7!=0){
        echo '<h3>El número ' .$num. ' NO es múltiplo de 5 y 7</h3>';
    }

}

function numeros_aleatorios() {
    $encontrado = false; 
    $contador = 0; 

    do {
        $numero1 = rand(1, 100);
        $numero2 = rand(1, 100);
        $numero3 = rand(1, 100);
        $contador++;

        if ($numero1 % 2 != 0 && $numero2 % 2 == 0 && $numero3 % 2 != 0) {
            $encontrado = true;
        }
    } while (!$encontrado); 

    $total_numeros_generados = $contador * 3; 

    return "$total_numeros_generados números obtenidos en $contador iteraciones";
}

function numero_aleatorio_multiplo($num){
    $encontrado = false; 
    while(!$encontrado){
        $numero = rand(1,100);
        if($numero % $num == 0){
            $encontrado = true; 
        }
    }
    echo '<h3>El primer número aleatorio generado que es múltimplo de ' . $num . ' es: </h3>' .$numero; 

}

function numero_aleatorio_multiplo_variable($num) {
    do {
        $numero = rand(1, 100);
    } while ($numero % $num != 0);  // Continúa hasta que encuentre un múltiplo de $num

    echo '<h3>El primer número aleatorio generado que es múltiplo de ' . $num . ' es: </h3>' . $numero;
}


?>