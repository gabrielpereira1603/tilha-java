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
                            <x-primary-button
                                type="button"
                                style="background: orange !important;"
                                class="flex gap-2 text-blue-500"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'select_tickets')">
                                <i class="fa fa-plus"></i>
                                Comprar
                            </x-primary-button>
                            @include('purchases.partials.modal-select-tickets')
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

</x-app-layout>
