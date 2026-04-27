<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION["usuario_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE tarefas SET titulo = :titulo, descricao = :descricao WHERE id = :id AND usuario_id = :usuario_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':titulo' => $titulo, 
        ':descricao' => $descricao, 
        ':id' => $id, 
        ':usuario_id' => $usuario_id
    ]);

    header("Location: index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM tarefas WHERE id = :id AND usuario_id = :usuario_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();

$tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tarefa) {
    header("Location: index.php");
    exit;
}

include 'layout.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Editar Tarefa</h5>
                
                <form action="editar.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Título da Tarefa</label>
                        <input type="text" name="titulo" class="form-control" value="<?php echo $tarefa['titulo']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3"><?php echo $tarefa['descricao']; ?></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

</div> 
</body>
</html>