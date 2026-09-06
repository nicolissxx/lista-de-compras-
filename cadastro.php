<?php
    include './conexao.php';
    session_start();

    $mensagem = "";
    $tipoAlerta = "";

    // Verifica se os campos foram enviados via POST
    if(!empty($_POST['nomeUsuario']) && !empty($_POST['senhaUsuario'])){
        $usuario = trim($_POST['nomeUsuario']);
        $senha = trim($_POST['senhaUsuario']); 

        // Verifica se o usuário já existe no banco de dados
        $verifica = mysqli_query($conexao, "SELECT id FROM usuarios WHERE usuario = '" . mysqli_real_escape_string($conexao, $usuario) . "'");
        
        if(mysqli_num_rows($verifica) > 0){
            $mensagem = "Este nome de usuário já está em uso. Escolha outro.";
            $tipoAlerta = "danger";
        } else {
            // Insere o novo usuário na tabela 'usuarios'
            $sql = "INSERT INTO usuarios (usuario, senha) VALUES ('" . mysqli_real_escape_string($conexao, $usuario) . "', '" . mysqli_real_escape_string($conexao, $senha) . "')";
            
            if(mysqli_query($conexao, $sql)){
                $mensagem = "Cadastro realizado com sucesso! Faça login para continuar.";
                $tipoAlerta = "success";
            } else {
                $mensagem = "Erro ao cadastrar usuário. Tente novamente.";
                $tipoAlerta = "danger";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - SmartList</title>
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="shortcut icon" href="Imagens/iconSistema.png">
    <style>
        body {
            color: #333;
            overflow-x: hidden;
            height: 100vh;
            background: linear-gradient(135deg, #b939eb, #8c39eb);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 480px; /* Largura reduzida para equiparar ao bloco do login */
        }
        .card0 {
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            border-radius: 20px;
            overflow: hidden;
            background: #fff;
            border: none;
            padding: 35px 30px;
        }
        input {
            background-color: #f8f9fa !important;
            border-radius: 50px !important;
            padding: 10px 20px !important; /* Tamanho idêntico aos inputs do login */
            border: 1px solid #8c39eb !important;
            font-size: 15px !important;
        }
        input:focus {
            box-shadow: none !important;
            border: 1px solid #b939eb !important;
        }
        .form-control-label {
            font-size: 13px;
            margin-left: 15px;
            font-weight: 600;
            color: #555;
        }
        .btn-color {
            border-radius: 50px;
            color: #fff;
            background: linear-gradient(135deg, #b939eb, #8c39eb);
            padding: 10px; /* Altura ajustada para o mesmo padrão do botão de login */
            cursor: pointer;
            border: none !important;
            font-weight: 600;
            margin-top: 15px;
        }
        .btn-color:hover { opacity: 0.9; color: #fff; }
        .btn-white {
            border-radius: 50px;
            color: #8c39eb;
            background-color: #fff;
            padding: 6px 20px;
            cursor: pointer;
            border: 2px solid #8c39eb !important;
            font-weight: 600;
            font-size: 14px;
            margin: 4px;
        }
        .btn-white:hover { color: #fff; background: #8c39eb; }
        .bottom { width: 100%; margin-top: 25px !important; }
    </style>
</head>
<body>
<div class="container px-3 py-4">
    <div class="card card0">
        <h3 class="mb-4 text-center fw-bold" style="color: #8c39eb;">Criar Nova Conta</h3>
        
        <?php if(!empty($mensagem)): ?>
            <div class="alert alert-<?php echo $tipoAlerta; ?> text-center py-2" role="alert" style="font-size: 14px; border-radius: 20px;">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="cadastro.php">
            <div class="form-group"> 
                <label class="form-control-label">Usuário</label> 
                <input type="text" id="nomeUsuario" name="nomeUsuario" class="form-control" required> 
            </div>
            <div class="form-group"> 
                <label class="form-control-label">Senha</label> 
                <input type="password" id="senhaUsuario" name="senhaUsuario" class="form-control" required> 
            </div>
            <div class="row justify-content-center my-2 px-3"> 
                <button type="submit" class="btn-block btn-color">Cadastrar</button> 
            </div>
        </form>

        <div class="bottom text-center">
            <a href="index.php"><button class="btn btn-white">Início</button></a>
            <a href="login.php"><button class="btn btn-white">Já tenho conta</button></a>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>