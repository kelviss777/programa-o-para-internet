<?php

    $investimento = null;
    $taxa = null;
    $meses = null;
    $saldo = null;
    $saldosMensais = [];
    $erro = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $investimento = $_POST['investimento'] ?? null;
        $taxa = $_POST['taxa'] ?? null;
        $meses = $_POST['meses'] ?? null;

        if ($investimento === null || $investimento === '' ||
            $taxa === null || $taxa === '' ||
            $meses === null || $meses === '') {
            $erro = "Preencha todos os campos.";
        } elseif (!is_numeric($investimento) || !is_numeric($taxa) ||
                  $investimento <= 0 || $taxa < 0 ||
                  filter_var($meses, FILTER_VALIDATE_INT) === false || $meses <= 0) {
            $erro = "Informe um investimento positivo, uma taxa válida e uma quantidade inteira de meses.";
        } else {
            $investimento = (float) $investimento;
            $taxa = (float) $taxa;
            $meses = (int) $meses;
            $saldo = $investimento;

            // A cada repetição, os juros do mês são acrescentados ao saldo.
            for ($mes = 1; $mes <= $meses; $mes++) {
                $saldo = $saldo + ($saldo * ($taxa / 100));
                $saldosMensais[] = $saldo;
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
    <title>Resultado da Questão 5</title>
</head>

<body>
    <h1>Resultado do investimento</h1>

    <?php if ($erro !== null): ?>
        <p><strong>Erro:</strong> <?= htmlspecialchars($erro) ?></p>
    <?php else: ?>
        <p><strong>Investimento inicial:</strong> R$ <?= number_format($investimento, 2, ',', '.') ?></p>
        <p><strong>Taxa mensal:</strong> <?= number_format($taxa, 2, ',', '.') ?>%</p>

        <h2>Saldo mês a mês</h2>
        <?php foreach ($saldosMensais as $indice => $saldoDoMes): ?>
            <p>Mês <?= $indice + 1 ?>: R$ <?= number_format($saldoDoMes, 2, ',', '.') ?></p>
        <?php endforeach; ?>

        <p><strong>Saldo final:</strong> R$ <?= number_format($saldo, 2, ',', '.') ?></p>
    <?php endif; ?>

    <br>
    <a href="index.html">Voltar</a>
</body>

</html>
