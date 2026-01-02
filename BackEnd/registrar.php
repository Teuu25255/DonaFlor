<?php
include "conexao.php";

// Verifica se os campos chegaram
if (!isset($_POST["name"], $_POST["email-reg"], $_POST["senha-reg"])) {
    die("Campos incompletos");
}

$nome = $_POST["name"];
$email = $_POST["email-reg"];
$senha = $_POST["senha-reg"];

// Criptografar a senha (importante)
$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

// SQL para inserir com prepare (seguro)
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senhaCriptografada);

if ($stmt->execute()) {
    echo "OK";
} else {
    echo "Erro ao registrar: " . $con->error;
}
?>
