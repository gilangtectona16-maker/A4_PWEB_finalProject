@props(['href', 'active' => false])

<a href="{{ $href }}" @if ($active) aria-current="page" @endif
   {{ $attributes->class([
       'rounded-md px-3 py-1.5 text-sm font-medium transition-colors focus-visible:outline-2 focus-visible:outline-rose-600',
       'bg-rose-100 text-rose-700' => $active,
       'text-gray-700 hover:bg-rose-50' => !$active,
   ]) }}>
    {{ $slot }}
</a>