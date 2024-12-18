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
                        <x-info-icon width="12px" height="12px" color="currentColor"/>
                        Status
                    </span>
                </th>

                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                     <span class="flex items-center gap-1">
                        <x-calendar-icon width="12px" height="12px" color="currentColor"/>
                        Data da compra
                    </span>
                </th>

                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                     <span class="flex items-center gap-1">
                        <x-info-icon width="12px" height="12px" color="currentColor"/>
                        Comprovante
                    </span>
                </th>
            </tr>
        </thead>

        <tbody class="bg-white overflow-visible divide-y divide-gray-200 dark:bg-gray-700 dark:divide-gray-600">
        @foreach ($purchases as $purchase)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ $purchase->total_value }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $purchase->buyer->name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ 'tete' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $purchase->purchase_date }}
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 relative">
                    @if ($purchase->invoiceUrl)
                        <a href="{{ $purchase->invoiceUrl }}" target="_blank">
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
