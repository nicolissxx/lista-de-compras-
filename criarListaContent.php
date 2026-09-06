<?php
// Garantir que a sessão está ativa (o dashboard já inicia, mas é bom prevenir)
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== TRUE) {
    exit;
}

// Configurações do Banco de Dados
$host = "localhost";
$usuario_db = "root";
$senha_db = "";
$banco = "lista_compras";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario_db, $senha_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erro na conexão com o banco de dados.</div>";
    exit;
}

// Identifica o ID do usuário logado
$nome_usuario = $_SESSION['nome_usuario'] ?? '';
$stmt_user = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = :usuario LIMIT 1");
$stmt_user->bindValue(':usuario', $nome_usuario);
$stmt_user->execute();
$dados_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
$usuario_id = $dados_user['id'] ?? 1;

// 1. Lógica para Adicionar Item
if (isset($_POST['novo_item']) && !empty(trim($_POST['novo_item']))) {
    $nome_item = trim($_POST['novo_item']);
    
    $sql_insert = "INSERT INTO itens_lista (usuario_id, nome, comprado) VALUES (:usuario_id, :nome, 0)";
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt_insert->bindValue(':nome', $nome_item);
    $stmt_insert->execute();
    
    // Redireciona mantendo na página do dashboard
    echo "<script>window.location.href='dashboard.php?pagina=criarLista';</script>";
    exit;
}

// 2. Lógica para Alternar Status ou Excluir
if (isset($_GET['acao']) && isset($_GET['id'])) {
    $id_item = (int) $_GET['id'];
    
    if ($_GET['acao'] == 'toggle') {
        $sql_toggle = "UPDATE itens_lista SET comprado = NOT comprado WHERE id = :id AND usuario_id = :usuario_id";
        $stmt_toggle = $pdo->prepare($sql_toggle);
        $stmt_toggle->bindValue(':id', $id_item, PDO::PARAM_INT);
        $stmt_toggle->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt_toggle->execute();
    } elseif ($_GET['acao'] == 'remover') {
        $sql_remove = "DELETE FROM itens_lista WHERE id = :id AND usuario_id = :usuario_id";
        $stmt_remove = $pdo->prepare($sql_remove);
        $stmt_remove->bindValue(':id', $id_item, PDO::PARAM_INT);
        $stmt_remove->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt_remove->execute();
    }
    
    echo "<script>window.location.href='dashboard.php?pagina=criarLista';</script>";
    exit;
}

// 3. Buscar os itens do banco de dados
$sql_select = "SELECT * FROM itens_lista WHERE usuario_id = :usuario_id ORDER BY id DESC";
$stmt_select = $pdo->prepare($sql_select);
$stmt_select->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmt_select->execute();
$itens_lista = $stmt_select->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="font-weight-bold m-0" style="color: #8c39eb;">Planejar Lista de Compras</h3>
    </div>
    
    <!-- Formulário para adicionar item -->
    <form method="post" action="dashboard.php?pagina=criarLista" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" name="novo_item" placeholder="Ex: Arroz, Leite, Café..." autocomplete="off" style="border-radius: 50px 0 0 50px; background-color: #F3E5F5; border: 1px solid #9539eb;" required>
            <button type="submit" class="btn text-white" style="background-image: linear-gradient(to right, #d639eb, #8c39eb); border-radius: 0 50px 50px 0;">Adicionar</button>
        </div>
    </form>

    <hr>

    <!-- Itens Pendentes -->
    <div class="text-uppercase font-weight-bold text-secondary mb-2" style="font-size: 0.85rem; letter-spacing: 0.5px;">Itens Pendentes</div>
    <ul class="list-group mb-4">
        <?php 
        $tem_pendentes = false;
        foreach ($itens_lista as $produto): 
            if ($produto['comprado'] == 0):
                $tem_pendentes = true;
        ?>
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 mb-2 shadow-sm rounded-pill px-4">
                <span><?php echo htmlspecialchars($produto['nome']); ?></span>
                <div>
                    <a href="dashboard.php?pagina=criarLista&acao=toggle&id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-outline-secondary rounded-pill me-2">
                        Marcar
                    </a>
                    <a href="dashboard.php?pagina=criarLista&acao=remover&id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill">
                        Excluir
                    </a>
                </div>
            </li>
        <?php 
            endif;
        endforeach; 
        if (!$tem_pendentes):
        ?>
            <li class="list-group-item text-center text-muted border-0 small py-3">Nenhum item pendente no momento.</li>
        <?php endif; ?>
    </ul>

    <!-- Itens Comprados -->
    <div class="text-uppercase font-weight-bold text-secondary mb-2" style="font-size: 0.85rem; letter-spacing: 0.5px;">Itens Comprados</div>
    <ul class="list-group">
        <?php 
        $tem_comprados = false;
        foreach ($itens_lista as $produto): 
            if ($produto['comprado'] == 1):
                $tem_comprados = true;
        ?>
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 mb-2 shadow-sm rounded-pill px-4 bg-light">
                <span class="text-decoration-line-through text-muted"><?php echo htmlspecialchars($produto['nome']); ?></span>
                <div>
                    <a href="dashboard.php?pagina=criarLista&acao=toggle&id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-success rounded-pill me-2">
                        Comprado ✓
                    </a>
                    <a href="dashboard.php?pagina=criarLista&acao=remover&id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill">
                        Excluir
                    </a>
                </div>
            </li>
        <?php 
            endif;
        endforeach; 
        if (!$tem_comprados):
        ?>
            <li class="list-group-item text-center text-muted border-0 small py-3">Nenhum item comprado ainda.</li>
        <?php endif; ?>
    </ul>
</div>