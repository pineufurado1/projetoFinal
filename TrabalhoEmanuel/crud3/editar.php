<?php
require(__DIR__ . '/../conn/connect.php');

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: index.php"); exit; }

$stmt = $conn->prepare("SELECT * FROM monitores WHERE id_monitor = ?");
$stmt->execute([$id]);
$monitor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$monitor) { header("Location: index.php"); exit; }

$erro = $sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';

    if (empty($nome)) {
        $erro = "Nome obrigatório.";
    } else {
        $stmt = $conn->prepare("UPDATE monitores SET nome=?, email=?, telefone=? WHERE id_monitor=?");
        $stmt->execute([$nome, $email, $telefone, $id]);
        $sucesso = "Dados atualizados!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Editar Monitor</title>
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

    form input {
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
    <h2>Editar Monitor</h2>

    <?php if ($erro): ?>
        <div class="message error"><?= $erro ?></div>
    <?php endif; ?>
    <?php if ($sucesso): ?>
        <div class="message success"><?= $sucesso ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $monitor['nome'] ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $monitor['email'] ?>" required>

        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?= $monitor['telefone'] ?>" required>

        <button type="submit" class="btn">Salvar Alterações</button>
        <a class="btn" href="index.php">Voltar</a>
        
    </form>
</div>

</body>
</html>

