@props(['label'])

<details data-dropdown class="relative">
    <summary class="flex cursor-pointer list-none items-center gap-1 rounded-md border border-rose-300 px-3 py-1.5 text-sm font-medium text-rose-700 hover:bg-rose-50 focus-visible:outline-2 focus-visible:outline-rose-600 [&::-webkit-details-marker]:hidden">
        {{ $label }} <span aria-hidden="true">▾</span>
    </summary>

    <div class="absolute right-0 z-20 mt-2 w-44 overflow-hidden rounded-lg border border-rose-100 bg-white text-sm shadow-lg">
        {{ $slot }}
    </div>
</details>

@once
    @push('scripts')
        <script>
            document.addEventListener('click', (e) => {
                document.querySelectorAll('[data-dropdown][open]').forEach((d) => {
                    if (!d.contains(e.target)) d.removeAttribute('open');
                });
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    document.querySelectorAll('[data-dropdown][open]').forEach((d) => d.removeAttribute('open'));
                }
            });
        </script>
    @endpush
@endonce