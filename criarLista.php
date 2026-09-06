<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== TRUE) {
    header("Location: login.php");
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
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Identifica o usuário logado
$nome_usuario = $_SESSION['nome_usuario'] ?? $_SESSION['usuario'] ?? '';
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
    
    header("Location: criarLista.php");
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
    
    header("Location: criarLista.php");
    exit;
}

// 3. Buscar os itens do banco de dados
$sql_select = "SELECT * FROM itens_lista WHERE usuario_id = :usuario_id ORDER BY id DESC";
$stmt_select = $pdo->prepare($sql_select);
$stmt_select->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmt_select->execute();
$itens_lista = $stmt_select->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartList - Planejar Lista de Compras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #b939eb, #8c39eb);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card-custom {
            background: #ffffff;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 680px;
        }
        .header-top {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .app-title {
            color: #8c39eb;
            font-weight: 700;
            font-size: 1.5rem;
        }
        .user-greeting {
            color: #555;
            font-size: 0.95rem;
        }
        .form-control {
            border-radius: 50px !important;
            padding: 12px 20px !important;
            border: 1px solid #8c39eb !important;
            background-color: #f8f9fa !important;
            font-size: 15px !important;
        }
        .form-control:focus {
            box-shadow: none !important;
            border: 1px solid #b939eb !important;
        }
        .btn-custom {
            background: linear-gradient(135deg, #b939eb, #8c39eb);
            color: #fff;
            border-radius: 50px;
            border: none;
            padding: 12px 25px;
            font-weight: 600;
            transition: opacity 0.2s;
        }
        .btn-custom:hover {
            opacity: 0.9;
            color: #fff;
        }
        .section-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #8c39eb;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 12px;
        }
        .list-group-item {
            border: none;
            background-color: #fdfbf7;
            transition: all 0.2s;
        }
        .list-group-item:hover {
            background-color: #f3e5f5;
        }
        .item-comprado {
            background-color: #f1f3f5 !important;
        }
        .riscado {
            text-decoration: line-through;
            color: #adb5bd;
        }
        .btn-action-check {
            border-radius: 50px;
            font-size: 0.8rem;
            padding: 5px 14px;
            font-weight: 600;
        }
        .footer-logout {
            margin-top: 30px;
            border-top: 1px solid #f0f0f0;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="card-custom">
        <!-- Cabeçalho interno -->
        <div class="header-top d-flex justify-content-between align-items-center">
            <div>
                <h3 class="app-title m-0"></i>SmartList</h3>
            </div>
            <div class="user-greeting text-end">
                <span>Olá, <strong><?php echo htmlspecialchars($nome_usuario); ?></strong></span>
            </div>
        </div>
        <?php if (isset($nome_usuario) && $nome_usuario === 'adm'): ?>
            <div class="mb-3">
                <a href="verificaUsuario.php" class="btn btn-sm btn-outline-dark rounded-pill px-3 py-2 fw-semibold">
                    <i class="fa-solid fa-user-shield me-1"></i> Usuários Cadastrados
                </a>
            </div>
        <?php endif; ?>
        
        <!-- Formulário para adicionar item -->
        <form method="post" action="criarLista.php" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="novo_item" autocomplete="off" required>
                <button type="submit" class="btn btn-custom ms-2"><i class="fa-solid fa-plus me-1"></i> Adicionar</button>
            </div>
        </form>

        <!-- Itens Pendentes -->
        <div class="section-title"><i class="fa-solid fa-list-check me-1"></i> Itens Pendentes</div>
        <ul class="list-group mb-4">
            <?php 
            $tem_pendentes = false;
            foreach ($itens_lista as $produto): 
                if ($produto['comprado'] == 0):
                    $tem_pendentes = true;
            ?>
                <li class="list-group-item d-flex justify-content-between align-items-center mb-2 shadow-sm rounded-pill px-4 py-2">
                    <span class="fw-medium text-dark"><?php echo htmlspecialchars($produto['nome']); ?></span>
                    <div>
                        <a href="criarLista.php?acao=toggle&id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-outline-success btn-action-check me-1" title="Marcar como comprado">
                            <i class="fa-solid fa-check"></i> Comprar
                        </a>
                        <a href="criarLista.php?acao=remover&id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-outline-danger btn-action-check" title="Excluir item">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </li>
            <?php 
                endif;
            endforeach; 
            if (!$tem_pendentes):
            ?>
                <li class="list-group-item text-center text-muted border-0 small py-3 rounded-pill bg-light">Nenhum item pendente no momento.</li>
            <?php endif; ?>
        </ul>

        <!-- Itens Comprados -->
        <div class="section-title"><i class="fa-solid fa-bag-shopping me-1"></i> Itens Comprados</div>
        <ul class="list-group">
            <?php 
            $tem_comprados = false;
            foreach ($itens_lista as $produto): 
                if ($produto['comprado'] == 1):
                    $tem_comprados = true;
            ?>
                <li class="list-group-item item-comprado d-flex justify-content-between align-items-center mb-2 shadow-sm rounded-pill px-4 py-2">
                    <span class="riscado"><?php echo htmlspecialchars($produto['nome']); ?></span>
                    <div>
                        <a href="criarLista.php?acao=toggle&id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-success btn-action-check me-1" title="Desmarcar item">
                            <i class="fa-solid fa-rotate-left"></i> Desfazer
                        </a>
                        <a href="criarLista.php?acao=remover&id=<?php echo $produto['id']; ?>" class="btn btn-sm btn-outline-danger btn-action-check" title="Excluir item">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </li>
            <?php 
                endif;
            endforeach; 
            if (!$tem_comprados):
            ?>
                <li class="list-group-item text-center text-muted border-0 small py-3 rounded-pill bg-light">Nenhum item comprado ainda.</li>
            <?php endif; ?>
        </ul>

        <!-- Rodapé da Caixa -->
        <div class="footer-logout text-center">
            <a href="logout.php" class="text-danger small text-decoration-none fw-semibold">
                <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Sair da conta
            </a>
        </div>
    </div>
</body>
</html>