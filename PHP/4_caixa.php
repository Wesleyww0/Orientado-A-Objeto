<?php
//  Simulador de Caixa Eletrônico com várias combinações

// Valor digitado pelo usuário (você pode mudar aqui)
$valorSaque = 230;

// Notas disponíveis no caixa
$notas = [100, 50, 20];

// Verifica se o valor é múltiplo de 10
if ($valorSaque % 10 != 0 || $valorSaque < 20) {
    echo " Valor inválido! O saque deve ser de no mínimo R$20 e múltiplo de 10.";
} else {
    echo "<h3> Simulador de Saque</h3>";
    echo "Valor solicitado: R$ $valorSaque<br><br>";

    $restante = $valorSaque;

    // Percorre as notas e calcula quantas de cada são necessárias
    foreach ($notas as $nota) {
        $quantidade = 0;

        // Enquanto ainda for possível usar essa nota
        while ($restante >= $nota) {
            $restante -= $nota;
            $quantidade++;
        }

        // Exibe a quantidade usada dessa nota
        if ($quantidade > 0) {
            echo "→ $quantidade nota(s) de R$ $nota<br>";
        }
    }

    // Caso sobre algum valor não sacável (por exemplo, R$10)
    if ($restante > 0) {
        echo "<br> Não foi possível sacar R$ $restante (altere o valor do saque).";
    } else {
        echo "<br><br> Saque concluído!";
    }

    
}
?>
