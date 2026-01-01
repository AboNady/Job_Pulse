@props([
    'icon' => 'info',
    'label' => '',
    'value' => '',
])

@php
    // Map icon names to inline SVGs
    $icons = [
        'briefcase' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M9 17v-2m6 2v-2m-9 4h12a2 2 0 002-2v-5H3v5a2 2 0 002 2zm12-10h-3V5a2 2 0 00-2-2H9a2 2 0 00-2 2v2H4m5-2h6" />',

        'calendar' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10m-12 9h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />',

        'office' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 21h16M4 10h16M8 6h.01M12 6h.01M16 6h.01M9 14h6m-8 4h10V3H7v15z" />',

        'info' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />',
    ];

    $svg = $icons[$icon] ?? $icons['info'];
@endphp

<div class="flex items-start gap-4">
    {{-- Icon --}}
    <div class="p-2 bg-slate-800 rounded-lg text-slate-400 flex-shrink-0">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {!! $svg !!}
        </svg>
    </div>

    {{-- Text --}}
    <div>
        <p class="text-slate-400 text-xs mb-0.5">{{ $label }}</p>
        <p class="text-white font-medium">{{ $value }}</p>
    </div>
</div>
