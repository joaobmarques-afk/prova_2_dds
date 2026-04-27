<?php
session_start();
$_SESSION = []; // Limpa todas as variáveis da sessão
session_destroy(); // Destrói a sessão
header("Location: login.php"); // Redireciona para o login
exit;
?>