<?php
require(__DIR__ . '/../conn/connect.php');

$id_aluno = $titulo = $descricao = $data_entrega = $status = $observacoes = "";
$erro = $sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_aluno = $_POST['id_aluno'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $data_entrega = $_POST['data_entrega'] ?? '';
    $status = $_POST['status'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';

    if (empty($id_aluno) || empty($titulo)) {
        $erro = "O campo ID do Aluno e Título são obrigatórios.";
    } else {
        $stmt = $conn->prepare("INSERT INTO relatorios_estagio (id_aluno, titulo, descricao, data_entrega, status, observacoes) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_aluno, $titulo, $descricao, $data_entrega, $status, $observacoes]);
        $sucesso = "Relatório cadastrado com sucesso!";
        $id_aluno = $titulo = $descricao = $data_entrega = $status = $observacoes = "";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastrar Novo Relatório</title>
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

    textarea {
        resize: vertical;
        min-height: 80px;
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
    <h2>Cadastrar Novo Relatório</h2>

    <?php if ($erro): ?>
        <div class="message error"><?= $erro ?></div>
    <?php endif; ?>
    <?php if ($sucesso): ?>
        <div class="message success"><?= $sucesso ?></div>
    <?php endif; ?>

    <form method="post">
        <label>ID do Aluno:</label>
        <input type="number" name="id_aluno" value="<?= $id_aluno ?>" required>

        <label>Título do Relatório:</label>
        <input type="text" name="titulo" value="<?= $titulo ?>" required>

        <label>Descrição:</label>
        <textarea name="descricao"><?= $descricao ?></textarea>

        <label>Data de Entrega:</label>
        <input type="date" name="data_entrega" value="<?= $data_entrega ?>" required>

        <label>Status:</label>
        <select name="status">
            <option value="pendente" <?= $status == "pendente" ? "selected" : "" ?>>Pendente</option>
            <option value="avaliado" <?= $status == "avaliado" ? "selected" : "" ?>>Avaliado</option>
        </select>

        <label>Observações:</label>
        <textarea name="observacoes"><?= $observacoes ?></textarea>

        <button type="submit" class="btn">Salvar</button>
        <a href="index.php" class="btn">Voltar</a>
    </form>
</div>

</body>
</html>
