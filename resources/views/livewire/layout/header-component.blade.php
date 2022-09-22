@php /** @var \App\Models\User $user */ @endphp
@php($user = user())

<div class="inline-flex space-x-4">
    <div class="mt-1">
        <p class="text-white font-semibold">{{ $user->name }}</p>
    </div>
    <div>
        <button @click="open" type="button" class="flex rounded-full bg-white text-sm focus:outline-none" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
            <span class="sr-only">Open user menu</span>
            <img class="h-8 w-8 rounded-full" src="{{ $user->avatar }}" alt="">
        </button>
    </div>
</div>
