<x-app-layout>

    <x-layout.title>
        Página Inicial
    </x-layout.title>

    <div class="grid grid-cols-1 items-start gap-4 lg:grid-cols-3 lg:gap-8">
        <div class="grid grid-cols-1 gap-4 lg:col-span-2">
            <section aria-labelledby="section-1-title">
                <h2 class="sr-only" id="section-1-title">Section title</h2>
                <div class="overflow-hidden rounded-lg bg-white shadow">
                    <div class="p-6">
                        <div class="h-96 rounded-lg border-4 border-dashed border-gray-200"></div>
                    </div>
                </div>
            </section>
        </div>

        <div class="grid grid-cols-1 gap-4">
            <section aria-labelledby="section-2-title">
                <h2 class="sr-only" id="section-2-title">Section title</h2>
                <div class="overflow-hidden rounded-lg bg-white shadow">
                    <div class="p-6">
                        <div class="h-96 rounded-lg border-4 border-dashed border-gray-200"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
