<?php
require(__DIR__ . '/../conn/connect.php');

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: index.php"); exit; }

$stmt = $conn->prepare("SELECT * FROM relatorios_estagio WHERE id_relatorio = ?");
$stmt->execute([$id]);
$relatorio = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$relatorio) { header("Location: index.php"); exit; }

$erro = $sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_aluno = $_POST['id_aluno'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $data_entrega = $_POST['data_entrega'] ?? '';
    $status = $_POST['status'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';

    if (empty($id_aluno) || empty($titulo)) {
        $erro = "ID do Aluno e Título são obrigatórios.";
    } else {
        $stmt = $conn->prepare("UPDATE relatorios_estagio SET id_aluno=?, titulo=?, descricao=?, data_entrega=?, status=?, observacoes=? WHERE id_relatorio=?");
        $stmt->execute([$id_aluno, $titulo, $descricao, $data_entrega, $status, $observacoes, $id]);
        $sucesso = "Relatório atualizado com sucesso!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Editar Relatório</title>
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
        width: 90%;
        max-width: 600px;
        margin: 0 auto;
        background: #2A7BD8;
        padding: 30px 25px;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.4);
    }

    form label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    form input, form select, form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 8px;
        border: none;
        font-size: 1rem;
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
        margin-right: 10px;
        font-size: 1rem;
    }

    .btn:hover {
        background: #f0f0f0;
        color: #145DA0;
    }

    .message {
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .error {
        background: #FF4500;
        color: #fff;
    }

    .success {
        background: #32CD32;
        color: #fff;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Editar Relatório</h2>

    <?php if ($erro): ?>
        <div class="message error"><?= $erro ?></div>
    <?php endif; ?>
    <?php if ($sucesso): ?>
        <div class="message success"><?= $sucesso ?></div>
    <?php endif; ?>

    <form method="post">
        <label>ID do Aluno:</label>
        <input type="number" name="id_aluno" value="<?= $relatorio['id_aluno'] ?>" required>

        <label>Título do Relatório:</label>
        <input type="text" name="titulo" value="<?= $relatorio['titulo'] ?>" required>

        <label>Descrição:</label>
        <textarea name="descricao" rows="4"><?= $relatorio['descricao'] ?></textarea>

        <label>Data de Entrega:</label>
        <input type="date" name="data_entrega" value="<?= $relatorio['data_entrega'] ?>" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="pendente" <?= $relatorio['status'] == "pendente" ? "selected" : "" ?>>Pendente</option>
            <option value="avaliado" <?= $relatorio['status'] == "avaliado" ? "selected" : "" ?>>Avaliado</option>
        </select>

        <label>Observações:</label>
        <textarea name="observacoes" rows="4"><?= $relatorio['observacoes'] ?></textarea>

        <button type="submit" class="btn">Salvar Alterações</button>
        <a class="btn" href="index.php">Voltar</a>
        
    </form>
</div>

</body>
</html>

