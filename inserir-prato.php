<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = "Destino do Formulário (inserção)";
require 'header.php';
require 'conexao/conexao.php';

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_SPECIAL_CHARS);
$urlimg = filter_input(INPUT_POST, "urlimg", FILTER_SANITIZE_URL);
$descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "INSERT INTO pratos(nome, preco, urlimg, descricao) VALUES (?,?,?,?)";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$nome, $preco, $urlimg, $descricao]);
?>

<p class="display-12"><strong>Nome:</strong> <?= $nome; ?></p>
<p class="display-12"><strong>Preço:</strong> <?= $preco; ?></p>
<p class="display-12"><strong>URL da Imagem:</strong> <?= $urlimg; ?></p>
<p class="display-12"><strong>Descrição do produto:</strong> <?= $descricao; ?></p>

<?php
if ($result == true) {
    echo '<div class="alert alert-success" role="alert">
    <h4>Dados gravados com sucesso!</h4></div>';
} else {
    $errorArray = $stmt->errorInfo();
    ?>
    <div class="alert alert-danger" role="alert">
        <h4>Falha ao efetuar gravação</h4>
        <p><?= $errorArray[2]; ?></p>
    </div>
    <?php
}

require 'footer.php';
?>