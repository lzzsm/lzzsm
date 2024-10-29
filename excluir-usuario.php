<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = "Página de exclusão de usuários";
require 'header.php';
require 'conexao/conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$sql = "DELETE FROM usuarios WHERE id = ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);
$count = $stmt->rowCount();
?>
<p class="display-12"><strong>ID:</strong> <?= $id; ?></p>


<?php
if ($result == true && $count >= 1) {
    echo '<div class="alert alert-success" role="alert">
    <h4>Registro excluído com sucesso!</h4></div>';
} elseif ($count == 0) {
    ?>
    <div class="alert alert-danger" role="alert">
        <h4>Falha ao efetuar exclusão</h4>
        <p>Não foi encontrado nenhum registro com o ID = <?= $id; ?></p>
    </div>
    <?php
} else {
    $errorArray = $stmt->errorInfo();
    ?>
    <div class="alert alert-danger" role="alert">
        <h4>Falha ao efetuar exclusão</h4>
        <p><?= $errorArray[2]; ?></p>
    </div>
    <?php
}

require 'footer.php';
?>