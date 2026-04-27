<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php 
// Se o usuário estiver logado (sessão existir), mostra a barra de navegação (Navbar)
if (isset($_SESSION["usuario"])): 
?>
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">Minhas Tarefas</a>
        <div class="d-flex align-items-center">
            <span class="text-white me-3">Olá, <?php echo $_SESSION["usuario"]; ?></span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Sair</a>
        </div>
    </div>
</nav>
<?php endif; ?>

<div class="container">