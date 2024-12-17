<?php

namespace App\Services\GatwaysServices\MercadoPago;
use AllowDynamicProperties;
use App\Enums\HttpMethodEnum;
use App\Enums\HttpStatusEnum;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;


#[AllowDynamicProperties] class MercadoPagoHttpGatewayService
{
    public function __construct()
    {
        $this->token = 'APP_USR-4772939421535453-121714-74361b771e6be547cbbfea8656b5da77-2162461019';
        MercadoPagoConfig::setAccessToken($this->token);

        $this->http = new PaymentClient();

        $uniqueKey = Str::uuid()->toString();
        $this->requestOptions = new RequestOptions();
        $this->requestOptions->setCustomHeaders(["X-Idempotency-Key: $uniqueKey"]);

        Log::info('MercadoPagoHttpGatewayService instanciado com token: '.$this->token);
        Log::info('X-Idempotency-Key gerado: '.$uniqueKey);
    }
    private string $token;

    private string $url = 'https://api.mercadopago.com';

    private string $endpoint = '';
    private $http = '';
    private string $customer;
    private HttpStatusEnum $status;
    private string $message = '';
    private string $data = '';

    private function getCustomer(): string
    {
        return $this->customer;
    }

    protected  function setCustomer(array $data): void
    {
        $this->customer = $data['customer'];
    }

    public function getUrl(): string
    {
        if (empty($this->endpoint) === true){
            Log::error('URL não informado.');
            throw new \Exception('URL não informado.');
        }

        Log::info('URL obtida: '.$this->url . $this->endpoint);
        return $this->url . $this->endpoint;
    }

    public function setUrl(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    public function getStatus(): HttpStatusEnum
    {
        return $this->status;
    }

    public function setStatus(HttpStatusEnum $status): void
    {
        $this->status = $status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): void
    {
        $this->data = $data;
    }

    public function send(array $data, HttpMethodEnum $method): void
    {
        try {
            $url = $this->getUrl();

            if (isset($data['customer'])) {
                unset($data['customer']);
            }

            $request = [
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
                'body' => json_encode($data)
            ];

            Log::info('Enviando requisição para URL: ' . $url);
            Log::info('Dados da requisição: ' . json_encode($data));

            $response = $this->http->create($request, $this->requestOptions);

            $this->data = (string) $response->getBody();
            $this->status = HttpStatusEnum::tryFrom((int) $response->getStatusCode());

            Log::info('Resposta recebida: ' . $this->data);
        } catch (ClientException $e) {
            Log::error('Erro na requisição: ' . $e->getMessage());
            $this->data = (string) $e->getResponse()->getBody()->getContents();
            $this->status = HttpStatusEnum::tryFrom((int) $e->getCode());
        }
    }

    protected function response(): array
    {
        $array = [
            'status' => $this->status,
            'data' => $this->data,
            'message' => $this->message,
            'success' => $this->status === HttpStatusEnum::SUCCESS
        ];
        if($this->status === HttpStatusEnum::SUCCESS || $this->status === HttpStatusEnum::ERROR){
            $array['data'] = json_decode($array['data'], true);
        }

        return $array;
    }

}

