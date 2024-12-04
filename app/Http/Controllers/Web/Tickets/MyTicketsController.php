<?php

namespace App\Http\Controllers\Web\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MyTicketsController extends Controller
{
    public function viewMyTickets(Request $request)
    {
        $user = $request->user();

        // Recupera o customer ID do Asaas
        $customerId = $user->customer;

        if (!$customerId) {
            return redirect()->back()->withErrors(['error' => 'Customer ID não encontrado para este usuário.']);
        }

        $tickets = $user->ticketsOwned()
            ->orWhereIn('id', $user->ticketsBought()->pluck('id'))
            ->with([
                'buyer',
                'belongsToUser',
                'shirts',
                'purchase'
            ])
            ->get();

        //$payments = $this->getAsaasPayments($customerId);


        return view('dashboard', compact('tickets'));
    }

    private function getAsaasPayments(string $customerId)
    {
        try {
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', "https://api.asaas.com/v3/payments?customer=$customerId&billingType=PIX", [
                'headers' => [
                    'accept' => 'application/json',
                    'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDA1MTM4MzE6OiRhYWNoXzhmMGFhNjg2LTBjZjUtNDEyZi1hNGYxLWNjNDc0MzNkYjQ5Ng==',
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['data'] ?? []; // Retorna os pagamentos encontrados

        } catch (\Exception $e) {
            Log::error('Erro ao buscar pagamentos no Asaas: ' . $e->getMessage());
            return [];
        }
    }


}
