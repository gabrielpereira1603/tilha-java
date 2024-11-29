<x-modal :name="'select_tickets'">
    <div class="p-6 space-y-6">
        <h2 class="flex gap-2 text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
            <x-info-icon color="currentColor"/>
            Preencha as Informações do Ingresso
        </h2>

        <!-- Campo para escolher o ingresso e quantidade -->
        <div class="space-y-4">

            <div class="flex flex-col items-start justify-between">
                <x-input-label for="quantity" class="text-gray-700 dark:text-gray-200">CPF do Motorista:</x-input-label>
                <input id="quantity" type="number" min="1" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            </div>

            <div class="flex flex-col items-start justify-between">
                <x-input-label for="quantity" class="text-gray-700 dark:text-gray-200">Placa do Veículo:</x-input-label>
                <input id="quantity" type="number" min="1" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            </div>

            <div class="flex flex-col items-start justify-between">
                <x-input-label for="quantity" class="text-gray-700 dark:text-gray-200">Tamanho da 1º camiseta:</x-input-label>
                <input id="quantity" type="number" min="1" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            </div>

            <div class="flex flex-col items-start justify-between">
                <x-input-label for="quantity" class="text-gray-700 dark:text-gray-200">Tamanho da 2º camiseta:</x-input-label>
                <input id="quantity" type="number" min="1" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            </div>

            <div class="flex flex-col items-start justify-between gap-4">
                <x-input-label for="ticket-type" class="text-gray-700 dark:text-gray-200">Adicionar Passageiro <small>(Máximo 4)</small></x-input-label>

                <div class="flex flex-col w-full items-start justify-between">
                    <x-input-label for="quantity" class="text-gray-700 dark:text-gray-200">Tamanho da 2º camiseta:</x-input-label>
                    <input id="quantity" type="number" min="1" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>

                <div class="flex flex-col w-full items-start justify-between">
                    <x-input-label for="quantity" class="text-gray-700 dark:text-gray-200">Tamanho da 1º camiseta:</x-input-label>
                    <input id="quantity" type="number" min="1" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                </div>

                <!-- Contêiner flex para os botões -->
                <div class="flex gap-4 w-full mt-2">
                    <!-- Botão Limpar -->
                    <x-secondary-button class="w-full flex items-center justify-center">
                        Limpar
                    </x-secondary-button>

                    <!-- Botão Adicionar -->
                    <x-primary-button class="w-full flex items-center justify-center">
                        Adicionar
                    </x-primary-button>
                </div>
            </div>


        </div>

        <x-divider color="orange" width="100%" height="1px"/>

        <!-- Exibição do Valor Total -->
        <div class="mt-1 p-4 bg-gray-100 dark:bg-gray-800 rounded-md">
            <div class="flex justify-between items-center">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-100">Total:</p>
                <p id="total-value" class="text-lg font-bold text-green-400 dark:text-green-300">R$350,00</p>
            </div>
        </div>

        <!-- Botões -->
        <div class="flex justify-end mt-6 gap-4">
            <x-danger-button x-on:click="$dispatch('close')">
                Fechar
            </x-danger-button>
            <x-primary-button x-on:click="submitTicket()" style="background: orange;">
                Comprar Ingresso
            </x-primary-button>
        </div>
    </div>
</x-modal>

<script>
    // Lógica para calcular o valor total com base na seleção do ingresso e quantidade
    document.getElementById('ticket-type').addEventListener('change', updateTotal);
    document.getElementById('quantity').addEventListener('input', updateTotal);

    function updateTotal() {
        const ticketPrices = {
            '1': 350,  // Veículo
            '2': 150,  // Pessoa
            '3': 500   // VIP
        };

        const selectedTicket = document.getElementById('ticket-type').value;
        const quantity = document.getElementById('quantity').value;
        const totalValue = ticketPrices[selectedTicket] * quantity;

        document.getElementById('total-value').innerText = `R$${totalValue.toFixed(2)}`;
    }

    // Chamada para a lógica de envio (venda) do ingresso
    function submitTicket() {
        // Aqui você pode adicionar a lógica de envio dos dados
        alert("Compra realizada com sucesso!");
    }

    // Inicializa o valor total com a seleção padrão
    updateTotal();
</script>
