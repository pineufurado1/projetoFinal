<?php
require(__DIR__ . '/../conn/connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM relatorios_estagio WHERE id_relatorio = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
?>
