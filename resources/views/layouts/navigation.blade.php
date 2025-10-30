<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigasi Utama (Desktop) -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('riwayat.index')" :active="request()->routeIs('riwayat.*')">
                        Konsultasi
                    </x-nav-link>

                     @if(Auth::user()->role === 'admin')
                     <x-nav-link :href="route('admin.jurusan.index')" :active="request()->routeIs('jurusan.*')">
                        Jurusan
                    </x-nav-link>

                    <x-nav-link :href="route('admin.pertanyaan.index')" :active="request()->routeIs('pertanyaan.*')">
                        Pertanyaan
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Dropdown Menu (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <!-- Dropdown User -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition ease-in-out duration-150">
                            {{ Auth::user()->name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Navigasi Utama (Mobile) -->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('riwayat.index')" :active="request()->routeIs('riwayat.*')">
                Riwayat Saya
            </x-responsive-nav-link>
        </div>

        <!-- Menu Admin (Mobile) -->
        @if(Auth::user()->role === 'admin')
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin Panel</p>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('admin.jurusan.index')" :active="request()->routeIs('admin.jurusan.*')">
                        Manajemen Jurusan
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.pertanyaan.index')" :active="request()->routeIs('admin.pertanyaan.*')">
                        Manajemen Pertanyaan
                    </x-responsive-nav-link>
                </div>
            </div>
        @endif

        <!-- Responsive Settings Options (Mobile) -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>