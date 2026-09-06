<?php
// Só inicia a sessão se ela já não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mensagem_status = "";

// Lógica básica para simulação de envio do formulário de contato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem_texto = trim($_POST['mensagem'] ?? '');

    if (!empty($nome) && !empty($email) && !empty($mensagem_texto)) {
        // Aqui você poderia integrar com PHPMailer ou salvar no banco se desejado.
        // Para o MVP / Projeto Integrador, exibimos uma mensagem de sucesso elegante.
        $mensagem_status = "<div class='alert alert-success text-center rounded-pill py-3'>Mensagem enviada com sucesso! Agradecemos o seu contato. Retornaremos em breve.</div>";
    } else {
        $mensagem_status = "<div class='alert alert-danger text-center rounded-pill py-3'>Por favor, preencha todos os campos obrigatórios.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - SmartList</title>
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
        /* Hero section de Contato */
        .contact-hero {
            background: linear-gradient(135deg, #b939eb, #8c39eb);
            color: #fff;
            padding: 70px 20px;
            text-align: center;
        }
        .contact-hero h1 {
            font-weight: 800;
            margin-bottom: 15px;
            font-size: 2.3rem;
        }
        .contact-hero p {
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.9;
        }
        /* Seção do Formulário e Cards */
        .content-section {
            padding: 50px 20px;
        }
        .card-contact {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #f3e5f5;
        }
        .info-box {
            background: #fdf8fe;
            border-radius: 16px;
            padding: 25px;
            border: 1px solid #f3e5f5;
            height: 100%;
        }
        .info-icon {
            font-size: 1.8rem;
            color: #8c39eb;
            margin-bottom: 15px;
        }
        .form-control, .form-select {
            background-color: #F3E5F5 !important;
            border-radius: 50px !important;
            padding: 12px 20px !important;
            border: 1px solid #9539eb !important;
        }
        textarea.form-control {
            border-radius: 20px !important;
        }
        .btn-custom {
            background: linear-gradient(135deg, #d639eb, #8c39eb);
            color: #fff;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            border: none;
            width: 100%;
            transition: opacity 0.2s;
        }
        .btn-custom:hover {
            opacity: 0.9;
            color: #fff;
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

    <!-- Seção Hero de Contato -->
    <section class="contact-hero">
        <div class="container">
            <h1>Estamos aqui para ajudar</h1>
            <p>Tem dúvidas, sugestões ou feedback sobre o SmartList? Entre em contato com a nossa equipe de suporte e desenvolvimento.</p>
        </div>
    </section>

    <!-- Conteúdo Principal: Formulário e Informações -->
    <section class="content-section">
        <div class="container" style="max-width: 1000px;">
            
            <?php echo $mensagem_status; ?>

            <div class="row g-4 mt-2">
                <!-- Informações de Contato / Suporte -->
                <div class="col-lg-4">
                    <div class="d-flex flex-column gap-4">
                        <div class="info-box">
                            <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                            <h5 class="fw-bold mb-2">E-mail de Suporte</h5>
                            <p class="text-muted small mb-0">suporte@smartlist.com</p>
                        </div>
                        <div class="info-box">
                            <div class="info-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                            <h5 class="fw-bold mb-2">Projeto Acadêmico</h5>
                            <p class="text-muted small mb-0">Desenvolvido como Projeto Integrador para Análise e Desenvolvimento de Sistemas (Senac).</p>
                        </div>
                        <div class="info-box">
                            <div class="info-icon"><i class="fa-solid fa-clock"></i></div>
                            <h5 class="fw-bold mb-2">Atendimento</h5>
                            <p class="text-muted small mb-0">Segunda a Sexta, das 08h às 18h.</p>
                        </div>
                    </div>
                </div>

                <!-- Formulário de Contato -->
                <div class="col-lg-8">
                    <div class="card-contact">
                        <h3 class="fw-bold mb-4" style="color: #8c39eb;">Envie sua mensagem</h3>
                        
                        <form method="post" action="contato.php">
                            <div class="mb-3">
                                <label for="nome" class="form-label text-muted small fw-bold">Seu Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome completo" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label text-muted small fw-bold">Seu E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="seu-email@exemplo.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="assunto" class="form-label text-muted small fw-bold">Assunto</label>
                                <select class="form-select" id="assunto" name="assunto">
                                    <option value="Dúvida sobre o sistema">Dúvida sobre o sistema</option>
                                    <option value="Sugestão de melhoria">Sugestão de melhoria</option>
                                    <option value="Relatar um problema / Bug">Relatar um problema / Bug</option>
                                    <option value="Outro">Outro</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="mensagem" class="form-label text-muted small fw-bold">Mensagem</label>
                                <textarea class="form-control" id="mensagem" name="mensagem" rows="4" placeholder="Escreva sua mensagem detalhadamente aqui..." required></textarea>
                            </div>

                            <button type="submit" class="btn-custom">Enviar Mensagem</button>
                        </form>
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
            <a href="contato.php">Contato</a>
        </div>
    </footer>

</body>
</html>