@extends('layouts.app')

@section('title', 'Profil')

@section('content')

    <section class="overflow-hidden rounded-2xl border-2 border-black bg-zinc-800 shadow-[4px_4px_0_0_#000]">
        <div class="h-32 bg-linear-to-br from-rose-400 to-pink-500 md:h-40"></div>

        <div class="px-6 pb-4 md:flex md:items-end md:gap-6">
            <span class="-mt-12 grid size-24 shrink-0 place-items-center rounded-full border-4 border-zinc-800 bg-rose-400 text-4xl font-extrabold text-black">
                {{ Str::upper(Str::substr($username ?? '?', 0, 1)) }}
            </span>

            <div class="mt-3 min-w-0 md:mt-0 md:flex-1">
                <h1 class="text-2xl font-extrabold text-white md:text-3xl">{{ $username ?? '-' }}</h1>
                <p class="break-all text-sm text-zinc-400">{{ $user['email'] ?? '-' }}</p>
            </div>

            @if (isset($user['created_at']))
                <p class="mt-2 text-sm text-zinc-400 md:mt-0">
                    Bergabung {{ \Carbon\Carbon::parse($user['created_at'])->locale('id')->translatedFormat('d F Y') }}
                </p>
            @endif
        </div>

        <p class="px-6 pb-6 pt-2 leading-7 text-zinc-300">{{ $bio }}</p>
    </section>

    <dl class="mt-8 grid grid-cols-3 divide-x divide-rose-100 rounded-lg border border-rose-100 bg-white">
        <div class="px-4 py-4 sm:px-5">
            <dt class="text-xs text-gray-500 sm:text-sm">Total catatan</dt>
            <dd class="mt-1 font-serif text-2xl font-bold text-rose-700 sm:text-3xl">{{ $totalCatatan }}</dd>
        </div>
        <div class="px-4 py-4 sm:px-5">
            <dt class="text-xs text-gray-500 sm:text-sm">Pencapaian</dt>
            <dd class="mt-1 font-serif text-2xl font-bold text-rose-700 sm:text-3xl">{{ count($pencapaian) }}</dd>
        </div>
        <div class="px-4 py-4 sm:px-5">
            <dt class="text-xs text-gray-500 sm:text-sm">Hari bergabung</dt>
            <dd class="mt-1 font-serif text-2xl font-bold text-rose-700 sm:text-3xl">{{ $hari }}</dd>
        </div>
    </dl>

    <div class="mt-10 grid gap-10 md:grid-cols-2">

        <section>
            <h2 class="mb-4 border-l-4 border-rose-600 pl-3 font-serif text-xl font-bold">Keahlian</h2>
            <ul class="space-y-4 rounded-lg border border-rose-100 bg-white p-5">
                @foreach ($keahlian as $skill)
                    <li>
                        <div class="mb-1 flex items-center justify-between text-sm">
                            <span class="font-medium text-gray-900">{{ $skill['nama'] }}</span>
                            <span class="text-rose-700">{{ $skill['level'] }}%</span>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-rose-100" role="progressbar"
                             aria-valuenow="{{ $skill['level'] }}" aria-valuemin="0" aria-valuemax="100">
                            <div class="h-full rounded-full bg-rose-500" style="width: {{ $skill['level'] }}%"></div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>

        <section>
            <h2 class="mb-4 border-l-4 border-rose-600 pl-3 font-serif text-xl font-bold">Pencapaian</h2>
            <ul class="divide-y divide-rose-100 rounded-lg border border-rose-100 bg-white">
                @foreach ($pencapaian as $p)
                    <li class="flex items-center gap-4 px-5 py-4">
                        <span class="grid size-11 shrink-0 place-items-center rounded-full bg-rose-100 text-2xl" aria-hidden="true">{{ $p['ikon'] }}</span>
                        <span>
                            <span class="block font-medium text-gray-900">{{ $p['judul'] }}</span>
                            <span class="text-sm text-gray-500">{{ $p['tanggal'] }}</span>
                        </span>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>

    <section class="mt-10">
        <div class="mb-4 flex items-end justify-between">
            <h2 class="border-l-4 border-rose-600 pl-3 font-serif text-xl font-bold">Catatan terbaru</h2>
            <a href="{{ route('pengelolaan') }}" class="text-sm font-medium text-rose-700 underline-offset-4 hover:underline">Lihat semua</a>
        </div>

        <ul class="divide-y divide-rose-100 rounded-lg border border-rose-100 bg-white">
            @forelse ($catatanTerbaru as $note)
                <li>
                    <a href="{{ route('pengelolaan') }}"
                       class="flex items-center justify-between gap-4 px-5 py-4 hover:bg-rose-50/60 focus-visible:outline-2 focus-visible:outline-rose-600">
                        <span class="min-w-0">
                            <span class="block truncate font-medium text-gray-900">{{ $note['judul'] }}</span>
                            <span class="text-sm text-gray-500">{{ $note['kategori'] }} · {{ $note['tanggal'] }}</span>
                        </span>
                        <span class="shrink-0 rounded-sm bg-rose-100 px-2 py-0.5 text-xs font-medium text-rose-700">⏱ {{ $note['durasi'] }}</span>
                    </a>
                </li>
            @empty
                <li class="px-5 py-4 text-gray-500">Belum ada catatan.</li>
            @endforelse
        </ul>
    </section>
@endsection