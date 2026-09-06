<style>
    .main-header {
        background: linear-gradient(135deg, #b939eb, #8c39eb);
        padding: 25px 30px;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0;
        border-bottom: none;
    }
    .main-header .logo-area {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.30rem;
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
        font-size: 0.95rem;
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
</style>

<header class="main-header">
    <a href="index.php" class="logo-area">
        <p>SMARTLIST</p>
    </a>
    <nav class="header-nav">
        <a href="index.php">Início</a>
        <a href="Sobre.php">Sobre a empresa</a>
        <a href="Contato.php"">Contato</a>
        <a href="cadastro.php">Cadastrar</a>
        <a href="login.php" class="btn-header-login">Acessar minha conta</a>
    </nav>
</header>