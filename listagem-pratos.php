<?php
session_start();
require 'logica-autenticacao.php';

$titulo_pagina = "Listagem";
require 'header.php';
require 'conexao/conexao.php';

$sql = "SELECT id, nome, preco, urlimg, descricao FROM pratos ORDER BY id";
$stmt = $conn->query($sql);
?>

<div class="table-responsive">
    <table class="table-striped table">
        <thead class="table-success">
            <tr>
                <th scope="col" style="width: 10%;">ID</th>
                <th scope="col" style="width: 15%;">Nome</th>
                <th scope="col" style="width: 10%;">Preço</th>
                <th scope="col" style="width: 15%;">Imagem</th>
                <th scope="col" style="width: 25%;">Descrição</th>
                <?php
                if (autenticado()) {
                    ?>
                    <th scope="col" style="width: 25%;" colspan="2"></th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>

            <?php
            while ($row = $stmt->fetch()) {
                ?>

                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['nome']; ?></td>
                    <td><?= $row['preco']; ?></td>
                    <td>
                        <a href="<?= $row['urlimg']; ?>">
                            Link imagem
                        </a>
                    </td>
                    <td><?= $row['descricao']; ?></td>
                    <?php
                    if (autenticado()) {
                        ?>
                        <td>
                            <a class="btn btn-sm btn-warning" href="formulario-alterar.php?id=<?= $row['id']; ?>">
                                <span data-feather="edit"></span>
                                Editar
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-danger" href="excluir-prato.php?id=<?= $row['id']; ?>"
                                onclick="if(!confirm('Tem certeza que deseja excluir?')) return false;">
                                <span data-feather="trash-2"></span>
                                Excluir
                            </a>
                        </td>
                        <?php
                    }
                    ?>
                </tr>

                <?php
            }
            ?>

        </tbody>
    </table>
</div>

<?php
require 'footer.php';
?>