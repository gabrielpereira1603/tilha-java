<x-modal :name="'select_tickets'">
    <form method="POST" action="/caminho/para/acao" id="ticket-form">
        <div class="p-6 space-y-6">
            <h2 class="flex items-center gap-2 text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                <x-ticket-icon color="currentColor"/>
                Preencha as Informações do Ingresso
            </h2>

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
                    <x-secondary-button class="w-full flex items-center justify-center gap-1">
                        <x-trashed-icon widht="18px" height="18px" />
                        Limpar
                    </x-secondary-button>

                    <!-- Botão Adicionar -->
                    <x-primary-button type="button" id="add-passenger" class="w-full flex items-center justify-center gap-1">
                        <x-add-icon widht="18px" height="18px" />
                        Adicionar Passageiro
                    </x-primary-button>
                </div>
            </div>
            <x-input-label style="font-size: 14px;" class="text-center">Só é possivel adicionar até 4 passageiros!</x-input-label>

            <x-divider color="orange" width="100%" height="1px"/>

            <!-- Exibição do Valor Total -->
            <div class="mt-1 p-4 bg-gray-100 dark:bg-gray-800 rounded-md">
                <div class="flex justify-between items-center">
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-100">Total:</p>
                    <input type="text" name="total_value" id="total-value" value="350.00" readonly class="text-lg font-bold text-green-500 dark:text-green-300 bg-transparent border-none w-32 text-right"/>
                </div>
            </div>

            <!-- Botões -->
            <div class="flex justify-end mt-6 gap-4">
                <x-danger-button x-on:click="$dispatch('close')">
                    <x-close-icon widht="18px" height="18px" />
                    Fechar
                </x-danger-button>
                <x-primary-button x-on:click="submitTicket()" style="background: orange;">
                    <x-shop-cart-icon widht="18px" height="18px" />
                    Comprar Ingresso
                </x-primary-button>
            </div>
        </div>
    </form>
</x-modal>

<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cpfDriverInput = document.getElementById('cpf_driver');
        const noPassengerMessage = document.getElementById('no-passenger-message');
        let totalValue = 350;
        let passengerCount = 0;

        // Máscara para CPF do Motorista
        Inputmask({
            mask: "999.999.999-99",
            placeholder: "0",
            clearMaskOnLostFocus: true,
        }).mask(cpfDriverInput);

        // Função para adicionar um passageiro
        document.getElementById('add-passenger').addEventListener('click', function () {
            if (passengerCount < 4) {
                passengerCount++;
                totalValue += 100; // Aumenta R$100 para cada passageiro adicionado

                // Atualiza o total no input
                document.getElementById('total-value').value = totalValue.toFixed(2);

                // Cria os campos para o passageiro
                const passengerContainer = document.getElementById('passenger-container');

                // Campo CPF do Passageiro
                const cpfInput = document.createElement('div');
                cpfInput.classList.add('flex', 'flex-col', 'items-start', 'justify-between');
                cpfInput.innerHTML = `
                    <x-input-label for="cpf_passenger_${passengerCount}" class="flex items-center w-full text-gray-700 dark:text-gray-200">
                        <x-user-icon width="10px" height="10px"/>
                        <span class="ml-1">CPF do Passageiro ${passengerCount}:</span>
                    </x-input-label>
                    <x-text-input id="cpf_passenger_${passengerCount}" class="block mt-1 w-full" type="text" name="cpf_passenger_${passengerCount}" required/>
                `;

                // Campo Tamanho da camiseta (select)
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
                divider.classList.add('flex', 'items-center', 'py-5');
                divider.innerHTML = `
                    <x-divider width="100%" height="1px" color="currentColor"/>
                `

                passengerContainer.appendChild(cpfInput);
                passengerContainer.appendChild(shirtInput);
                passengerContainer.appendChild(divider);


                // Usa setTimeout para garantir que o campo CPF seja criado antes de aplicar a máscara
                setTimeout(function () {
                    const cpfPassengerInput = document.getElementById(`cpf_passenger_${passengerCount}`);
                    Inputmask({
                        mask: "999.999.999-99",
                        placeholder: "0",
                        clearMaskOnLostFocus: true,
                    }).mask(cpfPassengerInput);
                }, 0);  // Garantir que o DOM foi atualizado antes de aplicar a máscara

                // Verifica se há algum passageiro, e oculta a mensagem de "Nenhum passageiro adicionado"
                if (passengerCount > 0) {
                    noPassengerMessage.style.display = 'none';
                }
            } else {
                // Alerta SweetAlert quando atingir o número máximo de passageiros
                Swal.fire({
                    icon: 'error',
                    title: 'Limite de Passageiros Atingido!',
                    text: 'Você não pode adicionar mais de 4 passageiros.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#f44336'
                });
            }
        });

        // Função para limpar os campos
        document.querySelector('.w-full.flex.items-center.justify-center').addEventListener('click', function () {
            // Limpar o formulário
            document.getElementById('ticket-form').reset();

            // Limpar campos dinâmicos de passageiros
            const passengerContainer = document.getElementById('passenger-container');
            passengerContainer.innerHTML = '';  // Remove todos os campos de passageiros

            // Resetar o contador de passageiros
            passengerCount = 0;

            // Mostrar a mensagem de "Nenhum passageiro adicionado"
            noPassengerMessage.style.display = 'block';

            // Resetar o valor total
            totalValue = 350;
            document.getElementById('total-value').value = totalValue.toFixed(2);
        });
    });
</script>
