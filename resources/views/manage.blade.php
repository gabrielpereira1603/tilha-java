<x-app-layout>
    <x-slot name="header">
        <h2 class="flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gap-1">
            <x-manage-icon width="20px" height="20px" color="currentColor"/>
            {{ __('Gerenciamento') }}
        </h2>
    </x-slot>

    {{-- Exibir mensagens de sucesso --}}
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    {{-- Exibir tickets se existirem --}}
    @if ($tickets->isNotEmpty())
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100" x-data="{ search: '' }">
                        <h3 class="text-lg font-bold flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2 sm:flex-row flex-col">
                                <x-shirt-icon width="20px" height="20px" color="currentColor"/>
                                Pedidos de Camisetas:
                                <span class="flex justify-center items-center space-x-2">
                                    <span class="px-2 py-1 text-sm font-medium text-gray-100 bg-gray-800 rounded dark:bg-gray-200 dark:text-gray-700">
                                        PP: {{ $shirtSizes['PP'] }}
                                    </span>
                                    <span class="px-2 py-1 text-sm font-medium text-gray-100 bg-gray-800 rounded dark:bg-gray-200 dark:text-gray-700">
                                        P: {{ $shirtSizes['P'] }}
                                    </span>
                                    <span class="px-2 py-1 text-sm font-medium text-gray-100 bg-gray-800 rounded dark:bg-gray-200 dark:text-gray-700">
                                        M: {{ $shirtSizes['M'] }}
                                    </span>
                                    <span class="px-2 py-1 text-sm font-medium text-gray-100 bg-gray-800 rounded dark:bg-gray-200 dark:text-gray-700">
                                        G: {{ $shirtSizes['G'] }}
                                    </span>
                                    <span class="px-2 py-1 text-sm font-medium text-gray-100 bg-gray-800 rounded dark:bg-gray-200 dark:text-gray-700">
                                        GG: {{ $shirtSizes['GG'] }}
                                    </span>
                                    <span class="px-2 py-1 text-sm font-medium text-gray-100 bg-gray-800 rounded dark:bg-gray-200 dark:text-gray-700">
                                        XG: {{ $shirtSizes['XG'] }}
                                    </span>

                                      <span class="px-2 py-1 text-sm font-medium text-gray-100 bg-gray-800 rounded dark:bg-gray-200 dark:text-gray-700">
                                        TOTAL: {{ $totalShirts }}
                                    </span>
                                </span>
                            </div>
                        </h3>

                        <!-- Tabela -->
                        <div>
                            @include('manage.partials.table-shirts-manage', ['tickets' => $tickets])
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("Você não possui ingressos ):") }}
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
