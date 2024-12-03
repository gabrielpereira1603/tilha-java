<?php

namespace App\Services\GatwaysServices\Asaas;

use App\Contracts\PaymentGatwayInterface;
use App\Enums\BillingTypeEnum;
use App\Enums\HttpMethodEnum;
use App\Enums\HttpStatusEnum;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // Adicionando o log do Laravel
use Mockery\Exception;

class AsaasPixGatwayService extends AsaasHttpGatwayService implements PaymentGatwayInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function process(array $data): array
    {
        try {
            Log::info('Iniciando o processamento de pagamento via PIX.', ['data' => $data]);

            $this->setCustomer($data);

            $carbon = Carbon::now();
            $date = $carbon->addMinutes(15);
            $data['dueDate'] = $date->toDateString();
            $data['billingType'] = BillingTypeEnum::PIX->value;

            Log::info('Dados atualizados para o pagamento via PIX.', ['data' => $data]);
            $this->setUrl('/payments');
            $this->send($data, HttpMethodEnum::POST);
            $response = $this->response();
            $purchaseId = $data['purchase_id'];

            $purchase = Purchase::find($purchaseId);
            if ($purchase) {
                $purchase->update([
                    'invoiceUrl' => $response['data']['invoiceUrl'] ?? null,
                ]);

                Log::info('Compra atualizada com sucesso com o invoiceUrl.', ['purchase' => $purchase]);
            } else {
                throw new Exception("Compra com ID {$purchaseId} não encontrada.");
            }

            Log::info('Resposta da API após tentativa de criação do pagamento.', ['response' => $response]);

            $paymentCreated = $response['success'] === true;


            if ($paymentCreated === true) {
                $hasPaymentId = !empty($response['data']['id']);

                if ($hasPaymentId === true) {
                    $paymentId = $response['data']['id'];
                    $data['id'] = $paymentId;

                    $this->setUrl("/payments/$paymentId/pixQrCode");

                    Log::info('URL sendo chamada: ' . $this->getUrl());
                    $this->send($data, HttpMethodEnum::GET);

                    $response = $this->response();

                    Log::info('Resposta da API ao tentar obter o código QR do PIX.', ['response' => $response]);

                    if ($response['success'] === true) {
                        $this->setMessage('Aponte a camera para realizar o pagamento via PIX.');
                    } else {
                        $this->setMessage('Erro inesperado!');
                        Log::error('Erro inesperado ao tentar obter o código QR do PIX.', ['response' => $response]);
                    }
                }
            }

            $this->setMessage('Pix gerado com sucesso.');
            Log::info('Pagamento via PIX gerado com sucesso.');

        } catch (Exception $e) {
            $this->setStatus(HttpStatusEnum::ERROR);
            $this->setData((string) $e->getMessage());
            $this->setMessage('Estamos com instabilidade no sistema, tente novamente!');

            Log::error('Erro ao processar pagamento via PIX.', ['error' => $e->getMessage()]);
        }

        return $this->response();
    }
}
