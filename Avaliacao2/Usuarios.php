<?php
// Simulação de “banco de dados” com usuários fixos, usando e-mail e hash de senha
$usuarios = [
    [
        'email' => 'WesleyAdm@Avaliacao.com',
        'password_hash' => password_hash('1234', PASSWORD_DEFAULT)
    ],
    [
        'email' => 'WesleyUser@Avaliacao.com',
        'password_hash' => password_hash('wwo', PASSWORD_DEFAULT)
    ]
];

Function buscarUsuarioPorEmail($email) {
    global $usuarios;
    foreach ($usuarios as &$u) {
        if ($u['email'] === $email) {
            return $u;
        }
    }
    return null;
}


?>

