<?php

namespace App\Http\Controllers\Web\HistoryPurchase;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Services\GatwaysServices\MercadoPago\MercadoPagoGetPixGatewayService;
use Illuminate\Http\Request;

class IndexHistoryPurchaseController extends Controller
{
    public function index(Request $request)
    {
        $purchases = Purchase::with([
            'buyer',
            'tickets',
            'shirts',
        ])->where('buyer_id', auth()->id())->paginate(10);

        // Instancia o serviço de integração com Mercado Pago
        $mercadoPagoService = new MercadoPagoGetPixGatewayService();

        $purchaseDetails = [];

        foreach ($purchases as $purchase) {
            // Cria a requisição para cada compra
            $response = $mercadoPagoService->process([
                "external_reference" => $purchase->external_reference,
                "sort" => "date_created",
                "criteria" => "desc",
                "range" => "date_created",
                "begin_date" => "NOW-30DAYS",
                "end_date" => "NOW",
            ])->getContent();
            $status = null;

            if (isset($response['results']) && count($response['results']) > 0) {
                $status = $response['results'][0]['status'];
            }

            $purchaseDetails[] = [
                'purchase' => $purchase,
                'status' => $status
            ];
        }

        return view('purchase-history', [
            'purchases' => $purchases,
            'purchaseDetails' => $purchaseDetails,
        ]);
    }
}
