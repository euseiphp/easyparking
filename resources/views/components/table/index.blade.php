@props([
    'items' => null,
])

<div class="w-full">
    <div {{ $attributes->merge(['class' => 'flex flex-col']) }}>
        <div class="-my-2 -mx-4 overflow-x-auto">
            <div class="inline-block min-w-full py-2 md:px-4">
                <div class="rounded-lg overflow-hidden shadow ring-1 ring-black ring-opacity-5">
                    <table class="min-w-full divide-y divide-gray-300 dark:divide-yellow-400">
                        {{ $slot }}
                    </table>
                </div>
                @if ($items && $items->total() > 0)
                    {{ $items->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
