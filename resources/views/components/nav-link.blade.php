@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-white text-sm font-medium rounded-full bg-yellow-500 px-3 py-2 transition'
            : 'text-white text-sm font-medium rounded-full bg-white bg-opacity-0 px-3 py-2 hover:bg-yellow-500 hover:text-white transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
