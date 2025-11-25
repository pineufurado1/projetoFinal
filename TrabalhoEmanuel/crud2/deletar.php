<?php
require(__DIR__ . '/../conn/connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM inscricao_atividade WHERE id_inscricao=:id");
    $stmt->execute([':id'=>$id]);
}
header("Location: index.php");
exit;
?>
