<?php
include "config.php";

$con = new mysqli($host, $usuario, $senha, $banco);

if ($con->connect_error) {
    die("Erro: " . $con->connect_error);
}
?>
