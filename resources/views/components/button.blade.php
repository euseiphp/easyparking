@props([
    'label' => null,

    'a' => null,
    'button' => true,

    'href' => null,
    'blank' => null,

    'small' => null,
    'medium' => null,
    'large' => null,
    'table' => null,

    'block' => null,

    'danger' => null,
    'success' => null,
    'warning' => null,
    'info' => null,
    'secondary' => null,
])

@php
    $type = $type ?? 'primary';

    if ($type === 'danger' || $danger) $type = 'danger';
    if ($type === 'success' || $success) $type = 'success';
    if ($type === 'warning' || $warning) $type = 'warning';
    if ($type === 'info' || $info) $type = 'info';
    if ($type === 'secondary' || $secondary) $type = 'secondary';
@endphp

@if($a)
    <a href="{{ $href ?? '#' }}"
        {{ $attributes->whereDoesntStartWith('wire')->class([
            'inline-flex items-center rounded-full border border-transparent font-medium justify-center text-white shadow-sm transition',
            'w-full' => $block !== null,
            'px-2 py-1 text-xs' => $small !== null,
            'px-2 py-2' => $table !== null,
            'px-6 py-2 text-md' => $medium !== null,
            'px-8 py-4 text-lg font-semibold' => $large !== null,
            'px-4 py-2' => $small === null && $medium === null && $large === null && $table === null,
            'bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2' => $type === 'secondary',
            'bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2' => $type === 'success',
            'bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2' => $type === 'danger',
            'bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2' => $type === 'info',
            'bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2' => $type === 'primary',
        ]) }} {{ $attributes->whereStartsWith('wire') }} @if($blank) target="_blank" @endif>
        {{ $label ?? $slot }}
    </a>
@endif

@if($button && !$a)
    <button
        {{ $attributes->whereDoesntStartWith('wire')->class([
            'inline-flex items-center rounded-full border border-transparent font-medium justify-center text-white shadow-sm transition',
            'w-full' => $block !== null,
            'px-2 py-1 text-xs' => $small !== null,
            'px-2 py-2' => $table !== null,
            'px-6 py-2 text-md' => $medium !== null,
            'px-8 py-4 text-lg font-semibold' => $large !== null,
            'px-4 py-2' => $small === null && $medium === null && $large === null && $table === null,
            'bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2' => $type === 'secondary',
            'bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2' => $type === 'success',
            'bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2' => $type === 'danger',
            'bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2' => $type === 'info',
            'bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2' => $type === 'primary',
        ]) }} {{ $attributes->whereStartsWith('wire') }}>
        {{ $label ?? $slot }}
    </button>
@endif
