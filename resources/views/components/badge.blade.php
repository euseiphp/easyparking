@props([
    'label' => null,
    'type' => null,
    'group' => null,

    'rounded' => null,

    'danger' => null,
    'success' => null,
    'warning' => null,
    'info' => null,
    'secondary' => null,
])

@php
    $type = $type ?? 'primary';

    if ($label === null) {
        $label = $slot->isEmpty() ? 'N/A' : $slot;
        $secondary = true;
    }

    if ($type === 'danger' || $danger) $type = 'danger';
    if ($type === 'success' || $success) $type = 'success';
    if ($type === 'info' || $info) $type = 'info';
    if ($type === 'secondary' || $secondary) $type = 'secondary';
@endphp

<span
    {{ $attributes->class([
        'inline-flex items-center px-2.5 py-0.5 text-xs font-medium text-white rounded-full',
        'rounded-full' => $rounded !== null,
        'bg-gray-400' => $type === 'secondary' && $group === null,
        'bg-green-500' => $type === 'success' && $group === null,
        'bg-red-500' => $type === 'danger' && $group === null,
        'bg-blue-500' => $type === 'info' && $group === null,
        'bg-yellow-500' => $type === 'primary' && $group === null,
    ]) }} @if($label && $group) style="background-color: {!! $group !!}" @endif>
    {{ $label ?? $slot }}
</span>
