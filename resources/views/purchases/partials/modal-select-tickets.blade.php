<x-modal :name="'select_tickets'" :show="session('modal_open') || $errors->any()">
    <form method="POST" action="{{ url('/purchases') }}" id="ticket-form">
        @csrf
        <div class="p-6 space-y-6">
            <h2 class="flex items-center gap-2 text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                <x-ticket-icon color="currentColor"/>
                Preencha as Informações do Ingresso
            </h2>

            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                    <strong>Erro:</strong> Por favor, corrija os seguintes problemas:
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Campo para escolher o ingresso e quantidade -->
            <div class="space-y-4">

                <div class="flex flex-col items-start justify-between">
                    <x-input-label for="cpf_driver" class="flex items-center w-full text-gray-700 dark:text-gray-200">
                        <x-user-icon width="10px" height="10px"/>
                        <span class="ml-1">CPF do Motorista:</span>
                    </x-input-label>
                    <x-text-input id="cpf_driver" class="block mt-1 w-full" type="text" name="cpf_driver" required/>
                </div>

                <div class="flex flex-col items-start justify-between">
                    <x-input-label for="car_plate" class="flex items-center w-full text-gray-700 dark:text-gray-200">
                        <x-car-icon width="10px" height="10px"/>
                        <span class="ml-1">Placa do Veículo:</span>
                    </x-input-label>
                    <x-text-input id="car_plate" class="mt-1 block w-full" name="car_plate"/>
                </div>

                <x-select-label
                    id="shirt_driver_1"
                    name="shirt_driver_1"
                    label="Tamanho da 1º camiseta do Motorista:"
                    :icon="'shirt-icon'"
                    :options="[
                        '' => 'Selecione o tamanho',
                        'PP' => 'PP',
                        'P' => 'P',
                        'M' => 'M',
                        'G' => 'G',
                        'GG' => 'GG',
                        'XG' => 'XG'
                    ]"
                    iconWidth="12px"
                    iconHeight="12px"
                />

                <x-select-label
                    id="shirt_driver_2"
                    name="shirt_driver_2"
                    label="Tamanho da 2º camiseta do Motorista:"
                    :icon="'shirt-icon'"
                    :options="[
                        '' => 'Selecione o tamanho',
                        'PP' => 'PP',
                        'P' => 'P',
                        'M' => 'M',
                        'G' => 'G',
                        'GG' => 'GG',
                        'XG' => 'XG'
                    ]"
                    iconWidth="12px"
                    iconHeight="12px"
                />

                <h2 class="flex flex-row gap-2 text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    <x-passager-icon color="currentColor"/>
                    <span>
                        Adicionar Passageiro R$100
                    </span>
                </h2>

                <div id="no-passenger-message" class="text-center text-gray-500 dark:text-gray-300">
                    Nenhum passageiro adicionado.
                </div>

                <div id="passenger-container">

                </div>

                <div class="flex gap-4 w-full mt-2">
                    <!-- Botão Limpar -->
                    <x-secondary-button class="w-full flex items-center justify-center gap-1" id="clear-button">
                        <x-trashed-icon widht="18px" height="18px"  />
                        Limpar
                    </x-secondary-button>

                    <!-- Botão Adicionar -->
                    <x-primary-button type="button" id="add-passenger" class="w-full flex items-center justify-center gap-1">
                        <x-add-icon widht="18px" height="18px" />
                        Adicionar Passageiro + R$100
                    </x-primary-button>
                </div>
            </div>
            <x-input-label style="font-size: 14px;" class="text-center">Só é possivel adicionar até 4 passageiros!</x-input-label>

            <x-divider color="orange" width="100%" height="1px"/>

            <div class="mt-1 p-4 bg-gray-100 dark:bg-gray-800 rounded-md">
                <div class="flex justify-between items-center">
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-100">Total:</p>
                    <input type="text" name="total_value" id="total-value" value="350.00" readonly class="text-lg font-bold text-green-500 dark:text-green-300 bg-transparent border-none w-32 text-right"/>
                </div>
            </div>

            <div class="flex items-center gap-2 justify-end">
                <input
                    type="checkbox"
                    id="accept-terms"
                    class="h-4 w-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500 dark:focus:ring-orange-400"
                    required
                />
                <label for="accept-terms" class="text-sm text-gray-700 dark:text-gray-200 flex items-center gap-1 cursor-pointer">
                    Eu li e aceito os
                    <span
                        class="text-orange-600 underline hover:text-orange-500 cursor-pointer"
                        id="open-terms-modal"
                        x-on:click.prevent="$dispatch('open-modal', 'terms-of-use')"
                    >
                        Termos de Uso
                    </span>
                </label>
            </div>

            @include('purchases.partials.modal-terms-of-use')

            <!-- Botões -->
            <div class="flex justify-end mt-6 gap-4">
                <x-danger-button x-on:click="$dispatch('close')">
                    <x-close-icon widht="18px" height="18px" />
                    Fechar
                </x-danger-button>
                <x-primary-button type="submmit" id="submit-ticket-btn" style="background: orange;">
                    <x-shop-cart-icon widht="18px" height="18px" />
                    Comprar Ingresso
                </x-primary-button>
            </div>
        </div>
        <div id="hidden-passengers" style="display: none;">
            <input type="hidden" name="passengers_count" id="passengers-count" value="0"/>
            <!-- Passengers will be added here dynamically -->
        </div>
    </form>
