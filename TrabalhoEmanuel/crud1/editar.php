<?php
require(__DIR__ . '/../conn/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id'])) {
        header("Location: index.php"); exit;
    }
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM aluno WHERE id_aluno = :id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    if (!$row) { header("Location: index.php"); exit; }
    $nome = $row['nome'];
    $matricula = $row['matricula'];
    $curso = $row['curso'];
    $email = $row['email'];
} else {
    $id = $_POST['id'] ?? null;
    $nome = trim($_POST['nome'] ?? '');
    $matricula = trim($_POST['matricula'] ?? '');
    $curso = trim($_POST['curso'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $error = "";
    if (empty($id) || $nome === '' || $matricula === '') {
        $error = "ID, Nome e Matrícula são obrigatórios.";
    } else {
        try {
            $stmt = $conn->prepare("UPDATE aluno SET nome=:nome, matricula=:matricula, curso=:curso, email=:email WHERE id_aluno=:id");
            $stmt->execute([':nome'=>$nome, ':matricula'=>$matricula, ':curso'=>$curso, ':email'=>$email, ':id'=>$id]);
            header("Location: index.php"); exit;
        } catch (PDOException $e) {
            $error = "Erro ao atualizar: " . $e->getMessage();
        }
    }
}
?>
<<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Editar Aluno</title>
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
        background: #FF8C00;
        color: #fff;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Editar Aluno</h2>

    <?php if(!empty($error)): ?>
        <div class="message error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $nome ?>" required>

        <label>Matrícula:</label>
        <input type="text" name="matricula" value="<?= $matricula ?>" required>

        <label>Curso:</label>
        <input type="text" name="curso" value="<?= $curso ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $email ?>" required>

        <button type="submit" class="btn">Salvar</button>
        <a class="btn" href="index.php">Voltar</a>
    </form>
</div>

</body>
</html>

