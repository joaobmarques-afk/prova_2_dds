<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'conexao.php';


if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT id, usuario FROM usuarios WHERE usuario = :usuario AND senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario'] = $user['usuario'];
        
        header("Location: index.php");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { margin-top: 100px; max-width: 400px; }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="login-container w-100">
        <div class="card shadow">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">Acesso ao Sistema</h3>

                <?php if ($erro): ?>
                    <div class="alert alert-danger"><?php echo $erro; ?></div>
                <?php endif; ?>

                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label class="form-label">Usuário</label>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>
        <p class="text-center text-muted mt-3">admin / 123456</p>
    </div>
</div>

</body>
</html>