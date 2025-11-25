<?php
require(__DIR__ . '/../conn/connect.php');

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_aluno = $_POST["id_aluno"] ?? "";
    $apostila = $_POST["apostila"] ?? "";
    $horas_validadas = $_POST["horas_validadas"] ?? "";
    $data_validacao = $_POST["data_validacao"] ?? "";
    $status = $_POST["status"] ?? "";
    $observacoes = $_POST["observacoes"] ?? "";
    

    if (empty($id_aluno) || empty($apostila) || empty($horas_validadas) || empty($data_validacao) || empty($status)) {
        $erro = "Preencha todos os campos obrigatórios.";
    } else {
        $sql = "INSERT INTO inscricao_atividade (id_aluno, apostila, horas_validadas, data_validacao, status, observacoes)
                VALUES (:id_aluno, :apostila, :horas_validadas, :data_validacao, :status, :observacoes)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->bindParam(':apostila', $apostila);
        $stmt->bindParam(':horas_validadas', $horas_validadas);
        $stmt->bindParam(':data_validacao', $data_validacao);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':observacoes', $observacoes);

        if ($stmt->execute()) {
            $sucesso = "Registrado.";
        } else {
            $erro = "Erro.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Adicionar Registro de Atividade</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #1E90FF; /* fundo azul */
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
        max-width: 650px;
        margin: 0 auto;
        background: #2471A3; /* azul mais escuro para contraste */
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

    .footer {
        text-align: center;
        margin-top: 20px;
    }

</style>
</head>
<body>

<div class="container">
    <h2>Adicionar Registro de Atividade</h2>

    <div class="footer">
        <a class="btn" href="index.php">Voltar</a>
    </div>

    <?php if (!empty($erro)): ?>
        <div class="message error"><?= $erro ?></div>
    <?php endif; ?>

    <?php if (!empty($sucesso)): ?>
        <div class="message success"><?= $sucesso ?></div>
    <?php endif; ?>

    <form method="post">
        <label>ID do Aluno:</label>
        <input type="number" name="id_aluno" required>

        <label>Apostila:</label>
        <select name="apostila" required>
            <option value="">Selecione</option>
            <option value="Apostila 6° Período">Apostila 6° Período</option>
            <option value="Apostila 5° Período">Apostila 5° Período</option>
            <option value="Apostila 4° Período">Apostila 4° Período</option>
            <option value="Apostila 3° Período">Apostila 3° Período</option>
            <option value="Apostila 2° Período">Apostila 2° Período</option>
            <option value="Apostila 1° Período">Apostila 1° Período</option>
        </select>

        <label>Horas Validadas:</label>
        <select name="horas_validadas" required>
            <option value="">Selecione</option>
            <option value="1">1 hora</option>
            <option value="2">2 horas</option>
            <option value="3">3 horas</option>
            <option value="4">4 horas</option>
            <option value="5">5 horas</option>
        </select>

        <label>Data de Validação:</label>
        <input type="date" name="data_validacao" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="">Selecione</option>
            <option value="pendente">Pendente</option>
            <option value="validada">Validada</option>
        </select>

        <label>Observações:</label>
        <textarea name="observacoes" rows="4"></textarea>

        <button type="submit" class="btn">Registrar</button>
    </form>
</div>

</body>
</html>
