<?php
session_start();
require_once 'usuarios.php';
require 'vendor/autoload.php'; // autoloader do composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $user = buscarUsuarioPorEmail($email);
    if ($user && password_verify($senha, $user['password_hash'])) {
        // login bem-sucedido
        $_SESSION['email'] = $email;

        // envia notificação de acesso bem-sucedido
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'wesleyphp58@gmail.com'; // Meu email
            $mail->Password = 'bcya luxl ehei ywbj'; // senha do app          
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('wesleyphp58@gmail.com', 'Sistema de Login');
            $mail->addAddress('marcos.sousa12@fatec.sp.gov.br');  // destinatário para notificação

            $mail->isHTML(true);
            $mail->Subject = 'Acesso bem-sucedido ao Sistema';
            $mensagem = "Usuário: {$email}<br>Data/Hora: " . date("Y-m-d H:i:s");
            $mail->Body = nl2br($mensagem);
            $mail->AltBody = strip_tags($mensagem);

            $mail->send();
        } catch (Exception $e) {
            
            error_log("Erro ao enviar email de notificação: " . $mail->ErrorInfo);
        }

        header('Location: Home.php');
        exit;
    } else {
        $erro = 'Usuário ou senha incorretos.';
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
<h2>Login</h2>
<?php if ($erro): ?>
    <p style="color:red"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>
<form method="post">
    <label>E-mail: <input type="email" name="email" required></label><br>
    <label>Senha:   <input type="password" name="senha" required></label><br>
    <button type="submit">Entrar</button>
</form>
<p><a href="RecuperarSenha.php">Esqueci a Senha</a></p>
</body>
</html>