</x-modal>

<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carPlateInput = document.getElementById('car_plate'); // Pegando o input da placa
        const carPlateValueSpan = document.getElementById('car-plate-value'); // Pegando o span do modal

        // Adiciona um ouvinte de evento para quando o valor do input mudar
        carPlateInput.addEventListener('input', function () {
            // Atualiza o conteúdo do span com o valor do input
            carPlateValueSpan.textContent = carPlateInput.value;
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let totalValue = 350;
        let passengerCount = 0;
        const noPassengerMessage = document.getElementById('no-passenger-message');
        const hiddenPassengers = document.getElementById('hidden-passengers');
        const passengersCountInput = document.getElementById('passengers-count');

        // Máscara para CPF do Motorista
        const cpfDriverInput = document.getElementById('cpf_driver');
        Inputmask({
            mask: "999.999.999-99",
            placeholder: "0",
            clearMaskOnLostFocus: true,
        }).mask(cpfDriverInput);

        // Função para adicionar um passageiro
        document.getElementById('add-passenger').addEventListener('click', function () {
            if (passengerCount >= 4) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Limite atingido',
                    text: 'Você só pode adicionar até 4 passageiros.',
                    confirmButtonText: 'Entendido',
                });
                return; // Interrompe a execução se o limite foi atingido
            }

            passengerCount++;
            totalValue += 100;
            document.getElementById('total-value').value = totalValue.toFixed(2);
            passengersCountInput.value = passengerCount;

            // Criação dos campos para o passageiro
            const passengerContainer = document.getElementById('passenger-container');

            const cpfInput = document.createElement('div');
            cpfInput.classList.add('flex', 'flex-col', 'items-start', 'justify-between');
            cpfInput.innerHTML = `
        <x-input-label for="cpf_passenger_${passengerCount}" class="flex items-center w-full text-gray-700 dark:text-gray-200">
            <x-user-icon width="10px" height="10px"/>
            <span class="ml-1">CPF do Passageiro ${passengerCount}:</span>
        </x-input-label>
        <x-text-input id="cpf_passenger_${passengerCount}" class="block mt-1 w-full" type="text" name="cpf_passenger_${passengerCount}" required/>
    `;

            const shirtInput = document.createElement('div');
            shirtInput.classList.add('flex', 'flex-col', 'items-start', 'justify-between');
            shirtInput.innerHTML = `
        <x-select-label
            id="shirt_passenger_${passengerCount}"
            name="shirt_passenger_${passengerCount}"
            label="Tamanho da camiseta do Passageiro ${passengerCount}:"
            :icon="'shirt-icon'"
            :options="[
                '' => 'Selecione o tamanho',
                'PP' => 'PP',
                'P' => 'P',
                'M' => 'M',
                'G' => 'G',
                'GG' => 'GG',
                'XG' => 'XG'
            ]"
            iconWidth="12px"
            iconHeight="12px"
        />
    `;

            const divider = document.createElement('div');
            divider.classList.add('h-[1px]', 'w-full', 'bg-orange-300', 'mt-5', 'mb-2');

            passengerContainer.appendChild(cpfInput);
            passengerContainer.appendChild(shirtInput);
            passengerContainer.appendChild(divider);

            noPassengerMessage.style.display = 'none'; // Esconde a mensagem de "sem passageiros"
        });
        // Limpar campos
        document.getElementById('clear-button').addEventListener('click', function () {
            document.getElementById('passenger-container').innerHTML = '';
            totalValue = 350;
            passengerCount = 0;
            document.getElementById('total-value').value = totalValue.toFixed(2);
            passengersCountInput.value = passengerCount;
            noPassengerMessage.style.display = 'block';
        });
    });
</script>
<script>
    document.getElementById('ticket-form').addEventListener('submit', function(event) {
        const cpfFields = document.querySelectorAll('[name^="cpf_passenger_"]');
        const shirtFields = document.querySelectorAll('[name^="shirt_passenger_"]');

        cpfFields.forEach(cpfField => {
            console.log(cpfField.value);
        });
        shirtFields.forEach(shirtField => {
            console.log(shirtField.value);
        });
    });
</script>
