<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartList</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
       body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .main-header {
            background: linear-gradient(135deg, #b939eb, #8c39eb);
            padding: 25px 30px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: none; /* Remove qualquer sombra que crie ilusão de linha */
            margin-bottom: 0;
            border-bottom: none;
            font-size: 1.50rem;
            font-weight: bold;
        }
        .main-header .logo-area {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.00rem;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }
        .header-nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .header-nav a {
            color: #fff;
            text-decoration: none;
             font-size: 1.25rem;
            font-weight: 500;
            transition: opacity 0.2s;
        }
        .header-nav a:hover {
            opacity: 0.8;
        }
        .btn-header-login {
            background: #fff;
            color: #8c39eb !important;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
        }
        /* Seção Hero com Imagem */
        .hero-section {
            background: linear-gradient(rgba(140, 57, 235, 0.85), rgba(185, 57, 235, 0.85)), url('https://images.unsplash.com/photo-1604719312566-8912e9227c6a?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c3VwZXJtZXJjYWRvfGVufDB8fDB8fHww') center/cover no-repeat;
            color: #fff;
            padding: 90px 30px;
            text-align: center;
        }
        .hero-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
            color: #333;
        }
        .btn-custom {
            background: linear-gradient(135deg, #d639eb, #8c39eb);
            color: #fff;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            border: none;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .btn-custom:hover {
            opacity: 0.9;
            color: #fff;
        }
        .btn-outline-custom {
            border: 2px solid #8c39eb;
            color: #8c39eb;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-outline-custom:hover {
            background: #8c39eb;
            color: #fff;
        }
        .feature-icon {
            font-size: 2rem;
            color: #8c39eb;
            margin-bottom: 10px;
        }
        footer {
            background: #2d124d;
            color: #fff;
            text-align: center;
            padding: 25px;
            font-size: 1.00rem;
        }
    </style>
</head>
<body>

    <!-- Cabeçalho Principal -->
    <header class="main-header">
        <p>SMARTLIST</p>
        <a href="index.php" class="logo-area">
        </a>
        <nav class="header-nav">
            <a href="index.php">Início</a>
            <a href="Sobre.php">Sobre a empresa</a> 
            <a href="Contato.php">Contato</a>
            <a href="cadastro.php">Cadastrar</a>
            <a href="login.php" class="btn-header-login">Acessar minha conta</a>
        </nav>
    </header>

    <!-- Seção Principal com Imagem e Identidade Visual -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-card">
                <h1 class="fw-bold mb-3" style="color: #8c39eb;">Organize suas compras sem esforço</h1>
                <p class="text-muted lead mb-5">Sua rotina de supermercado inteligente, prática e totalmente livre de esquecimentos.</p>

                <div class="row text-start mb-5">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <div class="feature-icon"><i class="fa-solid fa-list-check"></i></div>
                        <h6 class="fw-bold">Listas Práticas</h6>
                        <p class="text-muted small">Crie e edite seus produtos rapidamente.</p>
                    </div>
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <div class="feature-icon"><i class="fa-solid fa-bolt"></i></div>
                        <h6 class="fw-bold">Tempo Real</h6>
                        <p class="text-muted small">Marque os itens à medida que coloca no carrinho.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="feature-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
                        <h6 class="fw-bold">Foco Mobile</h6>
                        <p class="text-muted small">Otimizado para o uso direto no celular no mercado.</p>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="login.php" class="btn btn-custom">Acessar minha conta</a>
                    <a href="cadastro.php" class="btn btn-outline-custom">Cadastrar Novo Usuário</a>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <p class="mb-0 text-white-50">Desenvolvido para o Projeto Integrador - Análise e Desenvolvimento de Sistemas (Senac) </p>
        <a href="index.php">Início</a> | 
        <a href="sobre.php">Sobre a empresa</a> 
    </footer>
    </body>
</html>