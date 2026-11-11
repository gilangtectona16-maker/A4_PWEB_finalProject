@php
    $loggedIn = session('logged_in') && session('user');

    // Menu berbeda untuk tamu dan pengguna yang sudah login
    $menu = $loggedIn
        ? [
            ['label' => 'Dashboard',   'href' => route('dashboard'),   'active' => request()->routeIs('dashboard')],
            ['label' => 'Pengelolaan', 'href' => route('pengelolaan'), 'active' => request()->routeIs('pengelolaan')],
        ]
        : [
            ['label' => 'Fitur',      'href' => route('landing') . '#fitur',      'active' => false],
            ['label' => 'Cara kerja', 'href' => route('landing') . '#cara-kerja', 'active' => false],
        ];
@endphp

<header class="border-b border-rose-100 bg-white">
    <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-x-6 gap-y-3 px-4 py-4">

        <a href="{{ $loggedIn ? route('dashboard') : route('landing') }}" class="flex items-center gap-3">
            <span class="grid size-10 place-items-center rounded-full bg-rose-600 font-serif text-lg font-bold text-white">:3</span>
            <span>
                <span class="block font-serif text-xl font-bold leading-tight text-gray-900">UTS PWEB</span>
                <span class="block text-xs text-gray-500">mumpung ada waktu ku gas kan</span>
            </span>
        </a>

        <div class="flex flex-wrap items-center gap-1 sm:gap-2">
            <nav class="flex items-center gap-1" aria-label="Menu utama">
                @foreach ($menu as $item)
                    <x-nav-link :href="$item['href']" :active="$item['active']">
                        {{ $item['label'] }}
                    </x-nav-link>
                @endforeach
            </nav>

            @if ($loggedIn)
                <x-dropdown label="Setting">
                    <x-dropdown-link :href="route('profile')">Profil</x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}" class="border-t border-rose-100">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2.5 text-left text-rose-700 hover:bg-rose-50">
                            Logout
                        </button>
                    </form>
                </x-dropdown>
            @else
                <a href="{{ route('showLogin') }}"
                   class="rounded-md border border-rose-300 px-3 py-1.5 text-sm font-medium text-rose-700 hover:bg-rose-50 focus-visible:outline-2 focus-visible:outline-rose-600">
                    Login
                </a>
                <a href="{{ route('showRegister') }}"
                   class="rounded-md bg-rose-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-rose-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-600">
                    Daftar
                </a>
            @endif
        </div>
    </div>
</header>