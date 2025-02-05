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

function impar_par_impar(){
    
}

?>