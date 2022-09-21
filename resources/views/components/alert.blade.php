@props([
    'danger' => null,
    'success' => null,
    'warning' => null,
    'info' => null,
    'secondary' => null,

    'dismissable' => null,

    'center' => null,
    'my' => null,
    'icon' => null,
])

@php
    $type = 'primary';

    if ($danger) $type = 'danger';
    if ($success) $type = 'success';
    if ($warning) $type = 'warning';
    if ($info) $type = 'info';
    if ($secondary) $type = 'secondary';


    $dismiss = false;

    if ($dismissable) $dismiss = true;
@endphp

<div @class([
        'border-l-4 p-4',
        'my-' . $my => $my !== null,
        'border-red-400 bg-red-200 ' => $type === 'danger',
        'border-green-400 bg-green-200 ' => $type === 'success',
        'border-yellow-400 bg-yellow-200 ' => $type === 'warning',
        'border-blue-400 bg-blue-200 ' => $type === 'info',
        'border-gray-400 bg-gray-200 ' => $type === 'secondary',
        'border-primary-200 bg-primary-400 ' => $type === 'primary',
    ]) @if($dismiss) x-data="{ showAlert : true }" x-cloak x-show="showAlert" @endif>
    <div @class([
            'flex',
            'justify-center' => $center !== null,
        ])>
        <div class="flex-shrink-0">
            @if($icon)
                <x-dynamic-component component="svg.{{ $icon }}" @class([
                    'h-5 w-5',
                    'text-red-600' => $type === 'danger',
                    'text-green-600' => $type === 'success',
                    'text-yellow-600' => $type === 'warning',
                    'text-blue-600' => $type === 'info',
                    'text-gray-600' => $type === 'secondary',
                    'text-primary-200' => $type === 'primary',
                ]) />
            @endif
        </div>
        <div class="ml-2">
            <p @class([
                'text-sm',
                'text-red-700' => $type === 'danger',
                'text-green-700' => $type === 'success',
                'text-yellow-700' => $type === 'warning',
                'text-blue-700' => $type === 'info',
                'text-gray-700' => $type === 'secondary',
                'text-white' => $type === 'primary',
            ])>
                {{ $slot }}
            </p>
        </div>
        @if($dismiss)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button
                        type="button"
                        @click="showAlert = !showAlert"
                        @class([
                            'inline-flex p-1.5',
                            'text-green-500' => $type === 'success',
                            'text-red-500' => $type === 'danger',
                            'text-yellow-500' => $type === 'warning',
                            'text-blue-500' => $type === 'info',
                            'text-gray-500' => $type === 'secondary',
                            'text-primary-500' => $type === 'primary',
                        ])>
                        <span class="sr-only">Dismiss</span>
                        <x-svg.x-mark class="h-4 w-4" />
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
