<?php
session_start();
require 'logica-autenticacao.php';

if (!autenticado()) {
    $_SESSION["restrito"] = true;
    redireciona();
    die();
}

$titulo_pagina = "Formulário de inserção de pratos";
require 'header.php';

    ?>
    <form action="inserir-prato.php" method="post">
        <div class="row">
            <div class="col-8">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" step="0.1" class="form-control" id="preco" name="preco" required>
                </div>
                <div class="mb-3">
                    <label for="urlimg" class="form-label">URL de uma foto do prato</label>
                    <input type="url" class="form-control" aria-describedby="url_imageHelp" id="urlimg" name="urlimg"
                        required>
                    <div class="form-text" id="url_imageHelp">
                        Endereço http de uma imagem da internet
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição detalhada</label>
                    <textarea class="form-control" id="descricao" name="descricao"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gravar</button>
                <button type="reset" class="btn btn-warning">Cancelar</button>
            </div>
        </div>
    </form>
    <?php

require 'footer.php';
?>