<?php
require(__DIR__ . '/../conn/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM aluno WHERE id_aluno = :id");
    $stmt->execute([':id' => $id]);
}
header("Location: index.php");
exit;
