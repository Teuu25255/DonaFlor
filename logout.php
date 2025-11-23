<?php
session_start();

// Finaliza tudo
session_unset();
session_destroy();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Saindo...</title>
    <meta http-equiv="refresh" content="1; URL=login.php">
    <style>
        body { font-family: Arial; background: #fafafa; text-align: center; padding-top: 50px; }
    </style>
</head>
<body>

<h2>Saindo da conta...</h2>
<p>Você será redirecionado em instantes.</p>

</body>
</html>
