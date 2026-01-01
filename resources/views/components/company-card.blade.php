{{-- resources/views/components/company-card.blade.php --}}
@props(['company'])

<a href="{{ route('companies.show', $company->id) }}" 
   class="group relative overflow-hidden flex flex-col p-6 bg-gradient-to-br from-slate-800/40 to-slate-900/40 
          border border-slate-700/50 rounded-lg shadow-lg
          hover:border-blue-500/50 hover:from-slate-800/60 hover:to-slate-900/60
          transition-all duration-300 h-full">

    {{-- Accent Line --}}
    <div class="absolute top-0 left-0 h-1 w-0 bg-gradient-to-r from-blue-500 to-cyan-400 
                group-hover:w-full transition-all duration-300"></div>

    {{-- Logo & Name Header --}}
    <div class="flex items-start gap-4 mb-5">
        {{-- Logo Container --}}
        <div class="flex-shrink-0 w-14 h-14 bg-slate-800/50 rounded-lg border border-slate-700/50 
                    flex items-center justify-center group-hover:border-blue-500/30 group-hover:bg-slate-800 transition-all overflow-hidden">
            @if($company->logo)
                <img src="{{ asset('storage/'.$company->logo) }}" 
                     alt="logo"
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center">
                    <span class="text-lg font-bold text-white group-hover:scale-110 transition-transform">
                        {{ strtoupper(substr($company->name, 0, 1)) }}
                    </span>
                </div>
            @endif
        </div>

        {{-- Name --}}
        <div class="flex-1 min-w-0">
            <h3 class="text-base font-semibold text-white group-hover:text-blue-300 transition-colors line-clamp-2">
                {{ $company->name }}
            </h3>
            <p class="text-xs text-slate-500 mt-1">Company Profile</p>
        </div>
    </div>

    {{-- Divider --}}
    <div class="h-px bg-gradient-to-r from-slate-700/50 to-transparent mb-5"></div>

    {{-- Contact Information --}}
    <div class="space-y-3 flex-1 mb-5">
        @if(!empty($company->email))
            <div class="flex items-start gap-3">
                <svg class="w-4 h-4 text-slate-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span class="text-sm text-slate-300 truncate" title="{{ $company->email }}">
                    {{ $company->email }}
                </span>
            </div>
        @endif

        @if(!empty($company->phone))
            <div class="flex items-start gap-3">
                <svg class="w-4 h-4 text-slate-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span class="text-sm text-slate-300">
                    {{ $company->phone }}
                </span>
            </div>
        @endif

        @if(!empty($company->address))
            <div class="flex items-start gap-3">
                <svg class="w-4 h-4 text-slate-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="text-sm text-slate-400 line-clamp-2">
                    {{ $company->address }}
                </span>
            </div>
        @endif
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-between pt-4 border-t border-slate-700/50">
        <span class="text-xs font-semibold text-blue-400 group-hover:text-blue-300 transition-colors">
            Edit Profile
        </span>
        
        <svg class="w-4 h-4 text-blue-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
        </svg>
    </div>

</a>