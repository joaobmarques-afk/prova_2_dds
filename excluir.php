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

    // Comando DELETE para apagar a tarefa
    $sql = "DELETE FROM tarefas WHERE id = :id AND usuario_id = :usuario_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();
}

header("Location: index.php");
exit;
?>