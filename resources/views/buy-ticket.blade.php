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
                <!-- Formulário de Compra -->
                <form action="" method="POST">
                    @csrf
                    <div id="tickets-form">
                        <!-- Ingresso 1 -->
                        <div class="ticket-entry">
                            <label for="ticket_type_0">Tipo de Ingresso</label>
                            <select name="tickets[0][type]" id="ticket_type_0" onchange="toggleFields(0)" class="form-select">
                                <option value="Motorista">Motorista - R$ 300,00</option>
                                <option value="Passageiro">Passageiro - R$ 100,00</option>
                            </select>

                            <div id="motorista-fields-0" class="ticket-fields hidden">
                                <label for="car_plate_0">Placa do Carro</label>
                                <input type="text" name="tickets[0][car_plate]" id="car_plate_0" class="form-input" placeholder="Placa do carro">
                            </div>

                            <div id="passenger-fields-0" class="ticket-fields hidden">
                                <label for="name_0">Nome Completo</label>
                                <input type="text" name="tickets[0][name]" id="name_0" class="form-input" placeholder="Nome Completo">

                                <label for="cpf_0">CPF</label>
                                <input type="text" name="tickets[0][cpf]" id="cpf_0" class="form-input" placeholder="CPF">
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="addTicketForm()">Adicionar Outro Ingresso</button>
                    <button type="submit">Finalizar Compra</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let ticketCount = 1; // Contador de ingressos

        // Função para mostrar os campos apropriados de acordo com o tipo de ingresso
        function toggleFields(index) {
            const ticketType = document.getElementById(`ticket_type_${index}`).value;
            const motoristaFields = document.getElementById(`motorista-fields-${index}`);
            const passengerFields = document.getElementById(`passenger-fields-${index}`);

            if (ticketType === 'Motorista') {
                motoristaFields.classList.remove('hidden');
                passengerFields.classList.add('hidden');
            } else {
                passengerFields.classList.remove('hidden');
                motoristaFields.classList.add('hidden');
            }
        }

        // Função para adicionar outro ingresso
        function addTicketForm() {
            const ticketsForm = document.getElementById('tickets-form');
            const newTicketIndex = ticketCount++;

            const ticketFormHTML = `
                <div class="ticket-entry">
                    <label for="ticket_type_${newTicketIndex}">Tipo de Ingresso</label>
                    <select name="tickets[${newTicketIndex}][type]" id="ticket_type_${newTicketIndex}" onchange="toggleFields(${newTicketIndex})" class="form-select">
                        <option value="Motorista">Motorista - R$ 300,00</option>
                        <option value="Passageiro">Passageiro - R$ 100,00</option>
                    </select>

                    <div id="motorista-fields-${newTicketIndex}" class="ticket-fields hidden">
                        <label for="car_plate_${newTicketIndex}">Placa do Carro</label>
                        <input type="text" name="tickets[${newTicketIndex}][car_plate]" id="car_plate_${newTicketIndex}" class="form-input" placeholder="Placa do carro">
                    </div>

                    <div id="passenger-fields-${newTicketIndex}" class="ticket-fields hidden">
                        <label for="name_${newTicketIndex}">Nome Completo</label>
                        <input type="text" name="tickets[${newTicketIndex}][name]" id="name_${newTicketIndex}" class="form-input" placeholder="Nome Completo">

                        <label for="cpf_${newTicketIndex}">CPF</label>
                        <input type="text" name="tickets[${newTicketIndex}][cpf]" id="cpf_${newTicketIndex}" class="form-input" placeholder="CPF">
                    </div>
                </div>
            `;

            ticketsForm.insertAdjacentHTML('beforeend', ticketFormHTML);
        }
    </script>
</x-app-layout>
