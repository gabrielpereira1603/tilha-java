<div class="overflow-x-auto p-6 relative z-0">
    <table id="search-table" class="min-w-full bg-white dark:bg-gray-800">
        <thead>
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                <span class="flex items-center gap-1">
                    <x-size-icon width="12px" height="12px" color="currentColor" />
                    Tamanho
                </span>
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                <span class="flex items-center gap-1">
                    <x-buyer-icon width="12px" height="12px" color="currentColor" />
                    Comprador
                </span>
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                <span class="flex items-center gap-1">
                    <x-contact-icon width="14px" height="14px" color="currentColor" />
                    Contato
                </span>
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                <span class="flex items-center gap-1">
                    <x-calendar-icon width="12px" height="12px" color="currentColor" />
                    Data da Compra
                </span>
            </th>
        </tr>
        </thead>
        <tbody class="bg-white overflow-visible divide-y divide-gray-200 dark:bg-gray-700 dark:divide-gray-600">
        {{-- Iterar sobre os tickets e exibir cada camiseta --}}
        @foreach ($tickets as $ticket)
            @foreach ($ticket->shirts as $shirt)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                        <span class="px-2 py-1 text-sm font-medium text-gray-100 bg-gray-800 rounded">
                            {{ $shirt->size }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                        {{ $ticket->buyer->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                        <span>
                            <a class="flex items-center gap-1 hover:underline" href="">
                                <x-email-icon width="12px" height="12px" color="currentColor" />
                                {{ $ticket->buyer->email ?? 'N/A' }}
                            </a>
                            <a class="flex items-center gap-1 hover:underline" href="">
                                <x-phone-icon width="12px" height="12px" color="currentColor" />
                                {{ $ticket->buyer->phone ?? 'N/A' }}
                            </a>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                        {{ $ticket->created_at->format('d/m/Y') }}
                    </td>
                </tr>
            @endforeach
        @endforeach
        {{ $tickets->links() }}
        </tbody>
    </table>
</div>
