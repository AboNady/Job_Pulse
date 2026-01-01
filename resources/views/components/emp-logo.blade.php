@props(['logo', 'w' => 99])

<img 
    src="{{ asset('storage/' . $logo) }}"
        class="rounded-xl object-cover"
            style="width: {{ $w }}px; height: {{ $w }}px;"
                width="{{ $w }}" 
                    height="{{ $w }}"
                    >
                    