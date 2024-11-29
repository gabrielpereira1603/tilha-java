@props([
    'icon' => null,       // Componente ou HTML do ícone
    'label' => '',        // Texto do label
    'id' => '',           // ID e `for` do label e `select`
    'name' => '',         // Nome do campo select
    'options' => [],      // Array de opções ['value' => 'Label']
    'iconWidth' => '10px',// Largura do ícone
    'iconHeight' => '10px',// Altura do ícone
])

<div class="flex flex-col items-start justify-between mt-4 w-full">
    <label for="{{ $id }}" class="flex items-center w-full text-gray-700 dark:text-gray-200">
        @if($icon)
            <x-dynamic-component :component="$icon" width="{{ $iconWidth }}" height="{{ $iconHeight }}" />
        @endif
        <span class="ml-1">{{ $label }}</span>
    </label>
    <select id="{{ $id }}" name="{{ $name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
        @foreach ($options as $value => $optionLabel)
            <option value="{{ $value }}">{{ $optionLabel }}</option>
        @endforeach
    </select>
</div>
