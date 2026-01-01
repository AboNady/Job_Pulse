
{{-- select.blade.php --}}
@props(['label', 'name'])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl 
                   text-slate-100 text-sm appearance-none cursor-pointer
                   focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                   hover:border-slate-600 transition-colors duration-200'
    ];
@endphp

<x-forms.field :$label :$name>
    <div class="relative">
        <select {{ $attributes->merge($defaults) }}>
            {{ $slot }}
        </select>
        <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500 pointer-events-none" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
    </div>
</x-forms.field>