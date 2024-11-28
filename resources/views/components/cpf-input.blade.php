@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'cpf-input border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-orange-500 dark:focus:border-orange-600 focus:ring-orange-500 dark:focus:ring-orange-600 rounded-md shadow-sm']) }}
    id="cpf-input-{{ $attributes['id'] }}" type="text" placeholder="Digite o CPF"/>
