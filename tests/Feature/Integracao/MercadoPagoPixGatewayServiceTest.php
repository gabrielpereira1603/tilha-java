<?php

namespace Feature\Integracao;

use App\Services\GatwaysServices\MercadoPago\MercadoPagoPixGatewayService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPHttpClient;
use Mockery;
use Tests\TestCase;

class MercadoPagoPixGatewayServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Mock do Logger para evitar saída desnecessária no teste
        Log::spy();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_uses_correct_credentials_in_test_environment()
    {
        // Simular ambiente de teste
        Config::set('app.env', 'local');
        Config::set('MERCADO_PAGO_TEST_ACCESS_TOKEN', 'test-access-token');

        // Mock do MercadoPagoConfig
        $mockConfig = Mockery::mock('alias:' . MercadoPagoConfig::class);
        $mockHttpClient = Mockery::mock(MPHttpClient::class);
        $mockConfig->shouldReceive('setAccessToken')->with('test-access-token')->once();
        $mockConfig->shouldReceive('getHttpClient')->andReturn($mockHttpClient);

        // Instanciar o serviço
        $service = new MercadoPagoPixGatewayService();

        // Assert que o logger foi chamado corretamente
        Log::shouldHaveReceived('info')->withArgs(function ($message) {
            return str_contains($message, 'X-Idempotency-Key gerado');
        })->once();
    }

    public function test_uses_correct_credentials_in_production_environment()
    {
        // Simular ambiente de produção
        Config::set('app.env', 'production');
        Config::set('MERCADO_PAGO_PROD_ACCESS_TOKEN', 'prod-access-token');

        // Mock do MercadoPagoConfig
        $mockConfig = Mockery::mock('alias:' . MercadoPagoConfig::class);
        $mockHttpClient = Mockery::mock(MPHttpClient::class);
        $mockConfig->shouldReceive('setAccessToken')->with('prod-access-token')->once();
        $mockConfig->shouldReceive('getHttpClient')->andReturn($mockHttpClient);

        // Instanciar o serviço
        $service = new MercadoPagoPixGatewayService();

        // Assert que o logger foi chamado corretamente
        Log::shouldHaveReceived('info')->withArgs(function ($message) {
            return str_contains($message, 'X-Idempotency-Key gerado');
        })->once();
    }

    public function test_process_creates_payment_request_successfully()
    {
        // Mock do MPHttpClient
        $mockHttpClient = Mockery::mock(MPHttpClient::class);

        // Mock do MercadoPagoConfig para retornar o MPHttpClient
        $mockConfig = Mockery::mock('alias:' . MercadoPagoConfig::class);
        $mockConfig->shouldReceive('getHttpClient')->andReturn($mockHttpClient);

        // Mock do PaymentClient
        $mockClient = Mockery::mock(PaymentClient::class);
        $mockClient->shouldReceive('create')
            ->once()
            ->andReturnSelf()
            ->shouldReceive('getResponse')
            ->once()
            ->andReturn(['status' => 'approved']);

        // Configurar o ambiente de teste
        Config::set('app.env', 'local');
        Config::set('MERCADO_PAGO_TEST_ACCESS_TOKEN', 'test-access-token');

        // Substituir a instância do PaymentClient
        $this->app->instance(PaymentClient::class, $mockClient);

        // Dados de entrada
        $data = [
            'value' => 100.00,
            'email' => 'test@example.com',
            'name' => 'Test User',
            'cpfCnpj' => '12345678900',
            'purchase_id' => 'PURCHASE123',
        ];

        // Instanciar o serviço e processar
        $service = new MercadoPagoPixGatewayService();
        $response = $service->process($data);

        // Verificar resposta
        $this->assertEquals(['status' => 'approved'], $response);
    }
}
