<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gap-1">
            <x-pix-icon width="20px" height="20px" color="currentColor"/>
            {{ __('Pagamento PIX') }}
        </h2>
    </x-slot>

    {{-- Exibir mensagens de sucesso --}}
    @if (session('success'))
        <div id="successMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col justify-center items-center p-6 text-gray-900 dark:text-gray-100 text-center">
                    <h2 class="flex items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gap-1">
                        {{ __('QR Code') }}
                    </h2>
                    {{ __('Aponte a câmera ou clique no QR-Code para copiar para a área de transferência!') }}

                    <div id="successMessageContainer" class="mt-4"></div>

                    <img id="qrCodeImage" src="{{ $qrCode }}" alt="QR Code" width="300px" height="300px" />
                    <span class="mb-5">
                        {{ __('Pix válido até: ') }}
                        {{ \Carbon\Carbon::parse($pixExpiration)->locale('pt_BR')->isoFormat('D [de] MMMM [de] YYYY [as] HH:mm:ss') }}
                    </span>
                    <a href="{{ $invoiceUrl }}" target="_blank">
                        <x-primary-button type="button" class="flex items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight gap-1">
                            <x-redirect-icon width="16px" height="16px" color="currentColor"/>
                            Visualizar Pagamento
                        </x-primary-button>
                    </a>
                    <span class="flex flex-row justify-center items-start gap-2 dark:text-gray-100 mt-5 text-red-400">
                        <x-info-icon width="16px" height="16px" color="currentColor"/>
                        <small>Você receberá um Email ou SMS informando o status do pagamento!</small>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('qrCodeImage').addEventListener('click', function() {
            var keyAleatory = "{{ $keyAleatory }}";  // Chave aleatória passada da view
            navigator.clipboard.writeText(keyAleatory).then(function() {
                var successMessage = document.createElement('div');
                successMessage.className = "w-full p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400";
                successMessage.innerText = "Chave aleatória copiada para a área de transferência!";

                document.getElementById('successMessageContainer').appendChild(successMessage);

                setTimeout(function() {
                    successMessage.remove();
                }, 5000);
            }).catch(function(err) {
                console.error('Erro ao copiar para a área de transferência: ', err);
            });
        });
    </script>
</x-app-layout>
