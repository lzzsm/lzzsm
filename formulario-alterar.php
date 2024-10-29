<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = "Formulário de alteração de pratos";
require 'header.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    ?>
    <div class="alert alert-danger" role="alert">
        <h4>Falha ao abrir formulário para edição</h4>
        <p>ID do produto está vazio</p>
    </div>
    <?php
    exit;
}

require 'conexao/conexao.php';

$sql = "SELECT nome, preco, urlimg, descricao FROM pratos WHERE id = ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);

$rowPrato = $stmt->fetch();
?>

<form action="alterar-prato.php" method="post">
    <input type="hidden" name="id" id="id" value="<?= $id; ?>">
    <div class="row">
        <div class="col-8">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required value="<?= $rowPrato['nome']; ?>">
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" step="0.1" class="form-control" id="preco" name="preco" required value="<?= $rowPrato['preco']; ?>">
            </div>
            <div class="mb-3">
                <label for="urlimg" class="form-label">URL de uma foto do prato</label>
                <input type="url" class="form-control" aria-describedby="url_imageHelp" id="urlimg" name="urlimg" value="<?= $rowPrato['urlimg']; ?>">
                    required>
                <div class="form-text" id="url_imageHelp">
                    Endereço http de uma imagem da internet
                </div>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição detalhada</label>
                <textarea class="form-control" id="descricao" name="descricao"><?= $rowPrato['descricao']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gravar</button>
            <button type="reset" class="btn btn-warning">Cancelar</button>
        </div>
        <div class="col-3">
            <img class="img-thumbnail" src="<?= $rowPrato['urlimg']; ?>" alt="<?= $rowPrato['nome']; ?>" id="img-preview">
        </div>
    </div>
</form>

<?php
require 'footer.php';
?>