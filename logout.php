<?php
    session_start();
    //Deleta as variáveis de sessão
    unset($_SESSION['logado']);
    //Finaliza a sessão
    session_destroy();
    sleep(2); //Aguarda 2 segundos
    header("location:login.php"); 
?>