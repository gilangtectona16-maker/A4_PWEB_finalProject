@extends('layouts.app')

@section('title', 'UTS PWEB · Catat perjalanan belajarmu')

@section('content')
    @php
        $loggedIn = session('logged_in') && session('user');
        $btnSolid   = 'rounded-md bg-rose-600 px-6 py-3 font-medium text-white hover:bg-rose-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-600';
        $btnOutline = 'rounded-md border border-rose-300 bg-white px-6 py-3 font-medium text-rose-700 hover:bg-rose-50 focus-visible:outline-2 focus-visible:outline-rose-600';
    @endphp

    {{-- ===== HERO ===== --}}
    <section class="grid items-center gap-10 py-6 md:grid-cols-2 md:py-12">
        <div>
            <p class="text-sm font-medium text-rose-700">Mumpung ada waktu, ku gas kan</p>
            <h1 class="mt-3 font-serif text-4xl font-bold leading-tight text-gray-900 md:text-5xl">
                Catat setiap langkah belajarmu, rapi di satu tempat.
            </h1>
            <p class="mt-4 max-w-prose text-lg leading-8 text-gray-600">
                UTS PWEB adalah ruang pribadi untuk mencatat progres, pelajaran, kesalahan, dan prestasi. Tanpa database, tanpa ribet.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                @if ($loggedIn)
                    <a href="{{ route('dashboard') }}" class="{{ $btnSolid }}">Buka dashboard</a>
                @else
                    <a href="{{ route('showRegister') }}" class="{{ $btnSolid }}">Daftar sekarang</a>
                    <a href="{{ route('showLogin') }}" class="{{ $btnOutline }}">Sudah punya akun? Masuk</a>
                @endif
            </div>
        </div>

        {{-- Pratinjau kartu (hiasan saja) --}}
        <div class="grid grid-cols-2 gap-4" aria-hidden="true">
            <div class="space-y-4">
                <div class="overflow-hidden rounded-2xl border-2 border-black bg-zinc-800 shadow-[4px_4px_0_0_#000]">
                    <div class="grid h-28 place-items-center bg-rose-400 text-5xl">🧭</div>
                    <div class="p-4">
                        <p class="text-xs font-semibold text-zinc-400">Laravel</p>
                        <p class="mt-1 text-sm font-extrabold text-white">Route harus diberi nama</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-2xl border-2 border-black bg-zinc-800 shadow-[4px_4px_0_0_#000]">
                    <div class="grid h-20 place-items-center bg-amber-300 text-4xl">🤦</div>
                    <div class="p-4">
                        <p class="text-xs font-semibold text-zinc-400">Debugging</p>
                        <p class="mt-1 text-sm font-extrabold text-white">Tiga jam gara-gara satu typo</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 space-y-4">
                <div class="overflow-hidden rounded-2xl border-2 border-black bg-zinc-800 shadow-[4px_4px_0_0_#000]">
                    <div class="grid h-20 place-items-center bg-sky-400 text-4xl">⚡</div>
                    <div class="p-4">
                        <p class="text-xs font-semibold text-zinc-400">Tailwind</p>
                        <p class="mt-1 text-sm font-extrabold text-white">Jalan lewat Vite</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-2xl border-2 border-black bg-zinc-800 shadow-[4px_4px_0_0_#000]">
                    <div class="grid h-32 place-items-center bg-emerald-400 text-5xl">🏆</div>
                    <div class="p-4">
                        <p class="text-xs font-semibold text-zinc-400">Prestasi</p>
                        <p class="mt-1 text-sm font-extrabold text-white">Horeee menang lomba!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== FITUR ===== --}}
    <section id="fitur" class="scroll-mt-8 py-12">
        <h2 class="border-l-4 border-rose-600 pl-3 font-serif text-2xl font-bold">Apa saja yang ada di sini?</h2>

        <div class="mt-8 grid gap-x-10 gap-y-8 sm:grid-cols-2">
            @foreach ($fitur as $f)
                <div class="flex gap-4">
                    <span class="grid size-12 shrink-0 place-items-center rounded-full bg-rose-100 text-2xl" aria-hidden="true">{{ $f['ikon'] }}</span>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-gray-900">{{ $f['judul'] }}</h3>
                        <p class="mt-1 leading-7 text-gray-600">{{ $f['isi'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ===== CARA KERJA ===== --}}
    <section id="cara-kerja" class="scroll-mt-8 py-12">
        <h2 class="border-l-4 border-rose-600 pl-3 font-serif text-2xl font-bold">Cara kerjanya</h2>

        <ol class="mt-8 grid gap-6 md:grid-cols-3">
            @foreach ($langkah as $l)
                <li class="rounded-lg border border-rose-100 bg-white p-5">
                    <span class="font-serif text-4xl font-bold text-rose-500">{{ $loop->iteration }}</span>
                    <h3 class="mt-2 font-serif text-lg font-bold text-gray-900">{{ $l['judul'] }}</h3>
                    <p class="mt-1 leading-7 text-gray-600">{{ $l['isi'] }}</p>
                </li>
            @endforeach
        </ol>
    </section>

    {{-- ===== TEKNOLOGI ===== --}}
    <section class="py-8">
        <p class="text-sm text-gray-500">Dibangun dengan</p>
        <ul class="mt-3 flex flex-wrap gap-2">
            @foreach ($teknologi as $t)
                <li class="rounded-full border border-rose-200 bg-white px-4 py-1.5 text-sm font-medium text-rose-700">{{ $t }}</li>
            @endforeach
        </ul>
    </section>

    {{-- ===== AJAKAN AKHIR ===== --}}
    <section class="my-12 rounded-2xl border-2 border-black bg-zinc-800 px-6 py-12 text-center shadow-[4px_4px_0_0_#000]">
        <h2 class="font-serif text-3xl font-bold text-white">Siap mulai mencatat?</h2>
        <p class="mx-auto mt-3 max-w-md leading-7 text-zinc-300">
            Buat akun dalam hitungan detik dan mulai kumpulkan perjalanan belajarmu.
        </p>

        <div class="mt-6 flex flex-wrap justify-center gap-3">
            @if ($loggedIn)
                <a href="{{ route('dashboard') }}" class="{{ $btnSolid }}">Buka dashboard</a>
            @else
                <a href="{{ route('showRegister') }}" class="{{ $btnSolid }}">Daftar sekarang</a>
                <a href="{{ route('showLogin') }}" class="rounded-md border border-zinc-600 px-6 py-3 font-medium text-zinc-200 hover:bg-zinc-700">Masuk</a>
            @endif
        </div>
    </section>
@endsection