<?php

    $notas = [];
    $media = null;
    $situacao = null;
    $erro = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $notas = $_POST['notas'] ?? [];

        if (count($notas) !== 4) {
            $erro = "Informe as quatro notas.";
        } else {
            // Valida cada nota antes de calcular a média.
            foreach ($notas as $nota) {
                if ($nota === '' || !is_numeric($nota) || $nota < 0 || $nota > 10) {
                    $erro = "As notas devem estar entre 0 e 10.";
                    break;
                }
            }

            if ($erro === null) {
                for ($i = 0; $i < count($notas); $i++) {
                    $notas[$i] = (float) $notas[$i];
                }

                $media = array_sum($notas) / count($notas);

                if ($media >= 7) {
                    $situacao = "Aprovado";
                } elseif ($media >= 5) {
                    $situacao = "Recuperação";
                } else {
                    $situacao = "Reprovado";
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
    <title>Resultado da Questão 7</title>
</head>

<body>
    <h1>Resultado do aluno</h1>

    <?php if ($erro !== null): ?>
        <p><strong>Erro:</strong> <?= htmlspecialchars($erro) ?></p>
    <?php else: ?>
        <h2>Notas</h2>
        <ul>
            <?php foreach ($notas as $indice => $nota): ?>
                <li>Nota <?= $indice + 1 ?>: <?= number_format($nota, 2, ',', '.') ?></li>
            <?php endforeach; ?>
        </ul>

        <p><strong>Média:</strong> <?= number_format($media, 2, ',', '.') ?></p>
        <p><strong>Situação:</strong> <?= htmlspecialchars($situacao) ?></p>
    <?php endif; ?>

    <br>
    <a href="index.html">Voltar</a>
</body>

</html>
