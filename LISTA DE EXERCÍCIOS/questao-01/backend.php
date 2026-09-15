<?php

    // Variáveis utilizadas para guardar os dados e o resultado.
    $valorCompra = null;
    $codigoCliente = null;
    $tipoCliente = null;
    $percentualDesconto = null;
    $valorDesconto = null;
    $valorFinal = null;
    $erro = null;

    // O formulário desta questão envia os dados pelo método POST.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $valorCompra = $_POST['valor'] ?? null;
        $codigoCliente = $_POST['codigo'] ?? null;

        // Verifica se os campos obrigatórios foram preenchidos.
        if ($valorCompra === null || $valorCompra === '' ||
            $codigoCliente === null || $codigoCliente === '') {
            $erro = "Preencha todos os campos.";
        } elseif (!is_numeric($valorCompra) || $valorCompra <= 0) {
            $erro = "Informe um valor de compra maior que zero.";
        } else {
            $valorCompra = (float) $valorCompra;

            // Define o desconto de acordo com o código do cliente.
            switch ($codigoCliente) {
                case '1':
                    $tipoCliente = "Cliente Comum";
                    $percentualDesconto = 5;
                    break;
                case '2':
                    $tipoCliente = "VIP";
                    $percentualDesconto = 10;
                    break;
                case '3':
                    $tipoCliente = "Funcionário";
                    $percentualDesconto = 15;
                    break;
                default:
                    $erro = "Código de cliente inválido.";
            }

            if ($erro === null) {
                $valorDesconto = $valorCompra * ($percentualDesconto / 100);
                $valorFinal = $valorCompra - $valorDesconto;
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
    <title>Resultado da Questão 1</title>
</head>

<body>
    <h1>Resultado do desconto</h1>

    <?php if ($erro !== null): ?>
        <p><strong>Erro:</strong> <?= htmlspecialchars($erro) ?></p>
    <?php else: ?>
        <p><strong>Tipo de cliente:</strong> <?= htmlspecialchars($tipoCliente) ?></p>
        <p><strong>Valor original:</strong> R$ <?= number_format($valorCompra, 2, ',', '.') ?></p>
        <p><strong>Percentual de desconto:</strong> <?= $percentualDesconto ?>%</p>
        <p><strong>Valor do desconto:</strong> R$ <?= number_format($valorDesconto, 2, ',', '.') ?></p>
        <p><strong>Valor final a pagar:</strong> R$ <?= number_format($valorFinal, 2, ',', '.') ?></p>
    <?php endif; ?>

    <br>
    <a href="index.html">Voltar</a>
</body>

</html>
