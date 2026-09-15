<?php

    // A posição de cada venda corresponde à mesma posição no array de dias.
    $dias = ["Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado", "Domingo"];
    $vendas = [];
    $totalVendido = null;
    $mediaSemanal = null;
    $diaMaiorFaturamento = null;
    $maiorFaturamento = null;
    $diasAcimaDaMedia = 0;
    $erro = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $vendas = $_POST['vendas'] ?? [];

        if (count($vendas) !== 7) {
            $erro = "Informe o faturamento dos sete dias.";
        } else {
            foreach ($vendas as $venda) {
                if ($venda === '' || !is_numeric($venda) || $venda < 0) {
                    $erro = "Os valores de faturamento devem ser números maiores ou iguais a zero.";
                    break;
                }
            }

            if ($erro === null) {
                for ($i = 0; $i < count($vendas); $i++) {
                    $vendas[$i] = (float) $vendas[$i];
                }

                $totalVendido = array_sum($vendas);
                $mediaSemanal = $totalVendido / count($vendas);

                // Inicia a comparação usando a venda do primeiro dia.
                $maiorFaturamento = $vendas[0];
                $diaMaiorFaturamento = $dias[0];

                for ($i = 0; $i < count($vendas); $i++) {
                    if ($vendas[$i] > $maiorFaturamento) {
                        $maiorFaturamento = $vendas[$i];
                        $diaMaiorFaturamento = $dias[$i];
                    }

                    if ($vendas[$i] > $mediaSemanal) {
                        $diasAcimaDaMedia++;
                    }
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
    <title>Resultado da Questão 8</title>
</head>

<body>
    <h1>Análise do faturamento semanal</h1>

    <?php if ($erro !== null): ?>
        <p><strong>Erro:</strong> <?= htmlspecialchars($erro) ?></p>
    <?php else: ?>
        <table border="1" cellpadding="6">
            <thead>
                <tr>
                    <th>Dia</th>
                    <th>Faturamento</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($dias); $i++): ?>
                    <tr>
                        <td><?= htmlspecialchars($dias[$i]) ?></td>
                        <td>R$ <?= number_format($vendas[$i], 2, ',', '.') ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <p><strong>Total vendido:</strong> R$ <?= number_format($totalVendido, 2, ',', '.') ?></p>
        <p><strong>Média semanal:</strong> R$ <?= number_format($mediaSemanal, 2, ',', '.') ?></p>
        <p><strong>Dia com maior faturamento:</strong> <?= htmlspecialchars($diaMaiorFaturamento) ?>
            (R$ <?= number_format($maiorFaturamento, 2, ',', '.') ?>)</p>
        <p><strong>Dias acima da média:</strong> <?= $diasAcimaDaMedia ?></p>
    <?php endif; ?>

    <br>
    <a href="index.html">Voltar</a>
</body>

</html>
