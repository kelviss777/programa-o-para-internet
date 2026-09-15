<?php

    $nomes = [];
    $notas1 = [];
    $notas2 = [];
    $alunos = [];
    $erro = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nomes = $_POST['nomes'] ?? [];
        $notas1 = $_POST['notas1'] ?? [];
        $notas2 = $_POST['notas2'] ?? [];

        if (count($nomes) !== 3 || count($notas1) !== 3 || count($notas2) !== 3) {
            $erro = "Informe os dados dos três alunos.";
        } else {
            for ($i = 0; $i < 3; $i++) {
                if (trim($nomes[$i]) === '' ||
                    $notas1[$i] === '' || $notas2[$i] === '' ||
                    !is_numeric($notas1[$i]) || !is_numeric($notas2[$i]) ||
                    $notas1[$i] < 0 || $notas1[$i] > 10 ||
                    $notas2[$i] < 0 || $notas2[$i] > 10) {
                    $erro = "Preencha os nomes e informe notas entre 0 e 10.";
                    break;
                }
            }

            if ($erro === null) {
                // Monta uma matriz em que cada posição representa um aluno.
                for ($i = 0; $i < 3; $i++) {
                    $nota1 = (float) $notas1[$i];
                    $nota2 = (float) $notas2[$i];

                    $alunos[] = [
                        'nome' => trim($nomes[$i]),
                        'nota1' => $nota1,
                        'nota2' => $nota2,
                        'media' => ($nota1 + $nota2) / 2
                    ];
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
    <title>Resultado da Questão 9</title>
</head>

<body>
    <h1>Notas da turma</h1>

    <?php if ($erro !== null): ?>
        <p><strong>Erro:</strong> <?= htmlspecialchars($erro) ?></p>
    <?php else: ?>
        <table border="1" cellpadding="6">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Nota 1</th>
                    <th>Nota 2</th>
                    <th>Média</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno): ?>
                    <tr>
                        <td><?= htmlspecialchars($aluno['nome']) ?></td>
                        <td><?= number_format($aluno['nota1'], 2, ',', '.') ?></td>
                        <td><?= number_format($aluno['nota2'], 2, ',', '.') ?></td>
                        <td><?= number_format($aluno['media'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <br>
    <a href="index.html">Voltar</a>
</body>

</html>
