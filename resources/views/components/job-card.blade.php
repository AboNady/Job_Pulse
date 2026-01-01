{{-- resources/views/components/job-card.blade.php --}}
@props(['job', 'variant' => 'primary', 'size' => 'base'])

@php
    // Color variants for coordinated system
    $variants = [
        'primary' => [
            'gradient' => 'bg-gradient-to-br from-blue-900/10 via-blue-900/5 to-purple-900/10',
            'hover' => 'hover:bg-gradient-to-br hover:from-blue-900/20 hover:to-purple-900/20',
            'border' => 'border border-blue-500/20',
            'hoverBorder' => 'hover:border-blue-400/40',
            'accent' => 'text-blue-400',
            'hoverAccent' => 'group-hover:text-blue-300',
            'title' => 'text-white',
            'hoverTitle' => 'group-hover:text-blue-200',
        ],
        'secondary' => [
            'gradient' => 'bg-gradient-to-br from-slate-900/20 via-slate-900/10 to-slate-900/20',
            'hover' => 'hover:bg-gradient-to-br hover:from-slate-900/30 hover:to-slate-900/30',
            'border' => 'border border-slate-700/40',
            'hoverBorder' => 'hover:border-slate-600/60',
            'accent' => 'text-emerald-400',
            'hoverAccent' => 'group-hover:text-emerald-300',
            'title' => 'text-white',
            'hoverTitle' => 'group-hover:text-slate-200',
        ],
    ];

    $selected = $variants[$variant] ?? $variants['primary'];
    $isUrgent = $job->closing_date->isFuture() 
            && now()->diffInDays($job->closing_date, false) <= 5;
@endphp
<article class="group relative w-full">

    {{-- OUTER BORDER + GLOW + GLASS --}}
    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm
                hover:border-blue-400/40 hover:shadow-[0_0_20px_rgba(56,189,248,0.25)]
                transition-all duration-300 p-[1px]">

        {{-- INNER CONTENT BOX --}}
        <div class="rounded-2xl p-5 bg-slate-900/40 border border-slate-800/40">

            <a href="{{ route("job.show",$job) }}">
                {{-- Header Row: Logo, Employer, Featured --}}
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3 flex-1 min-w-0">

                        {{-- Logo --}}
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-slate-900/50 border border-slate-700/40
                                    flex items-center justify-center overflow-hidden shadow-inner">
                            <x-emp-logo :logo="$job->logo" w="76" />
                        </div>

                        {{-- Employer & Status --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <h3 class="text-xl font-thin {{ $selected['accent'] }} truncate">
                                    {{ $job->employer->name }}
                                </h3>
                                
                                @if($job->is_featured)
                                <span class="flex-shrink-0 px-2 py-0.5 rounded-md text-[10px] font-thin uppercase
                                            bg-gradient-to-r from-amber-500/10 to-amber-600/10 
                                            text-amber-400 border border-amber-500/20">
                                    ⭐ Featured
                                </span>
                                @endif
                                
                                @if($isUrgent)
                                <span class="flex-shrink-0 px-2 py-0.5 rounded-md text-[10px] font-thin uppercase
                                            bg-gradient-to-r from-rose-500/10 to-rose-600/10 
                                            text-rose-400 border border-rose-500/20">
                                    Urgent
                                </span>
                                @endif
                            </div>

                            {{-- Job Type & Location --}}
                            <div class="flex items-center gap-3 mt-1">
                                <span class="text-xs text-slate-400">{{ $job->location }}</span>
                                <span class="text-xs text-slate-600">•</span>
                                <span class="text-xs text-slate-400">{{ $job->type }}</span>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Job Title --}}
                <h2 class="text-xl font-thin {{ $selected['title'] }} {{ $selected['hoverTitle'] }} 
                           transition-colors duration-200 mb-3 line-clamp-2 leading-snug">
                    {{ $job->title }}
                </h2>
            </a>

            {{-- Tags --}}
            @if($job->tags->count())
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach ($job->tags->take(3) as $tag)
                    <x-tag :tag="$tag" size="sm" variant="{{ $variant }}" :glow="$job->is_featured" />
                @endforeach

                @if($job->tags->count() > 3)
                <span class="self-center px-2 text-xs text-slate-500">
                    +{{ $job->tags->count() - 3 }}
                </span>
                @endif
            </div>
            @endif

            {{-- Footer --}}
            <div class="flex items-center justify-between pt-4 border-t border-slate-700/40">
                <div class="space-y-1">
                    <span class="block text-base font-thin text-emerald-400">{{ $job->salary }}</span>

                    @if($job->closing_date)
                    <span class="text-xs text-slate-300 font-thin">
                        Closes {{ $job->closing_date->format('M d') }}
                    </span>
                    @endif
                </div>

                <a href="{{ route("job.show",$job) }}">
                    <span class="flex items-center gap-1 text-lg font-semibold {{ $selected['accent'] }} 
                               {{ $selected['hoverAccent'] }} transition-colors duration-200">
                        Apply
                        <svg class="w-4 h-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </span>
                </a>
            </div>

        </div> {{-- inner content --}}
    </div> {{-- border wrapper --}}
</article>
