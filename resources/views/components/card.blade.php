@props([

    'body' => null,
    'footer' => null,

    'alpine' => null,
])

<div {{ $attributes->merge(['class' => 'shadow bg-white overflow-hidden rounded-lg']) }} @if($alpine) {!! $alpine !!} @endif>

    @if ($body)
        <div {{ $body->attributes->class(['px-4 py-5 sm:px-6']) }}>
            {{ $body }}
        </div>
    @endif

    @if ($footer)
        <footer {{ $footer->attributes->class(['px-4 py-3 text-right sm:px-6']) }}>
            {{ $footer }}
        </footer>
    @endif
</div>
