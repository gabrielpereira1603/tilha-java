<div class="overflow-x-auto p-6 relative z-0">
    <table class="min-w-full bg-white dark:bg-gray-800">
        <thead>
        <tr>
            <th class="gap-0.5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                 <span class="flex items-center gap-1">
                    <x-cash-icon width="12px" height="12px" color="currentColor"/>
                    Valor
                </span>
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                 <span class="flex items-center gap-1">
                    <x-buyer-icon width="12px" height="12px" color="currentColor"/>
                    Comprador
                </span>

            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                 <span class="flex items-center gap-1">
                    <x-belongs-to-icon width="14px" height="14px" color="currentColor"/>
                    Pertence á
                </span>
            </th>

            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                 <span class="flex items-center gap-1">
                    <x-car-icon width="12px" height="12px" color="currentColor"/>
                Placa do Carro
                </span>
            </th>

            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                 <span class="flex items-center gap-1">
                    <x-ticket-icon width="12px" height="12px" color="currentColor"/>
                    Tipo
                </span>
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                 <span class="flex items-center gap-1">
                    <x-pix-icon width="12px" height="12px" color="currentColor"/>
                    Pagamento
                </span>
            </th>
        </tr>
        </thead>
        <tbody class="bg-white overflow-visible divide-y divide-gray-200 dark:bg-gray-700 dark:divide-gray-600">
        @foreach ($tickets as $ticket)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ 'R$ ' . number_format($ticket->value, 2, ',', '.') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $ticket->buyer->name ? $ticket->buyer->name : 'N/A'}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $ticket->belongsToUser ? $ticket->belongsToUser->name : 'N/A' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $ticket->car_plate ? $ticket->car_plate : 'Não Possui'}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $ticket->type ?? 'N/A' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 relative">
                    @if ($ticket->purchase && $ticket->purchase->invoiceUrl)
                        <a href="{{ $ticket->purchase->invoiceUrl }}">
                            <x-primary-button class="flex gap-1 items-center">
                                <x-payment-icon widht="16px" height="16px" color="currentColor"/>
                                Vizualizar
                            </x-primary-button>
                        </a>
                    @else
                        <span class="text-gray-500">Entre em contato</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
