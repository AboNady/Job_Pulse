@props(['job', 'variant' => 'primary'])

@php
    // Same variant definitions you already use
    $variants = [
        'primary' => [
            'gradient'     => 'bg-gradient-to-br from-blue-900/10 via-blue-900/5 to-purple-900/10',
            'hover'        => 'hover:bg-gradient-to-br hover:from-blue-900/20 hover:to-purple-900/20',
            'border'       => 'border border-blue-500/20',
            'hoverBorder'  => 'hover:border-blue-400/40',
            'accent'       => 'text-blue-400',
            'hoverAccent'  => 'group-hover:text-blue-300',
            'title'        => 'text-white',
            'hoverTitle'   => 'group-hover:text-blue-200',
        ],
        'secondary' => [
            'gradient'     => 'bg-gradient-to-br from-slate-900/20 via-slate-900/10 to-slate-900/20',
            'hover'        => 'hover:bg-gradient-to-br hover:from-slate-900/30 hover:to-slate-900/30',
            'border'       => 'border border-slate-700/40',
            'hoverBorder'  => 'hover:border-slate-600/60',
            'accent'       => 'text-emerald-400',
            'hoverAccent'  => 'group-hover:text-emerald-300',
            'title'        => 'text-white',
            'hoverTitle'   => 'group-hover:text-slate-200',
        ],
    ];

    $selected = $variants[$variant] ?? $variants['primary'];
    $isUrgent = $job->closing_date->isFuture() 
            && now()->diffInDays($job->closing_date, false) <= 5;
@endphp

<article class="group w-full p-6 rounded-2xl {{ $selected['gradient'] }} {{ $selected['border'] }}
                 transition-all duration-300 hover:shadow-xl {{ $selected['hover'] }} {{ $selected['hoverBorder'] }}">

    <div class="flex flex-col lg:flex-row gap-8">

        {{-- LEFT COLUMN --}}
        <div class="flex-shrink-0 flex flex-col w-full lg:w-72 gap-6">
            
            <a href="{{ route('job.show', $job) }}" class="group block">
                
                {{-- 
                    Layout Strategy:
                    Mobile: Flex Row (Side-by-side) for better density.
                    Desktop: Flex Column (Stacked) for a strong sidebar look.
                --}}
                <div class="flex flex-row lg:flex-col items-center lg:items-start gap-4 lg:gap-6">

                    {{-- Logo Box --}}
                    <div class="flex-shrink-0 relative">
                        <div class="">
                            <x-emp-logo :logo="$job->logo" w=130 />
                        </div>
                        
                    </div>

                    {{-- Text Info --}}
                    <div class="flex-1 min-w-0 text-left">
                        
                        {{-- Employer Name --}}
                        <h3 class="text-lg lg:text-xl font-medium text-white group-hover:text-blue-400 transition-colors truncate">
                            {{ $job->employer->name }}
                        </h3>

                        {{-- Meta Line --}}
                        <div class="flex flex-wrap items-center gap-2 mt-1.5 text-xs lg:text-sm text-slate-400 font-medium">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ $job->type }}
                            </span>
                            <span class="text-slate-600">•</span>
                            <span class="flex items-center gap-1 truncate">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $job->location }}
                            </span>
                        </div>

                        {{-- Badges (Moved inside the flex container for mobile alignment) --}}
                        <div class="flex gap-2 mt-3">
                            @if($job->is_featured)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[14px] font-thin bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    Featured
                                </span>
                            @endif

                            @if($isUrgent ?? false)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[14px] font-thin bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                    Urgent
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </a>

            {{-- Tags --}}
            @if($job->tags->count())
                <div class="pt-4 lg:pt-0 border-t border-slate-800 lg:border-0">
                    <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3 hidden lg:block">
                        Technologies
                    </h4>

                    @foreach ($job->tags->take(3) as $tag)
                        <x-tag :tag="$tag" size="sm" variant="{{ $variant }}" :glow="$job->is_featured" />
                    @endforeach

                    @if($job->tags->count() > 3)
                        <span class="self-center px-2 text-s text-slate-500">
                            +{{ $job->tags->count() - 3 }}
                        </span>
                    @endif
                </div>
            @endif
        </div>

    <a href="{{ route("job.show",$job) }}">

        {{-- RIGHT COLUMN --}}
        <div class="flex-1 flex flex-col justify-between">

            {{-- Title --}}
            <h2 class="text-2xl font-medium mb-3 {{ $selected['title'] }} {{ $selected['hoverTitle'] }} transition">
                {{ $job->title }}
            </h2>

            {{-- Full Description --}}
            <p class="text-slate-300/90 leading-relaxed mb-6">
                {!! nl2br(e(Str::limit(strip_tags($job->description), 1010))) !!}
            </p>

            {{-- Footer --}}
            <div class="flex items-center justify-between pt-4 border-t border-slate-700/40">

                <div>
                    <p class="text-lg font-thin text-emerald-400">
                        {{ $job->salary }}
                    </p>
                    <p class="text-xs text-slate-500 mt-1">
                        Posted: {{ $job->posted_date->format('M d, Y') }} <br>
                        Closes: {{ $job->closing_date->format('M d, Y') }}
                    </p>
                </div>

                <a href="{{ route('job.show', $job) }}"
                   class="flex items-center gap-2 text-lg font-semibold {{ $selected['accent'] }} 
                          {{ $selected['hoverAccent'] }} transition">
                    Apply Now
                    <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

        </div>
    </a>
    </div>
</article>
