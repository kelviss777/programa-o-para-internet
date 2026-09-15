<?php

    // A tabuada é uma consulta simples, por isso o valor é recebido por GET.
    $numero = null;
    $erro = null;

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $numero = $_GET['numero'] ?? null;

        if ($numero === null || $numero === '') {
            $erro = "Informe um número inteiro.";
        } elseif (filter_var($numero, FILTER_VALIDATE_INT) === false) {
            $erro = "O valor informado deve ser um número inteiro.";
        } else {
            $numero = (int) $numero;
        }
    } else {
        $erro = "Esta página deve ser acessada pelo formulário.";
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Resultado da Questão 4</title>
</head>

<body>
    <h1>Tabuada do número <?= $erro === null ? htmlspecialchars((string) $numero) : '' ?></h1>

    <?php if ($erro !== null): ?>
        <p><strong>Erro:</strong> <?= htmlspecialchars($erro) ?></p>
    <?php else: ?>
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <p><?= $numero ?> x <?= $i ?> = <?= $numero * $i ?></p>
        <?php endfor; ?>
    <?php endif; ?>

    <br>
    <a href="index.html">Voltar</a>
</body>

</html>
