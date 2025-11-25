<?php
require(__DIR__ . '/../conn/connect.php');

$sql = "SELECT * FROM relatorios_estagio ORDER BY id_relatorio DESC";
$stmt = $conn->query($sql);
$relatorios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Relatórios de Estágio</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #1E90FF;
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
        max-width: 1100px;
        margin: 0 auto;
        background: #2A7BD8;
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
        background: #1C6EA4;
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
        background-color: #1A5FA0;
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
    <h2>Relatórios de Estágio</h2>

    <a href="criar.php" class="btn">Adicionar Relatório</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Aluno</th>
                <th>Título</th>
                <th>Data de Entrega</th>
                <th>Status</th>
                <th>Observações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($relatorios) > 0): ?>
                <?php foreach ($relatorios as $r): ?>
                    <tr>
                        <td><?= $r['id_relatorio'] ?></td>
                        <td><?= $r['id_aluno'] ?></td>
                        <td><?= $r['titulo'] ?></td>
                        <td><?= $r['data_entrega'] ?></td>
                        <td><?= $r['status'] ?></td>
                        <td><?= nl2br($r['observacoes']) ?></td>
                        <td class="actions">
                            <a href="editar.php?id=<?= $r['id_relatorio'] ?>" class="btn">Editar</a>
                            <a href="deletar.php?id=<?= $r['id_relatorio'] ?>" class="btn" onclick="return confirm('Excluir mesmo?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">Nenhum relatório cadastrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
