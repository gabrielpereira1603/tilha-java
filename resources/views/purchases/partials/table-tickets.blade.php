<div class="overflow-x-auto p-6">
    <table class="min-w-full bg-white dark:bg-gray-800">
        <thead>
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                Valor
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                Comprador
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                Pertence á
            </th>

            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                Placa do Carro
            </th>

            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                Tipo
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                Status
            </th>

            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                Ações
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
                    {{ $ticket->buyer->name ? $ticket->buyer->name : 'N/A'}}  <!-- Certifique-se de que $ticket->buyer é um objeto User -->
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $ticket->belongsToUser ? $ticket->belongsToUser->name : 'N/A' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $ticket->car_plate ? $ticket->car_plate : 'N/A'}}  <!-- Certifique-se de que $ticket->buyer é um objeto User -->
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $ticket->type ?? 'N/A' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $ticket->car_plate ?? 'N/A' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    N/a
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium overflow-ellipsis">

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
