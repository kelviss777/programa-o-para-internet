<?php

    // Os colchetes dos nomes dos inputs fazem o PHP receber arrays.
    $idades = [];
    $alturas = [];
    $maiorAltura = null;
    $menorAltura = null;
    $somaAlturasMaiores = 0;
    $quantidadeMaiores = 0;
    $mediaAlturasMaiores = null;
    $erro = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idades = $_POST['idades'] ?? [];
        $alturas = $_POST['alturas'] ?? [];

        if (count($idades) !== 10 || count($alturas) !== 10) {
            $erro = "Informe a idade e a altura das 10 pessoas.";
        } else {
            // Primeiro valida todos os valores enviados.
            for ($i = 0; $i < 10; $i++) {
                if ($idades[$i] === '' || $alturas[$i] === '' ||
                    filter_var($idades[$i], FILTER_VALIDATE_INT) === false ||
                    !is_numeric($alturas[$i]) || $idades[$i] < 0 || $alturas[$i] <= 0) {
                    $erro = "Preencha todas as idades e alturas com valores válidos.";
                    break;
                }
            }

            if ($erro === null) {
                for ($i = 0; $i < 10; $i++) {
                    $idades[$i] = (int) $idades[$i];
                    $alturas[$i] = (float) $alturas[$i];

                    // Na primeira pessoa, a altura inicia os valores maior e menor.
                    if ($i === 0) {
                        $maiorAltura = $alturas[$i];
                        $menorAltura = $alturas[$i];
                    } else {
                        if ($alturas[$i] > $maiorAltura) {
                            $maiorAltura = $alturas[$i];
                        }

                        if ($alturas[$i] < $menorAltura) {
                            $menorAltura = $alturas[$i];
                        }
                    }

                    if ($idades[$i] > 18) {
                        $somaAlturasMaiores += $alturas[$i];
                        $quantidadeMaiores++;
                    }
                }

                if ($quantidadeMaiores > 0) {
                    $mediaAlturasMaiores = $somaAlturasMaiores / $quantidadeMaiores;
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
    <title>Resultado da Questão 6</title>
</head>

<body>
    <h1>Estatísticas das pessoas</h1>

    <?php if ($erro !== null): ?>
        <p><strong>Erro:</strong> <?= htmlspecialchars($erro) ?></p>
    <?php else: ?>
        <p><strong>Maior altura:</strong> <?= number_format($maiorAltura, 2, ',', '.') ?> m</p>
        <p><strong>Menor altura:</strong> <?= number_format($menorAltura, 2, ',', '.') ?> m</p>

        <?php if ($mediaAlturasMaiores !== null): ?>
            <p><strong>Média de altura das pessoas com mais de 18 anos:</strong>
                <?= number_format($mediaAlturasMaiores, 2, ',', '.') ?> m</p>
        <?php else: ?>
            <p>Nenhuma pessoa informada possui mais de 18 anos.</p>
        <?php endif; ?>
    <?php endif; ?>

    <br>
    <a href="index.html">Voltar</a>
</body>

</html>
