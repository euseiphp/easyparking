@props([

    'label' => null,

    'disabled' => false
])

@if($label)
    <label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
        {{ $value ?? $slot }}
    </label>

@endif

<input @disabled($disabled) {!! $attributes->merge(['class' => 'rounded-full shadow-sm focus:border-yellow-300 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 transition']) !!}>
