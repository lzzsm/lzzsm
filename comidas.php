<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = "Comidas";
require 'header.php';
require 'conexao/conexao.php';

$sql = "SELECT id, nome, preco, urlimg, descricao FROM pratos ORDER BY id";
$stmt = $conn->query($sql);
?>

<style>
    .card {
        border-left: solid 2px black;
        border-top: solid 2px black;
        border-right: solid 2px black;
        border-radius: 15px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .card-bottom {
        border-left: solid 2px black;
        border-bottom: solid 2px black;
        border-right: solid 2px black;
        border-radius: 15px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

<div class="d-flex w-100 flex-wrap">

    <?php
    while ($row = $stmt->fetch()) {
        ?>

        <div class="d-flex flex-column w-25 p-3">
            <div>
                <img class="card" src="<?= $row['urlimg']; ?>" alt="foto do prato" width="100%">
            </div>

            <div class="card-bottom p-2">
                <h2 style="overflow-wrap:break-word"><?= $row["nome"]; ?></h2>

                <span style="width:100%;overflow-wrap:break-word"><?= $row["descricao"]; ?></span>
                <hr style="width:100%;justify-content:end;display:flex">Preço: <b>R$ <?= $row["preco"]; ?></b>
            </div>
        </div>

        <?php
    }
    ?>

</div>

<?php
require 'footer.php';
?>