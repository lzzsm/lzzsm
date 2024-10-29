<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = "";
require 'header.php';
?>

<div class="row">
    <div class="col-4 offset-4">
        <br><br>
        <form action="login.php" method="post">
            <h1 class="h3 mb-3 fw-normal">Por favor identifique-se</h1>
            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="email" name="email" required placeholder="Endereço de e-mail">
                <label for="email">Endereço de e-mail</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="senha" name="senha" required placeholder="Senha">
                <label for="senha">Senha</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
        </form>
    </div>
</div>

<?php
require 'footer.php';
?>