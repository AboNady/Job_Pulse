<button {{ $attributes->merge(['class' => '
    relative overflow-hidden inline-flex items-center justify-center 
    px-8 py-3
    bg-gradient-to-br from-blue-600 to-blue-700 
    border-t border-white/10
    text-white font-bold tracking-wide text-sm
    rounded-xl 
    shadow-lg shadow-blue-900/20
    
    transition-all duration-200 ease-out 
    
    hover:from-blue-500 hover:to-blue-600 
    hover:shadow-blue-500/25 hover:-translate-y-0.5 cursor-pointer
    
    active:scale-[0.98] active:translate-y-0
    
    focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:ring-offset-2 focus:ring-offset-slate-900
    
    disabled:opacity-70 disabled:cursor-not-allowed disabled:grayscale-[0.5]
']) }}>
    
    {{-- Optional: Subtle Inner "Shine" on Hover --}}
    <span class="absolute inset-0 bg-white/5 opacity-0 hover:opacity-100 transition-opacity duration-200 pointer-events-none"></span>

    {{-- Content Wrapper --}}
    <span class="relative flex items-center gap-2">
        {{ $slot }}
    </span>
</button>