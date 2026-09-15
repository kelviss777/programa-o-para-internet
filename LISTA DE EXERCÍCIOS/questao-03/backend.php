<?php

    // Recebe o peso e a altura enviados pelo formulário.
    $peso = null;
    $altura = null;
    $imc = null;
    $categoria = null;
    $erro = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $peso = $_POST['peso'] ?? null;
        $altura = $_POST['altura'] ?? null;

        if ($peso === null || $peso === '' || $altura === null || $altura === '') {
            $erro = "Preencha todos os campos.";
        } elseif (!is_numeric($peso) || !is_numeric($altura) || $peso <= 0 || $altura <= 0) {
            $erro = "Peso e altura devem ser números maiores que zero.";
        } else {
            $peso = (float) $peso;
            $altura = (float) $altura;

            // Aplica a fórmula do índice de massa corporal.
            $imc = $peso / ($altura * $altura);

            if ($imc < 18.5) {
                $categoria = "Abaixo do peso";
            } elseif ($imc < 25) {
                $categoria = "Peso normal";
            } elseif ($imc < 30) {
                $categoria = "Sobrepeso";
            } else {
                $categoria = "Obesidade";
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
    <title>Resultado da Questão 3</title>
</head>

<body>
    <h1>Resultado do IMC</h1>

    <?php if ($erro !== null): ?>
        <p><strong>Erro:</strong> <?= htmlspecialchars($erro) ?></p>
    <?php else: ?>
        <p><strong>IMC:</strong> <?= number_format($imc, 2, ',', '.') ?></p>
        <p><strong>Categoria:</strong> <?= htmlspecialchars($categoria) ?></p>
    <?php endif; ?>

    <br>
    <a href="index.html">Voltar</a>
</body>

</html>
