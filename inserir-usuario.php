<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = "Destino do Formulário (inserção)";
require 'header.php';
require 'conexao/conexao.php';

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, "senha");
$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

$sql = "INSERT INTO usuarios(nome, email, senha) VALUES (?,?,?)";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$nome, $email, $senha_hash]);
?>

<p class="display-12"><strong>Nome:</strong> <?= $nome; ?></p>
<p class="display-12"><strong>E-mail:</strong> <?= $email; ?></p>
<p class="display-12"><strong>Senha hash:</strong> <?= $senha_hash; ?></p>

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