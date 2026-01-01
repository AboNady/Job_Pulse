{{-- resources/views/components/forms/checkbox.blade.php --}}
@props(['label', 'name', 'checked' => false])

@php
    $defaults = [
        'type' => 'checkbox',
        'id' => $name,
        'name' => $name,
        'value' => '1',
        'class' => 'w-5 h-5 rounded border-2 border-slate-600 bg-slate-800 
                   checked:bg-blue-600 checked:border-blue-600
                   focus:ring-2 focus:ring-blue-400/50 focus:ring-offset-slate-900
                   cursor-pointer transition-all duration-200'
    ];
@endphp

<x-forms.field :$label :$name>
    <div class="flex items-center gap-3 px-5 py-4 bg-slate-800/50 rounded-xl border border-slate-700/50 
                hover:border-slate-600 transition-colors duration-200">
        <input {{ $attributes($defaults) }} @if($checked || old($name)) checked @endif>
        <label for="{{ $name }}" class="text-slate-200 font-medium cursor-pointer select-none">
            {{ $label }}
        </label>
    </div>
</x-forms.field>