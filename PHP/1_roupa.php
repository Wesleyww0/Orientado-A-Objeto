<?php

$peca = "Camiseta";
$tamanho = "G";
$preco = 0;

switch ($peca) {
    case "Camiseta":
        $preco = 50;
        break;
    case "Calça":
        $preco = 80;
        break;
    case "Jaqueta":
        $preco = 120;
        break;
    default:
        $preco = 40;
        break;
}

if ($tamanho == "G") {
    $preco *= 1.10;
}

echo "A peça $peca, tamanho $tamanho, custa R$ " . number_format($preco, 2, ',', '.') . ".";
?>