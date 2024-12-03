<?php

namespace App\Services\GatwaysServices\Asaas;
use App\Enums\HttpMethodEnum;
use App\Enums\HttpStatusEnum;
use App\Models\User;
use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class AsaasHttpGatwayService
{
    private string $token;
    //private string $url =  'https://sandbox.asaas.com/api/v3';
    private string $url =  'https://api.asaas.com/';

    private string $endpoint = '';
    private $http = '';
    private string $customer;
    private HttpStatusEnum $status;
    private string $message = '';
    private string $data = '';

    public function __construct()
    {
        $this->http = new Client();
        $this->token = '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDA1MTM4MzE6OiRhYWNoXzhmMGFhNjg2LTBjZjUtNDEyZi1hNGYxLWNjNDc0MzNkYjQ5Ng==';
        Log::info('AsaasHttpGatwayService instanciado com token: '.$this->token);  // Logando token na inicialização
    }
    public function getUrl(): string
    {
        if (empty($this->endpoint) === true){
            Log::error('URL não informado.');  // Log de erro
            throw new \Exception('URL não informado.');
        }

        Log::info('URL obtida: '.$this->url . $this->endpoint);  // Logando a URL construída
        return $this->url . $this->endpoint;
    }

    public function setUrl(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    private function getCustomer(): string
    {
        return $this->customer;
    }

    protected function setCustomer(array $data): void
    {
        $this->customer = (string) $data['customer'];

        if (empty($this->customer) === true) {
            Log::info('Cliente não encontrado, criando novo cliente...');

            $this->setUrl('/customers');
            $this->send($data, HttpMethodEnum::POST);
            $response = $this->response();

            if ($response['success'] === true) {
                $this->customer = $response['data']['id'];

                $user = auth()->user();
                if ($user) {
                    $user->customer = $this->customer;
                    $user->save();
                }
            } else {
                Log::error('Erro ao criar cliente na API: ' . json_encode($response));
            }
        }
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
        try{
            $url = $this->getUrl();
            Log::info('Token da API do Asaas: ' . env('ASAAS_API_KEY'));

            $request = [
                'headers' => [
                    'accept' => 'application/json',
                    'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDA1MTM4MzE6OiRhYWNoXzhmMGFhNjg2LTBjZjUtNDEyZi1hNGYxLWNjNDc0MzNkYjQ5Ng==',
                    'content-type' => 'application/json',
                ]
            ];

            $data['customer'] = $this->getCustomer();

            if($method === HttpMethodEnum::POST){
                $request['body'] = json_encode($data);
            }

            Log::info('Enviando requisição para URL: ' . $url);
            Log::info('Dados da requisição: ' . json_encode($data));

            $client = $this->http;
            $response = $client->request(
                $method->value,
                $this->getUrl(),
                $request
            );

            $this->data = (string) $response->getBody();
            $this->status = HttpStatusEnum::tryFrom((int) $response->getStatusCode());

            Log::info('Resposta recebida: ' . $this->data);  // Log da resposta da requisição

        }
        catch(ClientException $e){
            Log::error('Erro na requisição: ' . $e->getMessage());  // Log de erro na requisição
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
