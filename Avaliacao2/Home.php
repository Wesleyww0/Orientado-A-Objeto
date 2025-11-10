<?php
session_start();
if (! isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Página Restrita</title></head>
<body>
<h2>Bem-vindo(a), <?= htmlspecialchars($_SESSION['email']) ?></h2>
<p>Você está em uma área restrita.</p>
<p><a href="logout.php">Logout</a></p>
</body>
</html>
