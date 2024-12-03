<?php

namespace App\Http\Controllers\Web;

use App\Models\Purchase;
use Carbon\Carbon;

class PaymentPixController
{
    public function showPaymentPix()
    {
        $purchase = Purchase::where('buyer_id', auth()->id())
            ->orderBy('purchase_date', 'desc')
            ->first();

        if (!$purchase) {
            return redirect()->route('dashboard')->with('error', 'Nenhuma compra encontrada.');
        }

        $pixExpiration = Carbon::parse($purchase->pix_expiration);
        if ($pixExpiration->isPast()) {
            return redirect()->route('my-tickets')->with('error', 'PIX Expirado');
        }

        return view('payment-pix', [
            'qrCode' => $purchase->qr_code,
            'pixExpiration' => $purchase->pix_expiration,
            'keyAleatory' => $purchase->key_aleatory,
            'invoiceUrl' => $purchase->invoiceUrl,
        ]);
    }
}
