{{-- buy-ticket.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comprar Ingressos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex p-6 text-gray-900 dark:text-gray-100 gap-1">
                    <x-ticket-icon width="20" hieght="20"/>
                    {{ __("Ingressos Disponíveis") }}
                </div>

                <div class="w-full p-4 text-gray-900 dark:text-gray-100 gap-1 ">
                    <ul id="ticket-list">
                        <li class="flex justify-between items-center gap-2 border border-orange-300 rounded-[10px] p-4 mb-2">
                            <div class="flex items-center gap-2">
                                <x-driver-icon color="orange"/>
                                <p>Inscrição Do Veículo - <strong>R$350,00</strong></p>
                            </div>
                            <button onclick="addDriverTicket()" class="text-orange-500 hover:text-orange-700 focus:outline-none">
                                <span class="material-icons">
                                    <x-add-icon color="orange"/>
                                </span>
                            </button>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
