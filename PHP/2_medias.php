<?php
$alunos = [
    "Ana" => [7, 8, 6, 9],
    "João" => [5, 6, 4, 5],
    "Maria" => [9, 8, 10, 9],
    "Rebeca" => [4, 7, 3, 5]
];

foreach ($alunos as $nome => $notas) {
    $media = array_sum($notas) / count($notas);
    $mediaFormatada = number_format((double)$media, 1);
    echo "Aluno: $nome - Média: $mediaFormatada - ";
    if ($media >= 6) {
        echo "Aprovado <br>";
    } else {
        echo "Reprovado <br>";
    }
}

?>