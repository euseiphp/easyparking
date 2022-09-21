@props(['title'])

<h1 class="text-2xl font-semibold text-white mb-4">{{ $title ?? $slot }}</h1>

