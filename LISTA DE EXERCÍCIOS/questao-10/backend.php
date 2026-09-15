<?php

    $matriz = [];
    $somaDiagonal = 0;
    $erro = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Cria três linhas e três colunas com números aleatórios de 1 a 10.
        for ($linha = 0; $linha < 3; $linha++) {
            for ($coluna = 0; $coluna < 3; $coluna++) {
                $matriz[$linha][$coluna] = rand(1, 10);

                // Um elemento pertence à diagonal quando os índices são iguais.
                if ($linha === $coluna) {
                    $somaDiagonal += $matriz[$linha][$coluna];
                }
            }
        }
    } else {
        $erro = "Esta página deve ser acessada pelo formulário.";
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Resultado da Questão 10</title>
</head>

<body>
    <h1>Matriz gerada</h1>

    <?php if ($erro !== null): ?>
        <p><strong>Erro:</strong> <?= htmlspecialchars($erro) ?></p>
    <?php else: ?>
        <table border="1" cellpadding="12">
            <?php for ($linha = 0; $linha < 3; $linha++): ?>
                <tr>
                    <?php for ($coluna = 0; $coluna < 3; $coluna++): ?>
                        <td>
                            <?php if ($linha === $coluna): ?>
                                <strong><?= $matriz[$linha][$coluna] ?></strong>
                            <?php else: ?>
                                <?= $matriz[$linha][$coluna] ?>
                            <?php endif; ?>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>

        <p>Os números em negrito pertencem à diagonal principal.</p>
        <p><strong>Soma da diagonal principal: <?= $somaDiagonal ?></strong></p>
    <?php endif; ?>

    <br>
    <a href="index.html">Voltar</a>
</body>

</html>
