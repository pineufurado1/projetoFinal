<?php
require(__DIR__ . '/../conn/connect.php');

$erro = "";
$sucesso = "";

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = $_GET["id"];

$sql = "SELECT * FROM inscricao_atividade WHERE id_inscricao = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$registro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$registro) {
    header("Location: index.php");
    exit;
}

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
        $sql = "UPDATE inscricao_atividade 
                SET id_aluno=:id_aluno, apostila=:apostila, horas_validadas=:horas_validadas,
                    data_validacao=:data_validacao, status=:status, observacoes=:observacoes
                WHERE id_inscricao=:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->bindParam(':apostila', $apostila);
        $stmt->bindParam(':horas_validadas', $horas_validadas);
        $stmt->bindParam(':data_validacao', $data_validacao);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':observacoes', $observacoes);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            $sucesso = "Registro atualizado com sucesso!";
            $registro = [
                'id_aluno' => $id_aluno,
                'apostila' => $apostila,
                'horas_validadas' => $horas_validadas,
                'data_validacao' => $data_validacao,
                'status' => $status,
                'observacoes' => $observacoes
            ];
        } else {
            $erro = "Erro ao atualizar registro.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Editar Registro de Atividade</title>
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
    <h2>Editar Registro de Atividade</h2>

    <a class="btn" href="index.php">Voltar</a>

    <?php if (!empty($erro)): ?>
        <div class="message error"><?= $erro ?></div>
    <?php endif; ?>
    <?php if (!empty($sucesso)): ?>
        <div class="message success"><?= $sucesso ?></div>
    <?php endif; ?>

    <form method="post">
        <label>ID do Aluno:</label>
        <input type="number" name="id_aluno" value="<?= htmlspecialchars($registro['id_aluno']) ?>" required>

        <label>Apostila:</label>
        <select name="apostila" required>
            <?php
            $opcoes = [
                "Apostila 6° Período",
                "Apostila 5° Período",
                "Apostila 4° Período",
                "Apostila 3° Período",
                "Apostila 2° Período",
                "Apostila 1° Período"
            ];
            foreach ($opcoes as $opcao) {
                $selected = ($registro['apostila'] == $opcao) ? "selected" : "";
                echo "<option value='$opcao' $selected>$opcao</option>";
            }
            ?>
        </select>

        <label>Horas Validadas:</label>
        <select name="horas_validadas" required>
            <?php
            for ($i = 1; $i <= 5; $i++) {
                $selected = ($registro['horas_validadas'] == $i) ? "selected" : "";
                echo "<option value='$i' $selected>$i hora(s)</option>";
            }
            ?>
        </select>

        <label>Data de Validação:</label>
        <input type="date" name="data_validacao" value="<?= $registro['data_validacao'] ?>" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="pendente" <?= $registro['status'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
            <option value="validada" <?= $registro['status'] == 'validada' ? 'selected' : '' ?>>Validada</option>
        </select>

        <label>Observações:</label>
        <textarea name="observacoes" rows="4"><?= $registro['observacoes'] ?></textarea>

        <button type="submit" class="btn">Salvar Alterações</button>
    </form>
    
</div>

</body>
</html>

</body>
</html>
