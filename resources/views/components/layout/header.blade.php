<header class="bg-yellow-600 pb-24" x-data="header">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="relative flex items-center justify-between py-5 sm:py-0">

            <div class="hidden py-5 lg:block">
                <div class="grid grid-cols-3 items-center gap-8">
                    <div class="col-span-2">
                        <nav class="flex space-x-4">
                            @foreach($routes as $name => $route)
                                <x-nav-link href="{{ route($route) }}" :active="request()->routeIs($route)">
                                    {{ $name }}
                                </x-nav-link>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </div>

            <div class="hidden lg:ml-4 lg:flex lg:items-center lg:pr-0.5">

                <div class="relative ml-4 flex-shrink-0">

                    <livewire:layout.header-component/>

                    <div
                        x-cloak
                        x-show="show"
                        @click.outside="close"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute -right-2 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <a href="{{ route('profile-component') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50" role="menuitem" tabindex="-1" id="user-menu-item-0">Perfil</a>
                        <a href="{{ route('security-component') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50" role="menuitem" tabindex="-1" id="user-menu-item-1">Senha</a>
                        <hr>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50" role="menuitem" tabindex="-1" id="user-menu-item-2">Sair</a>
                    </div>
                </div>
            </div>

            <div class="absolute right-0 flex-shrink-0 lg:hidden">
                <button x-cloak @click="open" type="button" class="inline-flex items-center justify-center rounded-md bg-transparent p-2 text-indigo-200 hover:bg-white hover:bg-opacity-10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>

                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="lg:hidden">
        <div
            x-cloak
            x-show="show"
            x-transition:enter="duration-150 ease-out"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="duration-150 ease-in"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-20 bg-black bg-opacity-25" aria-hidden="true"></div>

        <div
            x-cloak
            x-show="show"
            x-transition:enter="duration-150 ease-out"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="duration-150 ease-in"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute inset-x-0 top-0 z-30 mx-auto w-full max-w-3xl origin-top transform p-2 transition">
            <div class="rounded-lg bg-yellow-600 shadow-lg ring-1 ring-black ring-opacity-5">
                <div class="pt-3 pb-2">
                    <div class="flex items-center justify-between px-4">
                        <div>
                            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                        </div>
                        <div class="-mr-2">
                            <button x-cloak @click="close" type="button" class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                <span class="sr-only">Close menu</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        @foreach($routes as $name => $route)
                            <x-nav-link href="{{ route($route) }}" :active="request()->routeIs($route)">
                                {{ $name }}
                            </x-nav-link>
                        @endforeach
                    </div>
                </div>
                <div class="pt-4 pb-2">
                    <div class="flex items-center px-5">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </div>
                        <div class="ml-3 min-w-0 flex-1">
                            <div class="truncate text-base font-medium text-white">Tom Cook</div>
                            <div class="truncate text-sm font-medium text-white">tom@example.com</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-100 hover:text-gray-800">Your Profile</a>
                        <a href="{{ route('logout') }}" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-100 hover:text-gray-800">Sign out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
