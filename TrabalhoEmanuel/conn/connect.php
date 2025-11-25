<?php
$host = 'localhost';
$db   = 'controle_estagio';
$user = 'root';
$password = ''; 

$dsn = "mysql:host=$host;dbname=$db";

try {
    $conn = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    die('Erro na conexão: ' . $e->getMessage());
}
