<nav x-data="{ open: false }" class="nav-bgcolor shadow-bottom ">
    <!-- Primary Navigation Menu -->
    <div class="container pt-2 pb-1 navbar-first">
        <div class=" row d-flex justify-content-between align-items-center">
            <div class=" col-4">
                <!-- Logo -->
                <div class="shrink-0 flex text-center">
                    <a class=" " href="{{ route('admin.events.index') }}">
                        <img style="width: 60%" src="{{URL::asset('/img/logo-orizzontale-bianco.jpeg')}}" alt="">
                    </a>
                </div>

                
            </div>

          
            <div class="  col-4">
                <!-- Navigation Links -->
                <div class="text-center">
                    <a class="text-decoration-none me-2 subtitle-font text-color link-nav-center {{ request()->routeIs('admin.events.index') ? 'active-link' : 'disabled-link' }} " href="{{ route('admin.events.index') }}">
                        {{ __('Eventi') }}
                    </a>
                    <a class="text-decoration-none me-2 subtitle-font text-color link-nav-center {{ request()->routeIs('admin.favorites.index') ? 'active-link' : 'disabled-link' }}" href="{{ route('admin.favorites.index') }}">
                        Preferiti
                    </a>
                    
                </div>

                
            </div>
            <div class=" col-4">
                <!-- Navigation Links -->
                <div class="text-end">
                    <a class="text-decoration-none me-2 subtitle-font text-color  link-nav-end {{ request()->routeIs('admin.events.create') ? 'active-link' : '' }}" href="{{ route('admin.events.create') }}">
                        Crea evento
                    </a>
                    <a class="text-decoration-none mx-2 subtitle-font text-color  link-nav-end {{ request()->routeIs('profile.show') ? 'active-link' : '' }} " href="{{ route('profile.show') }}">
                        Profilo
                    </a>
                    {{-- <a class="text-decoration-none me-2 subtitle-font text-color  link-nav-end " href="{{ route('profile.edit') }}">
                        Modifica profilo
                    </a> --}}
                    <form class="d-inline me-2 " method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="subtitle-font text-color text-decoration-none link-nav-end "
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Esci') }}
                        </a>

                    </form>

                    
                </div>

                
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.index')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
