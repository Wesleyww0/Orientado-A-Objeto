<?php
$salarios = [1500, 2200, 1800, 3000, 1950];

echo "<h3>Reajuste Salarial</h3>";
foreach ($salarios as $salario) {
    if ($salario < 2000) {
        $novo = $salario * 1.10;
        echo "Salário antigo: R$ " . number_format($salario, 2, ',', '.') . 
             " ➜ Novo salário: R$ " . number_format($novo, 2, ',', '.') . "<br>";
    } else {
        echo "Salário mantido: R$ " . number_format($salario, 2, ',', '.') . "<br>";
    }
}
?>