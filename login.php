<?php
session_start();
require 'logica-autenticacao.php';

if (autenticado()) {
    redireciona();
    die();
}

$titulo_pagina = "Página destino da autenticação (LOGIN)";
require 'header.php';
require 'conexao/conexao.php';

$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "SELECT nome, senha FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt -> execute([$email]);
$row = $stmt->fetch()
?>

<p class="display-12"><strong>Email:</strong> <?= $email; ?></p>

<?php
if (password_verify($senha, $row['senha'])) {
    $_SESSION["email"] = $email;
    $_SESSION["nome"] = $row['nome'];
?>
    <div class="alert alert-success" role="alert">
        <h4>Autenticado com sucesso</h4>
    </div>
<?php
} else {
    unset($_SESSION["email"]);
    unset($_SESSION["nome"]);
?>
    <div class="alert alert-danger" role="alert">
        <h4>Falha ao efetuar autenticação</h4>
        <p>Usuário ou senha incorretos</p>
    </div>
<?php
}

require 'footer.php';
?>