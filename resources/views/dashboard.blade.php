@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <section>
        <h1 class="font-serif text-3xl font-bold text-gray-900 md:text-4xl">Halo, {{ $username ?? 'teman' }}!</h1>
        <p class="mt-2 text-gray-600">Ini ringkasan progres UTS kamu~ Dah sesuai diisi sama kamu yaa (≧◡≦)</p>
    </section>

    {{-- Statistik --}}
    <dl class="mt-8 grid grid-cols-3 divide-x divide-rose-100 rounded-lg border border-rose-100 bg-white">
        <div class="px-4 py-4 sm:px-5">
            <dt class="text-xs text-gray-500 sm:text-sm">Tugas selesai</dt>
            <dd class="mt-1 font-serif text-2xl font-bold text-rose-700 sm:text-3xl">{{ $done }}/{{ $total }}</dd>
        </div>
        <div class="px-4 py-4 sm:px-5">
            <dt class="text-xs text-gray-500 sm:text-sm">Jam ngoding</dt>
            <dd class="mt-1 font-serif text-2xl font-bold text-rose-700 sm:text-3xl">{{ $codingHours }}</dd>
        </div>
        <div class="px-4 py-4 sm:px-5">
            <dt class="text-xs text-gray-500 sm:text-sm">Jam debugging typo</dt>
            <dd class="mt-1 font-serif text-2xl font-bold text-rose-700 sm:text-3xl">{{ $debuggingHours }}</dd>
        </div>
    </dl>

    {{-- Progres --}}
    <section class="mt-10">
        <div class="mb-2 flex items-end justify-between">
            <h2 class="border-l-4 border-rose-600 pl-3 font-serif text-xl font-bold">Progres UTS</h2>
            <span class="text-sm font-medium text-rose-700">{{ $percent }}%</span>
        </div>
        <div class="h-3 overflow-hidden rounded-full bg-rose-100" role="progressbar"
             aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
            <div class="h-full rounded-full bg-rose-500" style="width: {{ $percent }}%"></div>
        </div>
    </section>

    <div class="mt-10 grid gap-10 md:grid-cols-2">
        {{-- Checklist --}}
        <section>
            <h2 class="mb-4 border-l-4 border-rose-600 pl-3 font-serif text-xl font-bold">Daftar tugas</h2>
            <ul class="divide-y divide-rose-100 rounded-lg border border-rose-100 bg-white">
                @foreach ($tasks as $task)
                    <li class="flex items-center gap-3 px-5 py-3">
                        @if ($task['done'])
                            <span class="grid size-6 place-items-center rounded-full bg-rose-500 text-xs text-white">✓</span>
                            <span class="text-gray-500 line-through">{{ $task['name'] }}</span>
                        @else
                            <span class="size-6 rounded-full border-2 border-rose-300"></span>
                            <span class="font-medium text-gray-900">{{ $task['name'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </section>

        {{-- Aktivitas --}}
        <section>
            <h2 class="mb-4 border-l-4 border-rose-600 pl-3 font-serif text-xl font-bold">Aktivitas terbaru</h2>
            <ul class="space-y-4 rounded-lg border border-rose-100 bg-white p-5">
                @foreach ($activities as $item)
                    <li>
                        <p class="text-sm text-gray-800">{{ $item['text'] }}</p>
                        <p class="text-xs text-gray-500">{{ $item['time'] }}</p>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>

    {{-- Akun (data asli dari session) --}}
    <section class="mt-10">
        <h2 class="mb-4 border-l-4 border-rose-600 pl-3 font-serif text-xl font-bold">Akun kamu</h2>
        <dl class="grid gap-4 rounded-lg border border-rose-100 bg-white p-5 text-sm sm:grid-cols-3">
            <div>
                <dt class="text-gray-500">Username</dt>
                <dd class="font-medium">{{ $username ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-gray-500">Email</dt>
                <dd class="break-all font-medium">{{ $user['email'] ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-gray-500">Masa berlaku sesi</dt>
                <dd class="font-medium">{{ $lifetime }} menit</dd>
            </div>
        </dl>
    </section>
@endsection