<?php
// tests.php - Testes básicos
include "conexao.php";

// Teste de conexão
if ($con->connect_error) {
    echo "Falha na conexão: " . $con->connect_error;
} else {
    echo "Conexão bem-sucedida!\n";
}

// Teste de consulta simples
$result = $con->query("SELECT 1 as test");
if ($result) {
    $row = $result->fetch_assoc();
    echo "Consulta funciona: " . $row['test'] . "\n";
} else {
    echo "Erro na consulta\n";
}

$con->close();
?>