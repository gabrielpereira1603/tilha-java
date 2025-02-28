<?php

namespace App\Http\Controllers\Web\Tickets;

use App\Contracts\PaymentGatwayInterface;
use App\Enums\BillingTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Shirt;
use App\Models\Ticket;
use App\Rules\CpfRule;
use App\Services\GatwaysServices\MercadoPago\MercadoPagoPixGatewayService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TicketsController extends Controller
{
    public function viewBuyTicket(Request $request): View
    {
        $availableTickets = Ticket::availableForUser($request->user()->id)->get();

        return view('buy-ticket', [
            'user' => $request->user(),
            'availableTickets' => $availableTickets,
        ]);
    }



    public function buyTicket(Request $request)
        {
            $validatedData = $request->validate([
                'cpf_driver' => ['required', 'string', new CpfRule()],
                'car_plate' => 'required|string|max:10',
                'shirt_driver_1' => 'required|string|in:PP,P,M,G,GG,XG',
                'shirt_driver_2' => 'nullable|string|in:PP,P,M,G,GG,XG',
                // Validação para os passageiros
                'cpf_passenger_0' => ['nullable', 'string', new CpfRule()],
                'cpf_passenger_1' => ['nullable', 'string', new CpfRule()],
                'cpf_passenger_2' => ['nullable', 'string', new CpfRule()],
                'cpf_passenger_3' => ['nullable', 'string', new CpfRule()],

                'shirt_passenger_0' => 'nullable|string|in:PP,P,M,G,GG,XG',
                'shirt_passenger_1' => 'nullable|string|in:PP,P,M,G,GG,XG',
                'shirt_passenger_2' => 'nullable|string|in:PP,P,M,G,GG,XG',
                'shirt_passenger_3' => 'nullable|string|in:PP,P,M,G,GG,XG',

                'total_value' => 'required|numeric|min:0',
            ]);

            DB::beginTransaction();

            try {
                $purchase = Purchase::create([
                    'buyer_id' => auth()->id(),
                    'total_value' => $validatedData['total_value'],
                    'purchase_date' => now(),
                ]);
                Log::info("Purchase criada: ", ['purchase_id' => $purchase->id]);

                $driverTicket = Ticket::create([
                    'buyer_id' => auth()->id(),
                    'belongs_to' => auth()->id(),
                    'purchase_id' => $purchase->id,
                    'type' => 'Motorista',
                    'car_plate' => $validatedData['car_plate'],
                    'cpf' => $validatedData['cpf_driver'],
                    'value' => 350,
                ]);

                Shirt::create([
                    'size' => $validatedData['shirt_driver_1'],
                    'ticket_id' => $driverTicket->id,
                    'user_id' => auth()->id(),
                ]);

                if (!empty($validatedData['shirt_driver_2'])) {
                    Shirt::create([
                        'size' => $validatedData['shirt_driver_2'],
                        'ticket_id' => $driverTicket->id,
                        'user_id' => auth()->id(),
                    ]);
                }

                $items = [
                    [
                        "id" => $driverTicket->id,
                        "title" => "Ingresso Motorista",
                        "description" => "Ingresso para motorista do evento Trilha do Java",
                        "quantity" => 1,
                        "type" => "ingressos",
                        "unit_price" => $driverTicket->value,
                    ]
                ];

                for ($i = 0; $i <= 3; $i++) {
                    $cpfKey = "cpf_passenger_$i";
                    $shirtKey = "shirt_passenger_$i";

                    // Verifica se o CPF do passageiro foi fornecido
                    if (isset($validatedData[$cpfKey]) && !empty($validatedData[$cpfKey])) {
                        $cpf = $validatedData[$cpfKey];
                        $shirtSize = isset($validatedData[$shirtKey]) ? $validatedData[$shirtKey] : null;

                        $passengerTicket = Ticket::create([
                            'buyer_id' => auth()->id(),
                            'belongs_to' => auth()->id(),
                            'purchase_id' => $purchase->id,
                            'type' => 'Passageiro',
                            'car_plate' => null,
                            'cpf' => $cpf,
                            'value' => 100,
                        ]);

                        if ($shirtSize) {
                            Shirt::create([
                                'size' => $shirtSize,
                                'ticket_id' => $passengerTicket->id,
                                'user_id' => null,
                            ]);
                        }

                        $items[] = [
                            "id" => $passengerTicket->id,
                            "title" => "Ingresso Passageiro",
                            "description" => "Ingresso para passageiro do evento Trilha do Java",
                            "quantity" => 1,
                            "type" => "ingressos",
                            "unit_price" => $passengerTicket->value,
                        ];
                    } else {
                        Log::warning("Passenger $i CPF not provided for purchase #{$purchase->id}");
                    }
                }

                $fullName = auth()->user()->name;
                $nameParts = explode(' ', $fullName);

                $firstName = $nameParts[0];
                $lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : '';


                $paymentData = [
                    'purchase_id' => $purchase->id,
                    'customer' => auth()->user()->customer,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => auth()->user()->email,
                    'cpfCnpj' => auth()->user()->cpf,
                    'mobilePhone' => auth()->user()->phone,
                    'value' => $purchase->total_value,
                    'notificationDisabled' => false,
                    'externalReference' => auth()->user()->id,
                    'description' => "Compra do ingresso {$purchase->id}, Trilha do Java.",
                    'additional_info' => [
                        "items" => $items
                    ]
                ];

                $paymentGateway = new MercadoPagoPixGatewayService();
                $paymentResponse = $paymentGateway->process($paymentData);

                $paymentContent = $paymentResponse->getContent();
                $invoiceUrl = data_get($paymentContent, 'point_of_interaction.transaction_data.ticket_url', null);
                $qrCode = data_get($paymentContent, 'point_of_interaction.transaction_data.qr_code_base64', null);
                $pixExpiration = data_get($paymentContent, 'date_of_expiration', null);
                $key_aleatory = data_get($paymentContent, 'point_of_interaction.transaction_data.qr_code', null);
                $pixExpirationFormated = Carbon::parse($pixExpiration)->format('Y-m-d H:i:s');

                if ($qrCode && !str_starts_with($qrCode, 'data:image/png;base64,')) {
                    $qrCode = 'data:image/png;base64,' . $qrCode;
                }

                if ($qrCode && $pixExpiration && $key_aleatory) {
                    $purchase->qr_code = $qrCode;
                    $purchase->pix_expiration = $pixExpirationFormated;
                    $purchase->key_aleatory = $key_aleatory;
                    $purchase->invoiceUrl = $invoiceUrl;

                    $purchase->save();
                } else {
                    Log::error("Erro: Dados do pagamento ausentes ou incompletos.");
                    throw new \Exception("Erro ao salvar dados de pagamento.");
                }

                DB::commit();

                return redirect()->route('payment-pix')
                    ->with('success', 'Pagamento gerado com sucesso! Escaneie o QR Code para pagar, Clique no botão para copiar.');
            } catch (ValidationException $e) {
                DB::rollBack();
                Log::error("Erro de validação: " . $e->getMessage());
                return redirect()->back()
                    ->withErrors($e->errors())
                    ->withInput();
            } catch (QueryException $e) {
                DB::rollBack();
                Log::error("Erro de banco de dados: " . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'Erro de banco de dados.']);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Erro geral: " . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'Erro inesperado.']);
            }
        }
}
