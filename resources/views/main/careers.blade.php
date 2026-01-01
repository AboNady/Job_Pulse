<x-layout>
    {{-- Ambient Background Glow --}}
    <div class="fixed top-20 right-0 -translate-y-1/2 translate-x-1/2 w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[120px] -z-10 pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-6 py-16 space-y-16">

        {{-- Hero Section --}}
        <section class="text-center max-w-3xl mx-auto space-y-6">
            <h1 class="text-5xl md:text-6xl font-bold text-white tracking-tight">
                Join the <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Job Pulse</span> Team
            </h1>
            <p class="text-xl text-slate-400 leading-relaxed">
                We are shaping the future of recruitment. If you are passionate about connecting people with their dream careers, we want to hear from you.
            </p>
        </section>

        {{-- Jobs List --}}
        <section class="space-y-6">
            <div class="flex items-center justify-between px-2">
                <h2 class="text-2xl font-bold text-white">Open Roles</h2>
                <span class="px-3 py-1 rounded-full bg-slate-800 border border-slate-700 text-xs text-slate-400">2 positions available</span>
            </div>

            {{-- Job Card 1 --}}
            <a href="{{ route('index') }}" target="_blank" class="group relative block">
                {{-- Hover Glow Effect --}}
                <div class="absolute inset-0 bg-blue-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>
                
                <div class="relative flex flex-col md:flex-row items-center gap-6 p-6 bg-slate-900/60 backdrop-blur-md border border-slate-700/50 rounded-2xl transition-all duration-300 group-hover:border-blue-500/50 group-hover:shadow-lg group-hover:-translate-y-1">
                    
                    {{-- Logo --}}
                    <div class="flex-shrink-0 w-16 h-16 bg-slate-800 rounded-xl border border-slate-700/50 overflow-hidden flex items-center justify-center group-hover:border-blue-500/30 transition-colors">
                        <img src="https://picsum.photos/seed/pixelpositions/100/100" alt="Pixel Positions Logo" class="w-full h-full object-cover">
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0 text-center md:text-left">
                        <h3 class="text-xl font-bold text-white group-hover:text-blue-400 transition-colors">Frontend Developer</h3>
                        
                        <div class="flex flex-wrap justify-center md:justify-start gap-y-2 gap-x-4 mt-2 text-sm text-slate-400">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                Engineering
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Remote
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Full-time
                            </span>
                        </div>
                    </div>

                    {{-- Tags & Salary --}}
                    <div class="flex flex-col items-center md:items-end gap-4 min-w-[140px]">
                        <div class="flex gap-2">
                            @foreach (['Vue.js', 'Tailwind'] as $tag)
                                <span class="px-2.5 py-0.5 rounded-md bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-medium">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-emerald-400 font-semibold bg-emerald-400/10 px-3 py-1 rounded-lg text-sm border border-emerald-400/20 shadow-sm shadow-emerald-900/20">
                                $55k - $75k
                            </span>
                            
                            {{-- Arrow Icon --}}
                            <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-blue-600 transition-colors duration-300">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Job Card 1 --}}
            <a href="{{ route('index') }}" target="_blank" class="group relative block">
                {{-- Hover Glow Effect --}}
                <div class="absolute inset-0 bg-blue-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>
                
                <div class="relative flex flex-col md:flex-row items-center gap-6 p-6 bg-slate-900/60 backdrop-blur-md border border-slate-700/50 rounded-2xl transition-all duration-300 group-hover:border-blue-500/50 group-hover:shadow-lg group-hover:-translate-y-1">
                    
                    {{-- Logo --}}
                    <div class="flex-shrink-0 w-16 h-16 bg-slate-800 rounded-xl border border-slate-700/50 overflow-hidden flex items-center justify-center group-hover:border-blue-500/30 transition-colors">
                        <img src="https://picsum.photos/seed/25/100/100" alt="Pixel Positions Logo" class="w-full h-full object-cover">
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0 text-center md:text-left">
                        <h3 class="text-xl font-bold text-white group-hover:text-blue-400 transition-colors">Backend Developer</h3>
                        
                        <div class="flex flex-wrap justify-center md:justify-start gap-y-2 gap-x-4 mt-2 text-sm text-slate-400">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                Engineering
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Remote
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Part-time
                            </span>
                        </div>
                    </div>

                    {{-- Tags & Salary --}}
                    <div class="flex flex-col items-center md:items-end gap-4 min-w-[140px]">
                        <div class="flex gap-2">
                            @foreach (['NodeJS', 'PHP'] as $tag)
                                <span class="px-2.5 py-0.5 rounded-md bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-medium">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-emerald-400 font-semibold bg-emerald-400/10 px-3 py-1 rounded-lg text-sm border border-emerald-400/20 shadow-sm shadow-emerald-900/20">
                                $90K
                            </span>
                            
                            {{-- Arrow Icon --}}
                            <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-blue-600 transition-colors duration-300">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>


        </section>

        {{-- CTA Section --}}
        <section class="relative overflow-hidden rounded-3xl p-12 text-center border border-slate-700/50 bg-gradient-to-b from-slate-800/40 to-slate-900/40 backdrop-blur-sm">
            {{-- Decorative elements --}}
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-blue-500/10 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-cyan-500/10 rounded-full blur-2xl"></div>

            <div class="relative z-10 max-w-2xl mx-auto space-y-6">
                <div class="inline-flex p-3 rounded-xl bg-slate-800/50 border border-slate-700/50 mb-2">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                
                <h2 class="text-3xl font-bold text-white tracking-tight">
                    Don't see the perfect role?
                </h2>
                
                <p class="text-slate-400 text-lg">
                    We are always on the lookout for exceptional talent. Send us your CV and let us know what you're interested in.
                </p>

                <div class="pt-4">
                    <a href="mailto:jobs@JobPulse.com"
                       class="inline-block px-8 py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 
                              text-white font-semibold rounded-xl shadow-lg hover:shadow-blue-500/25
                              transition-all duration-200 active:scale-95">
                        Send Open Application
                    </a>
                </div>
            </div>
        </section>

    </div>
</x-layout>