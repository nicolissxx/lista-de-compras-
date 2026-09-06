<?php
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== TRUE) {
    exit;
}

$host = "localhost";
$usuario_db = "root";
$senha_db = "";
$banco = "lista_compras";

$usuarios = [];
$erro = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario_db, $senha_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, usuario FROM usuarios ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $erro = "Erro ao carregar usuários: " . $e->getMessage();
}
?>

<div class="container-fluid p-0">
    <h3 class="font-weight-bold mb-4" style="color: #8c39eb;">Usuários Cadastrados no Sistema</h3>
    
    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr style="background-color: #F3E5F5; color: #8c39eb;">
                    <th class="py-3 ps-3">ID</th>
                    <th class="py-3">Nome de Usuário</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($usuarios)): ?>
                    <tr>
                        <td colspan="2" class="text-center text-muted py-4">Nenhum usuário cadastrado até o momento.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td class="ps-3">#<?php echo $u['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($u['usuario']); ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="text-center mt-4">
        <a href="cadastro.php" class="btn btn-sm btn-outline-secondary rounded-pill px-4">Cadastrar Novo Usuário</a>
    </div>
</div>