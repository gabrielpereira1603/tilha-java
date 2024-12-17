<?php

namespace App\Providers;

use App\Contracts\PaymentGatwayInterface;
use App\Models\User;
use App\Services\GatwaysServices\Asaas\AsaasPixGatwayService;
use App\Services\GatwaysServices\MercadoPago\MercadoPagoPixGatewayService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use App\Enums\BillingTypeEnum;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
          PaymentGatwayInterface::class, function($app, $params){
            //Log::info('Iniciando binding do PaymentGatwayInterface', ['params' => $params]);

            $gateway = isset($params['gateway']) && !empty($params['gateway']) ? $params['gateway'] : '';
            $billingType = isset($params['billing_type']) && !empty($params['billing_type']) ? $params['billing_type'] : '';

            //Log::info('Parâmetros extraídos', ['gateway' => $gateway, 'billingType' => $billingType]);

            if (empty($gateway) || empty($billingType)) {
                //Log::error('Parâmetros inválidos fornecidos para binding', ['params' => $params]);
                throw new Exception('Erro para chamar o método: parâmetros inválidos.');
            }


            $classes = [
                'ASAAS' => [
                    BillingTypeEnum::PIX->name => AsaasPixGatwayService::class
                ],
                'MERCADOPAGO' => [
                    BillingTypeEnum::PIX->name => MercadoPagoPixGatewayService::class
                ]
            ];

            if (!isset($classes[$gateway][$billingType])) {
                //Log::error('Gateway ou tipo de cobrança não encontrado', ['gateway' => $gateway, 'billingType' => $billingType]);
                throw new Exception('Gateway ou tipo de cobrança inválido.');
            }

            //Log::info('Gateway e tipo de cobrança validados', ['gateway' => $gateway, 'billingType' => $billingType]);

            return new $classes[$gateway][$billingType];
          }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
