@props([
    'trigger',

    'title' => null,
    'footer'  => null,

    'close' => true,

    'blur' => true,

    'dismiss' => false,
])

<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="{{ $trigger }}" x-cloak>
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div
            x-show="{{ $trigger }}"
            x-cloak
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-opacity-75 transition-opacity"
            :class="{'backdrop-blur-sm bg-gray-300' : @js($blur), 'bg-gray-500' : !@js($blur) }"
            aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true" x-cloak>&#8203;</span>

        <div
            x-show="{{ $trigger }}"
            x-cloak
            @if($dismiss) @click.outside="{{ $trigger }} = false" @endif
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative inline-block align-top bg-white dark:bg-gray-600 px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-top sm:max-w-lg sm:w-full sm:p-6">
            @if($close)
                <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                    <button @click="{{ $trigger }} = false" type="button" class="bg-transparent text-gray-400 dark:text-white hover:text-gray-500 focus:outline-none focus:ring-0">
                        <x-svg.x-mark class="h-6 w-6" />
                    </button>
                </div>
            @endif
            <div class="w-full">
                <div class="mt-3 text-center sm:mt-0 sm:text-left">
                    @if($title)
                        <h3 class="text-lg leading-6 font-semibold text-primary-700 dark:text-white" id="modal-title">{!! $title !!}</h3>
                    @endif
                    {{ $slot }}
                </div>
            </div>
            <div class="mt-5 gap-2 sm:mt-4 flex justify-end">
                @if($close)
                    <x-button-outline secondary @click="{{ $trigger }} = false">
                        Fechar
                    </x-button-outline>
                @endif
                @if ($footer)
                    {{ $footer }}
                @endif
            </div>
        </div>
    </div>
</div>
