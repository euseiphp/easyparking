@props(['name'])

@if ($errors->has($name))
    <span {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 dark:font-semibold mt-4 ml-3']) }}>
        {{ $errors->first($name) }}
    </span>
@endif
