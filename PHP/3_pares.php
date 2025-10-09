<?php
$pares = [];
$soma = 0;

for ($numero = 1; $numero <= 50; $numero++) {
    if ($numero % 2 == 0) {
        $pares[] = $numero;
        $soma += $numero;
    }
}


echo "Números pares: ";
$primeiro = true;
foreach ($pares as $par) {
    if (!$primeiro) {
        echo ", ";
    }
    echo $par;
    $primeiro = false;
}
echo "<br>";
echo "Soma total dos pares: $soma";

?>