<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario_id = $_SESSION["usuario_id"];

    $sql = "UPDATE tarefas SET status = 'concluída' WHERE id = :id AND usuario_id = :usuario_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':usuario_id', $usuario_id); 
    $stmt->execute();
}

header("Location: index.php");
exit;
?>