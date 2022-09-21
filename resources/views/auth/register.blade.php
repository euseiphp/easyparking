<x-guest-layout>
    <x-auth-card class="max-w-2xl">
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        @if(($error = session('error')) !== null)
            <div class="mb-4">
                <x-alert dismissable danger>
                    {{ $error }}
                </x-alert>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" x-data>
            @csrf

            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-6 sm:col-span-3">
                    <x-form.input label="Nome" type="text" name="name" :value="old('name')" required autofocus />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form.input label="Telefone" type="text" name="phone" :value="old('phone')" x-mask:dynamic="(() => $input.length <= 14 ? '(99) 9999-9999' : '(99) 99999-9999')" required />
                </div>
                <div class="col-span-full">
                    <x-form.input label="E-mail" type="email" name="email" :value="old('email')" required />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form.input label="Senha" id="password" type="password" name="password" required autocomplete="off" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form.input label="Confirme a Senha" id="password_confirmation" type="password" name="password_confirmation" required />
                </div>
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-button block>
                    {{ __('Criar Conta') }}
                </x-button>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Já Possui Conta?') }}
                    </a>
                @endif
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
