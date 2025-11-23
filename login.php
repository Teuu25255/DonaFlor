<?php
session_start();
include "conexao.php";

// Se formulário enviado
$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Verifica se o email existe
    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verifica a senha
        if (password_verify($senha, $usuario["senha"])) {

            // Criar sessão
            $_SESSION["usuario_id"]   = $usuario["id"];
            $_SESSION["usuario_nome"] = $usuario["nome"];
            $_SESSION["logado"]       = true;

            header("Location: painel.php"); // página protegida
            exit;
        } else {
            $msg = "Senha incorreta.";
        }
    } else {
        $msg = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 40px; }
        .box {
            background: white; width: 350px; margin: auto; padding: 25px;
            border-radius: 10px; box-shadow: 0 0 10px #ddd;
        }
        input {
            width: 100%; padding: 10px; margin: 10px 0;
            border: 1px solid #aaa; border-radius: 6px;
        }
        button {
            width: 100%; padding: 12px; background: #4CAF50;
            border: none; color: white; font-size: 16px;
            border-radius: 6px; cursor: pointer;
        }
        .erro { color: red; text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="box">
    <h2>Login</h2>

    <?php if ($msg != "") echo "<div class='erro'>$msg</div>"; ?>

    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Senha:</label>
        <input type="password" name="senha" required>

        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>
