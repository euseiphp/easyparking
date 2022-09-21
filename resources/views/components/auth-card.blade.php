<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div {{ $attributes->merge(['class' => 'w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg']) }}>
        {{ $slot }}
    </div>
</div>
