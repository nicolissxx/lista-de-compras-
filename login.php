<?php
    include './conexao.php';
    // Iniciando a sessão
    session_start();
    
    if(isset($_GET['alterado'])){
        echo "<script> alert('SENHA ALTERADA COM SUCESSO! Por favor, faça login com a nova senha!'); </script>";
    }

    if(!empty($_POST['nomeUsuario']) && !empty($_POST['senhaUsuario'])){
        $usuario = $_POST['nomeUsuario'];
        $senha = $_POST['senhaUsuario'];

        $idUsuario = -1;
        $achou = 0;

        // Consulta ajustada para verificar na tabela 'usuarios' do banco 'lista_compras'
        $resultado_Usuario = mysqli_query($conexao, "SELECT id, usuario, senha FROM usuarios WHERE usuario = '" . mysqli_real_escape_string($conexao, $usuario) . "'");
        
        while($linha = mysqli_fetch_array($resultado_Usuario)){ 
            $senhaBanco = $linha['senha'];
            $idUsuario = $linha['id'];
            
            // Verificação de senha (se estiver usando md5, mantenha md5($senha). Caso esteja em texto plano como no dump, pode comparar direto ou via password_verify)
            if($senhaBanco === $senha) {
                $achou = 1;
            }
        }

        if($achou == 1){
            $_SESSION['logado'] = TRUE;
            $_SESSION['codUsuario'] = $idUsuario;
            $_SESSION['nome_usuario'] = $usuario;
            header("location: criarLista.php"); // Redireciona para a página principal do sistema logado
            exit;
        } else {
?>
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login - SmartList</title>
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
                    }
                    .container { margin-top: 5vh; }
                    .card0 {
                        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
                        border-radius: 20px;
                        overflow: hidden;
                        background: #fff;
                        border: none;
                    }
                    .card1 { width: 50%; padding: 40px 30px 10px 30px; }
                    .card2 {
                        width: 50%;
                        background: linear-gradient(rgba(140, 57, 235, 0.85), rgba(185, 57, 235, 0.85)), url('https://pedagogiaaquiemcasa.com.br/wp-content/uploads/2023/03/LISTA-DE-COMPRAS.jpg') center/cover no-repeat;
                        min-height: 450px;
                    }
                    input {
                        background-color: #f8f9fa !important;
                        border-radius: 50px !important;
                        padding: 12px 20px !important;
                        border: 1px solid #8c39eb !important;
                        font-size: 15px !important;
                    }
                    .btn-color {
                        border-radius: 50px;
                        color: #fff;
                        background: linear-gradient(135deg, #b939eb, #8c39eb);
                        padding: 12px;
                        cursor: pointer;
                        border: none !important;
                        font-weight: 600;
                    }
                    .btn-color:hover { opacity: 0.9; color: #fff; }
                    .btn-white {
                        border-radius: 50px;
                        color: #8c39eb;
                        background-color: #fff;
                        padding: 8px 30px;
                        cursor: pointer;
                        border: 2px solid #8c39eb !important;
                        font-weight: 600;
                    }
                    .btn-white:hover { color: #fff; background: #8c39eb; }
                    @media screen and (max-width: 992px) {
                        .card1, .card2 { width: 100%; }
                        .card2 { min-height: 200px; }
                    }
                </style>
            </head>
            <body>
                <div class="container px-4 py-5 mx-auto">
                    <div class="card card0">
                        <div class="d-flex flex-lg-row flex-column-reverse">
                            <div class="card card1">
                                <div class="row justify-content-center my-auto">
                                    <div class="col-md-8 col-10 my-4">
                                        <h3 class="mb-4 text-center fw-bold" style="color: #8c39eb;">Falha ao logar</h3>
                                        <form method="post" action="login.php">
                                            <div class="form-group text-danger text-center mb-4">Usuário ou senha incorretos.</div>
                                            <div class="row justify-content-center my-3 px-3"> <button class="btn-block btn-color">Tentar Novamente</button> </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card card2"></div>
                        </div>
                    </div>
                </div>
            </body>
            </html>
<?php
        }
    } else {
?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login - SmartList</title>
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
                }
                .container { margin-top: 5vh; }
                .card0 {
                    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
                    border-radius: 20px;
                    overflow: hidden;
                    background: #fff;
                    border: none;
                }
                .card1 { width: 50%; padding: 40px 30px 10px 30px; }
                .card2 {
                    width: 50%;
                    background: linear-gradient(rgba(140, 57, 235, 0.85), rgba(185, 57, 235, 0.85)), url('https://pedagogiaaquiemcasa.com.br/wp-content/uploads/2023/03/LISTA-DE-COMPRAS.jpg') center/cover no-repeat;
                    min-height: 450px;
                }
                input {
                    background-color: #f8f9fa !important;
                    border-radius: 50px !important;
                    padding: 12px 20px !important;
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
                    padding: 12px;
                    cursor: pointer;
                    border: none !important;
                    font-weight: 600;
                    margin-top: 20px;
                }
                .btn-color:hover { opacity: 0.9; color: #fff; }
                .btn-white {
                    border-radius: 50px;
                    color: #8c39eb;
                    background-color: #fff;
                    padding: 8px 25px;
                    cursor: pointer;
                    border: 2px solid #8c39eb !important;
                    font-weight: 600;
                    margin: 5px;
                }
                .btn-white:hover { color: #fff; background: #8c39eb; }
                .bottom { width: 100%; margin-top: 30px !important; }
                @media screen and (max-width: 992px) {
                    .card1, .card2 { width: 100%; }
                    .card2 { min-height: 200px; }
                }
            </style>
        </head>
        <body>
        <div class="container px-4 py-5 mx-auto">
            <div class="card card0">
                <div class="d-flex flex-lg-row flex-column-reverse">
                    <div class="card card1">
                        <div class="row justify-content-center my-auto">
                            <div class="col-md-9 col-10 my-4">
                                <h3 class="mb-4 text-center fw-bold" style="color: #8c39eb;">Acessar Conta</h3>
                                <form method="post" action="login.php">
                                    <div class="form-group"> <label class="form-control-label">Usuário</label> <input type="text" id="nomeUsuario" name="nomeUsuario" class="form-control" required> </div>
                                    <div class="form-group"> <label class="form-control-label">Senha</label> <input type="password" id="senhaUsuario" name="senhaUsuario" class="form-control" required> </div>
                                    <div class="row justify-content-center my-3 px-3"> <button class="btn-block btn-color">Entrar</button> </div>
                                </form>
                            </div>
                        </div>
                        <div class="bottom text-center mb-4">
                            <a href="index.php"><button class="btn btn-white">Início</button></a>
                            <a href="cadastro.php"><button class="btn btn-white">Cadastrar</button></a>
                        </div>
                    </div>
                    <div class="card card2"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        </body>
        </html>
<?php
    }
?>