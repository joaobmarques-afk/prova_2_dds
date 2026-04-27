<?php
$host = "127.0.0.1"; // ou "localhost"
$user = "root";
$password = "ceub123456"; // <-- Coloque a senha aqui!
$db = "tarefas"; // Certifique-se de que o nome do banco é este mesmo

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
?>