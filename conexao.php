<?php
$host = "localhost";
$usuario = "donaflor_MatheusAdmin";
$senha = "Im%1wk99+-vz}^9Y";
$banco = "donaflor_semijoias";

$con = new mysqli($host, $usuario, $senha, $banco);

if ($con->connect_error) {
    die("Erro: " . $con->connect_error);
}
?>
