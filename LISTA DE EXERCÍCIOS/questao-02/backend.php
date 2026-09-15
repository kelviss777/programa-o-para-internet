<?php

    // Variáveis utilizadas para receber os três lados.
    $lado1 = null;
    $lado2 = null;
    $lado3 = null;
    $classificacao = null;
    $erro = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $lado1 = $_POST['lado1'] ?? null;
        $lado2 = $_POST['lado2'] ?? null;
        $lado3 = $_POST['lado3'] ?? null;

        if ($lado1 === null || $lado1 === '' ||
            $lado2 === null || $lado2 === '' ||
            $lado3 === null || $lado3 === '') {
            $erro = "Preencha todos os campos.";
        } elseif (!is_numeric($lado1) || !is_numeric($lado2) || !is_numeric($lado3) ||
                  $lado1 <= 0 || $lado2 <= 0 || $lado3 <= 0) {
            $erro = "Os lados devem ser números maiores que zero.";
        } else {
            $lado1 = (float) $lado1;
            $lado2 = (float) $lado2;
            $lado3 = (float) $lado3;

            // Para formar um triângulo, a soma de quaisquer dois lados
            // precisa ser maior que o terceiro lado.
            if (($lado1 + $lado2 > $lado3) &&
                ($lado1 + $lado3 > $lado2) &&
                ($lado2 + $lado3 > $lado1)) {

                if ($lado1 == $lado2 && $lado2 == $lado3) {
                    $classificacao = "Equilátero";
                } elseif ($lado1 == $lado2 || $lado1 == $lado3 || $lado2 == $lado3) {
                    $classificacao = "Isósceles";
                } else {
                    $classificacao = "Escaleno";
                }
            } else {
                $erro = "Os valores informados não formam um triângulo válido.";
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
    <title>Resultado da Questão 2</title>
</head>

<body>
    <h1>Resultado da classificação</h1>

    <?php if ($erro !== null): ?>
        <p><strong>Erro:</strong> <?= htmlspecialchars($erro) ?></p>
    <?php else: ?>
        <p>Os lados informados formam um triângulo <strong><?= htmlspecialchars($classificacao) ?></strong>.</p>
    <?php endif; ?>

    <br>
    <a href="index.html">Voltar</a>
</body>

</html>
