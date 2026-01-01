<?php
header("Content-Type: application/json");

$webhook = json_decode(file_get_contents("php://input"), true);

// Salva LOG para você conferir (pode remover depois)
file_put_contents("webhook_log.txt", date("H:i:s d/m/Y") . "\n" . json_encode($webhook, JSON_PRETTY_PRINT) . "\n\n", FILE_APPEND);

// Aqui você marcaria o pedido como pago
// Exemplo básico:

if (!isset($webhook["order_nsu"])) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "Pedido não encontrado"
    ]);
    exit;
}

http_response_code(200);
echo json_encode([
    "success" => true,
    "message" => null
]);
