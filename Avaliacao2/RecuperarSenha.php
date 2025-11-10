<?php
require_once 'usuarios.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $user = buscarUsuarioPorEmail($email);
    if ($user) {
        // senha temporária
        $novaSenha = "Fatec2025SI";
        

        // envia e-mail de recuperação
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'wesleyphp58@gmail.com';
            $mail->Password = 'bcya luxl ehei ywbj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('wesleyphp58@gmail.com', 'Sistema de Login');
            $mail->addAddress('marcos.sousa12@fatec.sp.gov.br');

            $mail->isHTML(true);
            $mail->Subject = 'Recuperação de senha';
            $mensagemEmail = "Sua senha foi resetada. Senha temporária: <b>{$novaSenha}</b>";
            $mail->Body = nl2br($mensagemEmail);
            $mail->AltBody = strip_tags($mensagemEmail);

            $mail->send();
        } catch (Exception $e) {
            error_log("Erro ao enviar email de recuperação: " . $mail->ErrorInfo);
        }
        $mensagem = "Se o e-mail existir no sistema, uma nova senha foi enviada.";
    } else {
        $mensagem = "Se o e-mail existir no sistema, uma nova senha foi enviada.";
    }
}
?>
