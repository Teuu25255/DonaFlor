<?php
header("Content-Type: application/json");

$body = json_decode(file_get_contents("php://input"), true);

$handle = "lvi-de-oliveira-marques"; // <-- coloque sua InfiniteTag AQUI

$payload = [
    "handle"        => $handle,
    "redirect_url"  => "https://donaflorsemijoias.shop/obrigado.php",
    "webhook_url"   => "https://donaflorsemijoias.shop/webhook.php",
    "order_nsu"     => $body["order_nsu"],
    "items"         => $body["items"]
];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.infinitepay.io/invoices/public/checkout/links",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($payload),
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"]
]);

$response = curl_exec($curl);
curl_close($curl);

echo $response;
