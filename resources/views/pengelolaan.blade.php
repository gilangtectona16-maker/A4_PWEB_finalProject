@extends('layouts.app')

@section('title', 'Catatan Belajar')

@section('content')

    <header class="mb-8">
        <h1 class="font-serif text-3xl font-bold text-gray-900 md:text-4xl">Pengelolaan catatan</h1>
        <p class="mt-2 text-gray-600">Hal-hal yang kupelajari, dan kesalahan yang kubuat, dan prestasi yang ku dapat.</p>
    </header>

    <div class="rounded-3xl">
        <div class="columns-1 gap-4 sm:columns-2 lg:columns-4">
            @foreach ($catatan as $note)
            <article class="mb-4 break-inside-avoid overflow-hidden rounded-2xl border-2 border-black bg-zinc-800 shadow-[4px_4px_0_0_#000]">
                <div class="relative overflow-hidden bg-emerald-400">
                    @if (!empty($note['gambar']))
                        <img src="{{ $note['gambar'] }}" alt="gambar 1" class="h-full w-full object-cover" loading="lazy">
                    @else
                        <div class="h-32 w-full bg-linear-to-r from-emerald-400 to-teal-500" loading="lazy">
                        </div>
                    @endif
                    <span class="absolute left-3 top-3 rounded-full bg-black/80 px-2.5 py-1 text-xs font-bold text-white">({{ $note['durasi'] }})</span>
                </div>
                <div class="px-4 pb-5">
                    <div class="relative -mt-5 mb-3 flex items-center gap-2">
                        <span class="grid size-10 place-items-center rounded-full border-4 border-zinc-800 bg-emerald-400 text-sm font-extrabold text-black">
                            {{ $loop->iteration }}
                        </span>
                        <span class="mt-5 text-xs font-semibold text-zinc-300">{{ $note['kategori'] }}</span>
                    </div>
                    <h3 class="text-base font-extrabold leading-snug text-white">{{ $note['judul'] }}</h3>
                    <div class="mt-3 space-y-2 text-sm leading-6 text-zinc-400">
                        @foreach ($note['isi'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                    <p class="mt-4 text-xs text-zinc-500">{{ $note['tanggal'] }}</p>
                </div>
            </article>
            @endforeach
        </div>
    </div>
@endsection