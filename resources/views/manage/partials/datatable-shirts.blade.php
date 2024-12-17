<div class="overflow-x-auto p-6 relative z-0">
    {{ $dataTable->table([ 'class' => 'min-w-full bg-white dark:bg-gray-800' ]) }}
</div>

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
