<x-app-layout>
    <x-slot name="header">
        <h2 class="flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gap-1">
            <x-ticket-icon width="20px" height="20px" color="currentColor"/>
            {{ __('Meus Ingressos') }}
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
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold">Seus Tickets:</h3>
                        <span class="flex items-center gap-1">
                            <x-info-icon width="12px" height="12px" color="orange"/>
                            <small class="underline cursor-pointer text-orange-500 hover:text-orange-700"
                                   onclick="openModal()">
                                Se tiver dúvidas de como visualizar seu comprovante de compra do ingresso clique aqui.
                            </small>
                        </span>

                        @include('my-tickets.partials.table-tickets', ['tickets' => $tickets])

                    </div>
                </div>
            </div>
        </div>

        <div id="modal"
             class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-300">
            <div class="bg-white p-4 rounded-lg shadow-lg relative max-w-md mx-auto">
                <img src="{{ asset('images/view-payment.gif') }}" alt="Visualização do pagamento" class="w-full rounded-md">
                <p class="text-sm text-gray-500 text-center mt-2">
                    O vídeo será fechado automaticamente em 5 segundos.
                </p>
            </div>
        </div>

        <script>
            const modal = document.getElementById('modal');

            function openModal() {
                modal.classList.remove('opacity-0', 'pointer-events-none'); // Exibe o modal
                modal.classList.add('opacity-100');

                setTimeout(() => {
                    fadeOutModal();
                }, 5000); // Fecha após 5 segundos
            }

            function fadeOutModal() {
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                setTimeout(() => {
                    modal.classList.add('pointer-events-none'); // Remove interação após fade-out
                }, 300); // Tempo igual à duração do fade-out
            }
        </script>
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
