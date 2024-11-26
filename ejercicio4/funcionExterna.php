<?php

function calculaValores($valores){
    $resultado = [
        "maximo" => max($valores),
        "minimo" => min($valores),
        "media" => array_sum($valores)/count($valores)
    ];
    return $resultado;
}

?>