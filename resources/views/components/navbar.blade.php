@php
    $menu = [
        [
            'label' => 'Dashboard',   
            'route' => 'dashboard'],
        [
            'label' => 'Pengelolaan', 
            'route' => 'pengelolaan'],
    ];
@endphp

<header class="border-b border-rose-100 bg-white">
    <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-x-6 gap-y-3 px-4 py-4">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <span class="grid size-10 place-items-center rounded-full bg-rose-600 font-serif text-lg font-bold text-white">:3</span>
            <span>
                <span class="block font-serif text-xl font-bold leading-tight text-gray-900">UTS PWEB</span>
                <span class="block text-xs text-gray-500">mumpung ada waktu ku gas kan</span>
            </span>
        </a>

        <div class="flex flex-wrap items-center gap-1 sm:gap-2">
            <nav class="flex items-center gap-1" aria-label="Menu utama">
                @foreach ($menu as $item)
                    <x-nav-link :href="route($item['route'])" :active="request()->routeIs($item['route'])">
                        {{ $item['label'] }}
                    </x-nav-link>
                @endforeach
            </nav>

            <x-dropdown label="Setting">
                <x-dropdown-link :href="route('profile')">Profil</x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}" class="border-t border-rose-100">
                    @csrf
                    <button type="submit" class="block w-full px-4 py-2.5 text-left text-rose-700 hover:bg-rose-50">
                        Logout
                    </button>
                </form>
            </x-dropdown>
        </div>
    </div>
</header>