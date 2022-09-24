<div>
    <div role="navigation" aria-label="Pagination Navigation" class="mt-4 mb-10 flex h-16 items-center justify-between border border-gray-200 rounded-lg bg-yellow-50 px-4">
        <div class="flex flex-1 items-center justify-between">

            <div class="flex items-center">
                <x-form.select
                    wire:model.debounce.500ms="quantity"
                    :options="[
                        10 => '10',
                        30 => '30',
                        50 => '50',
                        100 => '100',
                    ]" />
            </div>

            <div class="flex items-end space-x-1">
                <span>
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-500 bg-opacity-50 cursor-default leading-5 rounded-md select-none">
                            <x-svg.chevron-left class="h-4 w-4" />
                        </span>
                    @else
                        <button wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-500 leading-5 rounded-md hover:shadow-yellow-500 transition">
                            <x-svg.chevron-left class="h-4 w-4" />
                        </button>
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-500 leading-5 rounded-md hover:shadow-yellow-500 transition">
                            <x-svg.chevron-right class="h-4 w-4" />
                        </button>
                    @else
                        <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-500 bg-opacity-50 cursor-default leading-5 rounded-md select-none">
                            <x-svg.chevron-right class="h-4 w-4" />
                        </span>
                    @endif
                </span>
            </div>

        </div>
    </div>
</div>
