<?php
// Só inicia a sessão se ela já não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - SmartList</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        /* Hero section institucional */
        .about-hero {
            background: linear-gradient(135deg, #b939eb, #8c39eb);
            color: #fff;
            padding: 80px 20px;
            text-align: center;
        }
        .about-hero h1 {
            font-weight: 800;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }
        .about-hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.9;
        }
        /* Seções de conteúdo */
        .content-section {
            padding: 60px 20px;
        }
        .card-feature {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            height: 100%;
            border: 1px solid #f3e5f5;
            transition: transform 0.2s;
        }
        .card-feature:hover {
            transform: translateY(-5px);
        }
        .feature-icon-box {
            font-size: 2.5rem;
            color: #8c39eb;
            margin-bottom: 20px;
        }
        .mission-box {
            background: #fdf8fe;
            border-left: 5px solid #8c39eb;
            padding: 30px;
            border-radius: 0 16px 16px 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        }
        footer {
            background: #2d124d;
            color: #fff;
            text-align: center;
            padding: 25px;
            font-size: 1rem;
            margin-top: auto;
        }
        footer a {
            color: #d639eb;
            text-decoration: none;
            margin: 0 10px;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Cabeçalho Principal (Padrão do Sistema) -->
    <?php include 'header.php'; ?>

    <!-- Seção Principal de Boas-Vindas (Estilo AnyList About) -->
    <section class="about-hero">
        <div class="container">
            <h1>Menos estresse nas compras, mais tempo para o que importa.</h1>
            <p>O SmartList nasceu para transformar a maneira como você planeja suas compras de supermercado, eliminando idas perdidas ao corredor e o desperdício em casa.</p>
        </div>
    </section>

    <!-- Nossa Missão e História -->
    <section class="content-section">
        <div class="container" style="max-width: 900px;">
            <div class="row align-items-center mb-5">
                <div class="col-md-12">
                    <h3 class="fw-bold mb-4" style="color: #8c39eb;">Nossa História e Propósito</h3>
                    <div class="mission-box">
                        <p class="lead text-secondary mb-0">
                            Assim como as grandes ferramentas de produtividade do mercado inspiram praticidade, criamos o <strong>SmartList</strong> no contexto acadêmico para resolver um problema real do dia a dia: a desorganização nas compras domésticas. Acreditamos que gerenciar itens pendentes, marcar o que já foi colocado no carrinho e manter o controle familiar deve ser algo simples, elegante e acessível em qualquer dispositivo.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Pilares / Funcionalidades Chave -->
            <h3 class="text-center fw-bold mb-5" style="color: #8c39eb;">O que nos move</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card-feature text-center">
                        <div class="feature-icon-box">
                            <i class="fa-solid fa-face-smile"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Praticidade</h5>
                        <p class="text-muted small">Interfaces limpas e diretas ao ponto para você adicionar produtos e riscar itens rapidamente enquanto caminha pelos corredores.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-feature text-center">
                        <div class="feature-icon-box">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Agilidade Real</h5>
                        <p class="text-muted small">Sincronização em tempo real com o banco de dados para que nada seja esquecido na hora de fechar a lista do mês.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-feature text-center">
                        <div class="feature-icon-box">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Foco no Usuário</h5>
                        <p class="text-muted small">Desenvolvido pensando na rotina de famílias e estudantes que buscam economia, organização e eficiência.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer>
        <p class="mb-2 text-white-50">Desenvolvido para o Projeto Integrador - Análise e Desenvolvimento de Sistemas (Senac)</p>
        <div>
            <a href="index.php">Início</a> | 
            <a href="sobre.php">Sobre a empresa</a> | 
            <a href="Contato.php">Contato</a> 
        </div>
    </footer>

</body>
</html>