<?php
/*
=== DECLARAÇÃO DE FRAMEWORK ===
Framework escolhido: Bootstrap 5
Onde foi importado: No arquivo 'layout.php' (na tag <head>), que é incluído nesta e nas demais páginas.
URL: https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css
===============================
*/

session_start();
include 'conexao.php';

// Se não estiver logado, chuta de volta pro login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

// Inclui o nosso topo com o Bootstrap e o Menu
include 'layout.php'; 

// Pega o ID do usuário logado na sessão
$usuario_id = $_SESSION["usuario_id"];

// Busca no banco APENAS as tarefas deste usuário logado
$sql = "SELECT * FROM tarefas WHERE usuario_id = :usuario_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
?>

<a href="nova.php" class="btn btn-success mb-4">Adicionar Nova Tarefa</a>

<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title">Minhas Tarefas</h5>
        <table class="table table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($tarefa = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $tarefa['id']; ?></td>
                    <td><?php echo $tarefa['titulo']; ?></td>
                    <td>
                        <?php if($tarefa['status'] == 'pendente'): ?>
                            <span class="badge bg-warning text-dark">Pendente</span>
                        <?php else: ?>
                            <span class="badge bg-success">Concluída</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="editar.php?id=<?php echo $tarefa['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                        <a href="concluir.php?id=<?php echo $tarefa['id']; ?>" class="btn btn-sm btn-success">Concluir</a>
                        <a href="excluir.php?id=<?php echo $tarefa['id']; ?>" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                
                <?php if($stmt->rowCount() == 0): ?>
                    <tr>
                        <td colspan="4" class="text-center">Nenhuma tarefa encontrada. Cadastre a primeira!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div> 
</body>
</html>