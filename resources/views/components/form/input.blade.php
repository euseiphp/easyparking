@props([

    'label' => null,
    'disabled' => false
])

@if($label)
    <label class="font-medium text-sm text-gray-700 ml-2">
        {{ $label }}
    </label>
@endif

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'mt-2 block w-full rounded-full text-gray-600 shadow-sm border-gray-300 focus:border-yellow-300 focus:ring focus:ring-yellow-300 focus:ring-opacity-50 transition']) !!}>

<x-form.error name="{{ $attributes->get('name', $attributes->whereStartsWith('wire:model')->first()) }}" />
