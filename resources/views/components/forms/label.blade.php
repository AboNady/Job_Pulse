@props(['name', 'label'])

@php
    // Detect error state
    $hasError = $errors->has($name);

    // Dynamic classes based on state
    $textColor = $hasError ? 'text-red-400' : 'text-slate-300';
    $dotColor  = $hasError ? 'from-red-400 to-red-600' : 'from-blue-400 to-blue-600';
@endphp

<label for="{{ $name }}" class="inline-flex items-center gap-2 mb-2 group cursor-pointer">
    {{-- The "Pixel" Dot --}}
    <span class="w-2 h-2 bg-gradient-to-br {{ $dotColor }} rounded-[1px] shadow-sm opacity-80 group-hover:opacity-100 transition-opacity duration-200"></span>
    
    {{-- The Label Text --}}
    <span class="text-xs font-semibold uppercase tracking-wide {{ $textColor }} transition-colors duration-200">
        {{ $label }}
    </span>
</label>