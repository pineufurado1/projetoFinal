<?php
require(__DIR__ . '/../conn/connect.php');

$nome = $matricula = $curso = $email = "";
$error = $success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $matricula = trim($_POST['matricula'] ?? '');
    $curso = trim($_POST['curso'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nome === '' || $matricula === '') {
        $error = "Nome e matrícula são obrigatórios.";
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO aluno (nome, matricula, curso, email) VALUES (:nome, :matricula, :curso, :email)");
            $stmt->execute([':nome'=>$nome, ':matricula'=>$matricula, ':curso'=>$curso, ':email'=>$email]);
            $success = "Aluno cadastrado com sucesso.";
            $nome = $matricula = $curso = $email = "";
        } catch (PDOException $e) {
            $error = "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Novo Aluno</title>
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
        font-size: 2rem;
    }

    .container {
        width: 90%;
        max-width: 600px;
        margin: 0 auto;
        background: #2A7BD8; /* azul contraste */
        padding: 30px 25px;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.4);
    }

    form label {
        display: block;
        margin-bottom: 15px;
        font-weight: bold;
        color: #fff;
    }

    form input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
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
        color: #1C6EA4;
    }

    .message {
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .error {
        background: #FFA500;
        color: #fff;
    }

    .success {
        background: #32CD32;
        color: #fff;
    }

    .footer-link {
        display: inline-block;
        margin-top: 15px;
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        transition: 0.3s;
    }

    .footer-link:hover {
        color: #cce6ff;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Cadastrar Aluno</h2>

    <?php if($error): ?>
        <div class="message error"><?= $error ?></div>
    <?php endif; ?>

    <?php if($success): ?>
        <div class="message success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Nome:
            <input type="text" name="nome" value="<?= $nome ?>" required>
        </label>
        <label>Matrícula:
            <input type="text" name="matricula" value="<?= $matricula ?>" required>
        </label>
        <label>Curso:
            <input type="text" name="curso" value="<?= $curso ?>" required>
        </label>
        <label>Email:
            <input type="email" name="email" value="<?= $email ?>" required>
        </label>

        <button type="submit" class="btn">Registrar</button>
        <a class="btn" href="index.php">Voltar</a>
    </form>
</div>

</body>
</html>

