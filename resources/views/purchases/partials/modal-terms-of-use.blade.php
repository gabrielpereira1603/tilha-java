<x-modal :name="'terms-of-use'" :show="session('modal_open') || $errors->any()">
    <div class="p-6 space-y-6">
        <!-- Cabeçalho com Logo e Nome do Evento -->
        <div class="flex items-center gap-4">
            <!-- Logo -->
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />

            <!-- Nome do Evento e Ano -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                    5° TRILHÃO DO JAVA – VERA – MT
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-300">2025</p>
            </div>
        </div>

        <!-- Termo de Responsabilidade -->
        <div class="mt-6 text-sm text-gray-700 dark:text-gray-300 space-y-4">
            <h3 class="font-semibold">TERMO DE RESPONSABILIDADE</h3>
            <p>Eu, <span class="underline">{{ auth()->user()->name }}</span> <small>(piloto/proprietário maior de idade)</small>, portador </p>
            <p> do CPF <span class="underline">{{ auth()->user()->cpf }}</span></p>
            <p>condutor/responsável pelo veículo(s) de placa <span id="car-plate-value" class="underline"></span></p>
            <p>Declaro para os devidos fins, que sou maior de idade, que sou integralmente responsável pela segurança e condução do meu veículo durante o evento 5° TRILHÃO DO JAVA (11/jan/2025), bem como, em relação aos acompanhantes/caroneiros que me acompanham, isentando totalmente a organização do evento quanto a acidentes, infortúnios, quebras mecânicas que envolvam meu veículo e meus acompanhantes.</p>
            <p>Declaro ainda estar ciente da necessidade de uso de equipamentos individuais de segurança além de cintos de segurança dos veículos para todos ocupantes, bem como, estar ciente dos riscos que envolvem circuitos de Off Road em especial ao percurso do evento.</p>
            <p>Sendo esta a expressão da verdade, subscrevo-me.</p>

            <p class="mt-6">Vera, em Dezembro de 2024.</p>

            <div class="mt-4">
                <div class="flex justify-between">
                    <p class="font-semibold underline">{{ auth()->user()->name }}</p>
                    <p>Assinatura</p>
                </div>
            </div>
        </div>

        <!-- Botões de Fechar e Confirmar -->
        <div class="mt-6 flex justify-end gap-4">
            <x-danger-button x-on:click="$dispatch('close')">
                Fechar
            </x-danger-button>
            <x-primary-button type="button"
                              x-on:click="
                $dispatch('close');
                document.getElementById('accept-terms').checked = true;
            ">
                Aceito os Termos
            </x-primary-button>
        </div>
    </div>
</x-modal>
