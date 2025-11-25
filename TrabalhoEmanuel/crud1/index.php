<?php
require(__DIR__ . '/../conn/connect.php');

try {
    $stmt = $conn->query("SELECT * FROM aluno ORDER BY nome ASC");
    $alunos = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erro ao buscar alunos: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Alunos</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #1E90FF; /* azul principal */
        margin: 0;
        padding: 0;
        color: #fff;
    }

    h2 {
        text-align: center;
        margin: 40px 0 20px 0;
        font-size: 2.2rem;
    }

    .container {
        width: 90%;
        max-width: 1100px;
        margin: 0 auto;
        background: #2A7BD8; /* azul contraste */
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.4);
    }

    /* Botões principais */
    .btn {
        display: inline-block;
        background: #fff;
        color: #1E90FF;
        font-weight: bold;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
        margin-bottom: 15px;
    }

    .btn:hover {
        background: #f0f0f0;
        color: #1C6EA4;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border-radius: 10px;
        overflow: hidden;
    }

    table th, table td {
        padding: 12px 15px;
        text-align: left;
    }

    table th {
        background-color: #145DA0;
        font-size: 1rem;
    }

    table tr:nth-child(even) {
        background-color: #1C6EA4;
    }

    table tr:hover {
        background-color: #1473E6;
    }

    /* Botões da tabela */
    .actions .btn {
        padding: 5px 12px;
        font-size: 0.9rem;
        margin-right: 5px;
    }

    .footer-link {
        display: block;
        text-align: center;
        margin-top: 25px;
        color: #fff;
        text-decoration: underline;
    }

    .footer-link:hover {
        color: #cce6ff;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Lista de Alunos</h2>

    <a class="btn" href="criar.php">Novo Aluno</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Matrícula</th>
                <th>Curso</th>
                <th>Email</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($alunos)): ?>
            <tr><td colspan="6">Nenhum aluno cadastrado.</td></tr>
        <?php else: ?>
            <?php foreach ($alunos as $a): ?>
            <tr>
                <td><?= $a['id_aluno'] ?></td>
                <td><?= $a['nome'] ?></td>
                <td><?= $a['matricula'] ?></td>
                <td><?= $a['curso'] ?></td>
                <td><?= $a['email'] ?></td>
                <td class="actions">
                    <a class="btn" href="editar.php?id=<?= urlencode($a['id_aluno']) ?>">Editar</a>
                    <a class="btn" href="deletar.php?id=<?= urlencode($a['id_aluno']) ?>" onclick="return confirm('excluir mesmo?')">Deletar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <a class="footer-link" href="../">Voltar</a>
</div>

</body>
</html>

