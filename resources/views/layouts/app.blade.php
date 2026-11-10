<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'UTS PWEB')</title>
        @yield('meta')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body id="top" class="flex min-h-screen flex-col bg-rose-50/40 text-gray-800 antialiased">
        @include('components.navbar')

        <main class="mx-auto my-8 w-full max-w-6xl flex-1 px-4">
            @yield('content')
        </main>

        @include('components.footer')
        @stack('scripts')
    </body>
</html>
