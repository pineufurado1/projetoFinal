<?php
try {
    require(__DIR__ . '/../conn/connect.php'); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if ($email === '' || $senha === '') {
            $error = "Preencha e-mail e senha.";
        } else {
            // Busca o usuário
            $stmt = $conn->prepare("
                SELECT id_usuario, nome, senha, tipo 
                FROM usuario 
                WHERE email = :email 
                LIMIT 1
            ");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $senha === $user['senha']) {

                // Salvar sessão
                $_SESSION['id_usuario'] = $user['id_usuario'];
                $_SESSION['nome_usuario'] = $user['nome'];
                $_SESSION['tipo_usuario'] = $user['tipo'];

                header("Location: ../interface/interface.php");
                exit;

            } else {
                $error = "E-mail ou senha inválidos.";
            }
        }
    }

} catch (PDOException $e) {
    $error = "Erro no banco: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login</title>
</head>
<body>
<div>
    <h3>Login</h3>

    <form method="post" action="">
        <div>
            <label>E-mail</label>
            <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>

        <div>
            <label>Senha</label>
            <input type="password" name="senha" required>
        </div>

        <button type="submit">Entrar</button>

        <a href="../index.php">Voltar</a>
    </form>
</div>
</body>
</html>

<?php ob_end_flush(); ?>





