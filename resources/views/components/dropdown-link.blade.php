@props(['href'])

<a href="{{ $href }}" {{ $attributes->class('block px-4 py-2.5 hover:bg-rose-50') }}>
    {{ $slot }}
</a>