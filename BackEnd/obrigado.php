<?php
$receipt = $_GET["receipt_url"] ?? "";
$order = $_GET["order_nsu"] ?? "";
$metodo = $_GET["capture_method"] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
<title>Obrigado pela compra!</title>
</head>
<body style="font-family:Arial; text-align:center;">
  <h1>Pagamento confirmado! 🎉</h1>

  <p>Pedido: <strong><?= $order ?></strong></p>
  <p>Método de pagamento: <strong><?= $metodo ?></strong></p>

  <?php if ($receipt): ?>
  <a href="<?= $receipt ?>" target="_blank">Baixar Comprovante</a>
  <?php endif; ?>

<script>
localStorage.removeItem("carrinho");
</script>

  <br><br>
  <a href="index.html">Voltar para loja</a>
</body>
</html>
