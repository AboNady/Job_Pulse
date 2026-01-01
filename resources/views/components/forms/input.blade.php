@props(['label', 'name', 'value' => '', 'type' => 'text'])

@php
    // 1. Detect if there is a validation error for this specific field
    $hasError = $errors->has($name);

    // 2. Define base styles vs Error styles
    $baseStyles = "w-full px-5 py-3 rounded-xl text-sm font-medium transition-all duration-200 
                   focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-offset-[#111827]"; // offset matches dark bg
    
    // Normal State (Gray/Blue)
    $normalState = "bg-slate-800/50 border border-slate-700/50 text-slate-100 placeholder-slate-500
                    hover:border-slate-600 focus:border-blue-500 focus:ring-blue-500/30";

    // Error State (Red)
    $errorState = "bg-red-500/5 border border-red-500/50 text-red-100 placeholder-red-300
                   focus:border-red-500 focus:ring-red-500/30";

    $classes = $baseStyles . ' ' . ($hasError ? $errorState : $normalState);

    $defaults = [
        'type' => $type,
        'id' => $name,
        'name' => $name,
        'value' => old($name, $value),
        'class' => $classes,
    ];
@endphp

<x-forms.field :$label :$name>
    <input {{ $attributes->merge($defaults) }} />
    

</x-forms.field>