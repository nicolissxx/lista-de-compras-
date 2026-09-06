<?php
// Só inicia a sessão se ela já não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Garante que só quem estiver logado E for o administrador pode ver esta página
$nome_usuario = $_SESSION['nome_usuario'] ?? $_SESSION['usuario'] ?? '';

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== TRUE || $nome_usuario !== 'adm') {
    header("Location: criarLista.php");
    exit;
}

// Configurações do Banco de Dados
$host = "localhost";
$usuario_db = "root";
$senha_db = "";
$banco = "lista_compras";

$usuarios = [];
$erro = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario_db, $senha_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Busca todos os usuários cadastrados no banco
    $sql = "SELECT id, usuario FROM usuarios ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $erro = "Erro ao carregar usuários: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Usuários</title>
    <!-- Mesmos estilos Bootstrap usados no sistema -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: linear-gradient(to right, #b939eb, #8c39eb);
            font-family: Arial, sans-serif;
            padding: 30px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-custom {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 700px;
            margin: auto;
        }
        .table th {
            color: #6f39eb;
            background-color: #F3E5F5 !important;
            border: none;
        }
        .table td {
            vertical-align: middle;
        }
</style>
    </style>
</head>
<body>
    <div class="card-custom">
        <h3 class="text-center mb-4 font-weight-bold" style="color: #6f39eb;">Usuários Cadastrados no Sistema</h3>
        
        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="rounded-start">ID</th>
                        <th class="rounded-end">Nome de Usuário</th>
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
                                <td>#<?php echo $u['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($u['usuario']); ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-3">
            <a href="cadastro.php" class="btn btn-sm btn-outline-secondary rounded-pill px-4">Cadastrar Novo Usuário</a>
             <a href="criarLista.php" class="btn btn-sm btn-outline-secondary rounded-pill px-4">Voltar</a>
        </div>
    </div>
</body>
</html>