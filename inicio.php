<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = "Início";
require 'header.php';
?>

<br>
<p class="display-4">
    Seja bem vindo a aplicação <strong>"Restaurante"</strong>.
</p>
<p class="display-4">
    Esta é a página inicial.
</p>

<?php
if (isset($_SESSION["restrito"]) && $_SESSION["restrito"]) {
    ?>
    <div class="alert alert-danger" role="alert">
        <h4>Esta é uma página PROTEGIDA!</h4>
        <p>Você está tentando acessar um conteúdo restrito</p>
    </div>
    <?php
    unset($_SESSION["restrito"]);
}

require 'footer.php';
?>