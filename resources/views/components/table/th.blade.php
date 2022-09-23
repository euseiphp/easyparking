@props([
    'label' => null,
    'column' => null,

    'sort' => null,
    'direction' => null,
])

<th scope="col" {{ $attributes->merge(['class' => 'px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white']) }}>
    <button
        class="text-left w-full text-xs leading-4 font-medium text-black dark:text-white font-bold uppercase flex justify-between focus:outline-none"
        @if($sort && $column && $direction) wire:click="sort('{{ $column }}', '{{ $sort === $column ? ($direction === 'asc' ? 'desc' : 'asc') : 'asc' }}')" @endif>
        {{ $label ?? $slot }}

        @if($sort === $column && $direction == 'asc')
            <x-svg.chevron-up class="ml-2 w-3 h-3 text-black dark:text-white fill-current"/>
        @elseif($sort === $column && $direction == 'desc')
            <x-svg.chevron-down class="ml-2 w-3 h-3 text-black dark:text-white fill-current"/>
        @endif

        @if($sort !== $column)
            <x-svg.chevron-down class="ml-2 w-3 h-3 text-gray-400 dark:text-white fill-current"/>
        @endif
    </button>
</th>