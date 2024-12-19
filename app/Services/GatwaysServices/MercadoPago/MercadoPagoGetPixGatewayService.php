<?php

namespace App\Services\GatwaysServices\MercadoPago;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;

class MercadoPagoGetPixGatewayService
{
    private MPSearchRequest $searchRequest;
    private PaymentClient $client;

    public function __construct()
    {
        MercadoPagoConfig::setAccessToken('APP_USR-4772939421535453-121714-74361b771e6be547cbbfea8656b5da77-2162461019');
        $this->client = new PaymentClient();
    }

    public function process($data)
    {
        $searchRequest = new MPSearchRequest(30,0,[
            "sort" => $data['sort'],
            "criteria" => $data['criteria'],
            "external_reference" => $data['external_reference'],
            "range" => $data['range'],
            "begin_date" => $data['begin_date'],
            "end_date" => $data['end_date'],
        ]);

       return $this->client->search($searchRequest)->getResponse();
    }
}
