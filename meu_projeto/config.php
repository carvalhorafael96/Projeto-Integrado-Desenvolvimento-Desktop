<?php
$host = "localhost";
$db_name = "empresas_db";
$username = "root"; // Usuário padrão do XAMPP
$password = ""; // Sem senha padrão

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
