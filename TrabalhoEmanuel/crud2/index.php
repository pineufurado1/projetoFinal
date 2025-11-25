<?php
require(__DIR__ . '/../conn/connect.php');

$sql = "SELECT * FROM inscricao_atividade ORDER BY id_inscricao DESC";
$stmt = $conn->query($sql);
$registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Atividades de Estágio</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #1E90FF; /* fundo azul */
        color: #fff;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        margin: 40px 0 20px 0;
        font-size: 2rem;
    }

    .container {
        width: 95%;
        max-width: 1200px;
        margin: 0 auto;
        background: #2A7BD8; /* azul contraste */
        padding: 25px 20px;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.4);
    }

    .btn {
        display: inline-block;
        background: #fff;
        color: #1E90FF;
        font-weight: bold;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: 0.3s;
        margin-bottom: 15px;
        font-size: 1rem;
    }

    .btn:hover {
        background: #f0f0f0;
        color: #145DA0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        padding: 12px 15px;
        text-align: left;
    }

    table th {
        background-color: #145DA0;
    }

    table tr:nth-child(even) {
        background-color: #1C6EA4;
    }

    table tr:hover {
        background-color: #1473E6;
    }

    .actions .btn {
        padding: 5px 12px;
        font-size: 0.9rem;
        margin-right: 5px;
    }

    .footer-link {
        display: block;
        text-align: center;
        margin-top: 20px;
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
    <h2>Lista de Atividades de Estágio</h2>

    <a class="btn" href="criar.php">Registrar Nova Atividade</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID do Aluno</th>
                <th>Apostila</th>
                <th>Horas Validadas</th>
                <th>Data de Validação</th>
                <th>Status</th>
                <th>Observações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($registros) > 0): ?>
                <?php foreach ($registros as $r): ?>
                    <tr>
                        <td><?= $r['id_inscricao'] ?></td>
                        <td><?= $r['id_aluno'] ?></td>
                        <td><?= $r['apostila'] ?></td>
                        <td><?= $r['horas_validadas'] ?> hora(s)</td>
                        <td><?= $r['data_validacao'] ?></td>
                        <td><?= $r['status'] ?></td>
                        <td><?= nl2br($r['observacoes']) ?></td>
                        <td class="actions">
                            <a class="btn" href="editar.php?id=<?= $r['id_inscricao'] ?>">Editar</a>
                            <a class="btn" href="deletar.php?id=<?= $r['id_inscricao'] ?>" onclick="return confirm('Tem certeza que deseja excluir este registro?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">Nenhum registro encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
