<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "conexao.php";

    $email = $_POST["email"];

    // Verificar se existe
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        $msg = "E-mail não encontrado!";
    } else {

        // Gerar senha nova automática
        $novaSenha = substr(str_shuffle("abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!?$%&"), 0, 10);

        // Criptografar senha
        $hash = password_hash($novaSenha, PASSWORD_DEFAULT);

        // Atualizar no banco
        $sqlUpdate = "UPDATE usuarios SET senha = ? WHERE email = ?";
        $stmt2 = $con->prepare($sqlUpdate);
        $stmt2->bind_param("ss", $hash, $email);
        $stmt2->execute();

        // Enviar email
        $assunto = "Recuperação de Senha - Dona Flor Semijoias";
        $mensagem = "Sua nova senha é: $novaSenha\n\nRecomendamos trocar após o login.";
        $cabecalho = "From: noreply@seusite.com";

        @mail($email, $assunto, $mensagem, $cabecalho);

        $msg = "Uma nova senha foi enviada para seu email.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Esqueci a Senha</title>
<style>
body {
    background: #f0f0f0;
    font-family: Arial;
    padding-top: 40px;
}
.box {
    width: 350px;
    background: white;
    margin: auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px #ccc;
}
input {
    width: 100%;
    padding: 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    margin-bottom: 15px;
}
button {
    width: 100%;
    padding: 12px;
    background: #bfa76a;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 6px;
}
.msg {
    background: #def1de;
    border: 1px solid #57a857;
    padding: 10px;
    color: #2d6a2d;
    margin-bottom: 10px;
    border-radius: 6px;
    text-align: center;
}
</style>
</head>
<body>

<div class="box">
    <h2>Recuperar Senha</h2>

    <?php if (!empty($msg)) echo "<div class='msg'>$msg</div>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Digite seu e-mail" required>
        <button type="submit">Enviar nova senha</button>
    </form>
</div>

</body>
</html>
