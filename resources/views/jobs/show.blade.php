<x-layout>

    {{-- Ambient Background Glow --}}
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[1400px] h-[900px] 
                bg-blue-600/10 rounded-full blur-[160px] -z-10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 py-12 space-y-10">

        {{-- Back Navigation --}}
        <div>
            <a href="{{ route('index') }}" 
               class="inline-flex items-center gap-2 text-slate-400 hover:text-white 
                      transition text-sm font-medium group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Jobs
            </a>
        </div>

        {{-- Header Section --}}
        <div class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-700/40 
                    rounded-3xl p-10 overflow-hidden shadow-lg">

            {{-- Featured Glow --}}
            @if($job->is_featured)
            <div class="absolute -top-28 -right-28 w-64 h-64 bg-yellow-500/10 
                        rounded-full blur-[120px]"></div>
            @endif

            <div class="relative flex flex-col md:flex-row items-start md:items-center gap-8 z-10">
                
                {{-- Logo --}}
                <div class="w-28 h-28 flex-shrink-0 rounded-2xl bg-slate-800/50 
                            border border-slate-700/50 p-1 shadow-xl">
                    <img src="{{ Str::startsWith($job->logo, 'http') ? $job->logo : asset('storage/'.$job->logo) }}" 
                         alt="{{ $job->employer->name }}" 
                         class="w-full h-full object-cover rounded-xl">
                </div>

                {{-- Title & Employer --}}
                <div class="flex-1 space-y-3">
                    <h1 class="text-3xl md:text-4xl font-bold text-white tracking-tight leading-snug">
                        {{ $job->title }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-4 text-slate-400 text-sm md:text-base">

                        {{-- Employer --}}
                            <a href="{{ route('companies.show', $job->employer->id) }}"
                               class="font-medium text-blue-400 hover:text-blue-300 transition">
                                {{ $job->employer->name }}
                            </a>

                        <span class="text-slate-600">•</span>

                        {{-- Location --}}
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            {{ $job->location }}
                        </span>

                        <span class="text-slate-600">•</span>

                        {{-- Posted Date --}}
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Posted - {{ $job->posted_date->format('M d, Y') }}
                        </span>

                        {{-- Featured Badge --}}
                        @if($job->is_featured)
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full 
                                     bg-yellow-600/10 text-yellow-400 border border-yellow-500/20 
                                     text-xs uppercase font-semibold tracking-wide">
                            ⭐ Featured
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- LEFT: Description & Tags --}}
            <div class="lg:col-span-2 space-y-10">

                {{-- Description --}}
                <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-700/40 
                            rounded-3xl p-8 shadow-lg">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        Job Description
                    </h2>
                    <div class="prose prose-invert prose-slate max-w-none leading-relaxed">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>

                {{-- Tags --}}
                @if($job->tags->count())
                <div class="bg-slate-900/40 backdrop-blur-xl border border-slate-700/40 
                            rounded-3xl p-8 shadow-lg">
                    <h2 class="text-xl font-bold text-white mb-6">Skills & Tags</h2>

                    <div class="flex flex-wrap gap-2">
                        @foreach($job->tags as $tag)
                        <x-tag :tag="$tag" size="base" />
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- RIGHT: Sticky Sidebar --}}
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700/50 
                            rounded-3xl p-8 shadow-xl sticky top-6 space-y-8">

                    {{-- Salary --}}
                    <div class="bg-slate-800/50 rounded-2xl p-5 border border-slate-700/50 flex justify-between">
                        <span class="text-slate-400 text-sm">Salary</span>
                        <span class="text-emerald-400 font-bold font-mono">{{ $job->salary }}</span>
                    </div>

                    {{-- Apply Button --}}
                    <a href="{{ $job->url }}" target="_blank"
                       class="block text-center px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 
                              hover:from-blue-500 hover:to-blue-600 text-white font-bold rounded-xl 
                              shadow-lg hover:shadow-blue-600/20 transition active:scale-95">
                        Apply Now ↗
                    </a>

                    <div class="h-px bg-slate-700/50"></div>

                    {{-- Job Overview --}}
                    <div class="space-y-6">
                        <h3 class="text-white font-semibold text-sm uppercase tracking-wider opacity-80">
                            Job Overview
                        </h3>

                        {{-- Type --}}
                        <x-job-overview-item 
                            icon="briefcase" 
                            label="Job Type" 
                            :value="$job->type" />

                        {{-- Closing --}}
                        <x-job-overview-item 
                            icon="calendar" 
                            label="Closing Date" 
                            :value="$job->closing_date->format('M d, Y')" 
                        />

                        {{-- Employer --}}
                        <x-job-overview-item 
                            icon="office" 
                            label="Company" 
                            :value="$job->employer->name" />
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-layout>
