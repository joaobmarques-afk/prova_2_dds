<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $usuario_id = $_SESSION["usuario_id"];

    $stmt = $pdo->prepare("INSERT INTO tarefas (titulo, descricao, usuario_id) VALUES (?, ?, ?)");
    $stmt->execute([$titulo, $descricao, $usuario_id]);

    header("Location: index.php");
    exit;
}

include 'layout.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Adicionar Nova Tarefa</h5>
                
                <form action="nova.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Título da Tarefa</label>
                        <input type="text" name="titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-success">Salvar Tarefa</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

</div> 
</body>
</html>