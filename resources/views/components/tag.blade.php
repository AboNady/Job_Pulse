{{-- resources/views/components/tag.blade.php --}}
@props(['tag', 'size' => 'base', 'variant' => 'primary', 'glow' => true])

@php
    $tagLabel = is_object($tag) ? $tag->name : $tag;
    $tagId = is_object($tag) ? $tag->id : $tag;

    // Match job card variants exactly
    $variants = [
        'primary' => [
            'bg' => 'bg-gradient-to-br from-blue-500/10 to-blue-600/5',
            'border' => 'border border-blue-500/20',
            'hover' => 'hover:border-blue-400/40 hover:bg-gradient-to-br hover:from-blue-500/20 hover:to-blue-600/15',
            'text' => 'text-blue-300',
            'hoverText' => 'hover:text-blue-200',
        ],
        'secondary' => [
            'bg' => 'bg-gradient-to-br from-slate-600/10 to-slate-700/5',
            'border' => 'border border-slate-600/20',
            'hover' => 'hover:border-slate-500/40 hover:bg-gradient-to-br hover:from-slate-600/20 hover:to-slate-700/15',
            'text' => 'text-slate-300',
            'hoverText' => 'hover:text-slate-200',
        ],
    ];

    $selected = $variants[$variant] ?? $variants['primary'];

    // Base classes - exactly matching job card spacing
    $classes = "
        inline-flex items-center justify-center font-medium rounded-lg
        transition-all duration-200 ease-out cursor-pointer
        {$selected['bg']}
        {$selected['border']}
        {$selected['text']}
        {$selected['hover']}
        {$selected['hoverText']}
        whitespace-nowrap
    ";

    // Size variations with consistent spacing
    switch ($size) {
        case 'xs':
            $classes .= " text-[10px] px-2 py-0.5 font-bold uppercase tracking-wider";
            break;
        case 'sm':
            $classes .= " text-xs px-3 py-1.5 font-thin";
            break;
        case 'base':
            $classes .= " text-sm px-4 py-2 font-thin";
            break;
        case 'lg':
            $classes .= " text-base px-5 py-2.5 font-medium";
            break;
    }

    if ($glow) {
        $classes .= " shadow-sm";
    }
@endphp

<a href="{{ route('tags', $tag) }}" 
   class="{{ trim($classes) }}"
   title="{{ $tagLabel }}">
    
    <span class="truncate max-w-[120px]">{{ $tagLabel }}</span>
</a>