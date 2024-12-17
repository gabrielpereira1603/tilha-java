<?php

namespace App\Services\GatwaysServices\MercadoPago;

use App\Contracts\PaymentGatwayInterface;
use App\Enums\BillingTypeEnum;
use App\Enums\HttpMethodEnum;
use App\Enums\HttpStatusEnum;
use App\Models\Purchase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use Mockery\Exception;

class MercadoPagoPixGatewayService
{
    private RequestOptions $requestOptions;
    private PaymentClient $client;

    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(getenv('MERCADO_PAGO_ACCESS_TOKEN'));

        $this->client = new PaymentClient();

        $uniqueKey = Str::uuid()->toString();
        $this->requestOptions = new RequestOptions();
        $this->requestOptions->setCustomHeaders(["X-Idempotency-Key: $uniqueKey"]);

        Log::info('X-Idempotency-Key gerado: '.$uniqueKey);
    }

    public function process(array $data)
    {
        try {
            $request = [
                'transaction_amount' => floatval($data['value']),
                'description' => 'Pagamento do Ingresso Trilha do Java 5º Edição',
                'payment_method_id' => 'pix',
                'payer' => [
                    'email' => $data['email'],
                    'first_name' => $data['name'] ?? '',
                    'last_name' => '',
                    'identification' => [
                        'type' => 'CPF',
                        'number' => $data['cpfCnpj']
                    ],
                ],
                'external_reference' => $data['purchase_id'] ?? uniqid(),
            ];


            $payment = $this->client->create($request, $this->requestOptions)->getResponse();

            return $payment;
        } catch (MPApiException $e) {
            Log::info("Status code: ", ['status_code' => $e->getApiResponse()->getStatusCode()]);
            return $e->getApiResponse()->getContent();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
