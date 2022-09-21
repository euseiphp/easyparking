<x-guest-layout>
    <x-auth-card class="max-w-md">
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('login') }}" x-data="{ show : false }">
            @csrf

            <div>
                <x-form.input label="E-mail" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-form.input label="Senha" id="password" class="block mt-1 w-full"
                                ::type="show ? 'text' : 'password'"
                                name="password"
                                required autocomplete="current-password" />

                <div class="flex justify-end mt-2 mr-2" x-cloak>
                    <x-svg.eye-slash class="h-6 w-6 text-gray-300" @click="show = !show" x-show="!show" />
                    <x-svg.eye class="h-6 w-6 text-gray-500" @click="show = !show" x-show="show" />
                </div>
            </div>

            <div class="block mt-4">
                <x-form.checkbox label="Manter Conectado" name="remember" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button block>
                    {{ __('Entrar') }}
                </x-button>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button-outline a :href="route('password.request')" block small>
                    Recuperar Senha
                </x-button-outline>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
