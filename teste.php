<?php
$response = $this->httpClient->post('https://www.asaas.com/api/v3/payments', [
    'json' => $data,
    'headers' => [
        'Authorization' => 'Bearer SEU_TOKEN',
    ],
]);

$result = json_decode($response->getBody(), true);

Log::info('Resposta da API Asaas', ['result' => $result]);

