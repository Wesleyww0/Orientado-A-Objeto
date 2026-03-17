<?php
$carrinho = [
    "Camiseta" => 50,
    "Calça" => 80,
    "Tênis" => 200,
    "Boné" => 40
];

$total = 0;

echo "<h3> Recibo de Compra</h3>";
foreach ($carrinho as $produto => $preco) {
    echo "$produto - R$ " . number_format($preco, 2, ',', '.') . "<br>";
    $total += $preco;
}

echo "<br>Total: R$ " . number_format($total, 2, ',', '.') ;
?>