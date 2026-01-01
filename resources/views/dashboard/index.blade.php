<x-layout>

  <div class="max-w-6xl mx-auto px-6 py-12 space-y-12">

    {{-- Header --}}
    <div class="mb-12">
      <h1 class="text-5xl font-bold text-white mb-2 tracking-tight">Dashboard</h1>
      <p class="text-slate-400 text-lg">Manage your jobs, company, and account settings</p>
    </div>

    {{-- Dashboard Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

      {{-- Manage Jobs Card --}}
      <a href="{{ route('jobs.manage') }}"
         class="group relative overflow-hidden p-6 bg-gradient-to-br from-slate-800/40 to-slate-900/40 border border-slate-700/50 rounded-xl
                hover:border-blue-500/50 hover:from-slate-800/60 hover:to-slate-900/60
                transition-all duration-300 shadow-lg hover:shadow-xl">

        {{-- Accent Line --}}
        <div class="absolute top-0 left-0 h-1 w-0 bg-gradient-to-r from-blue-500 to-cyan-400 
                    group-hover:w-full transition-all duration-300"></div>

        <div class="flex items-start gap-4">
          {{-- Icon Container --}}
          <div class="p-3 bg-blue-500/20 rounded-lg group-hover:bg-blue-500/30 transition">
            <svg class="w-8 h-8 text-blue-400 group-hover:text-blue-300 transition"
                 fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
          </div>

          <div class="flex-1">
            <h2 class="text-lg font-semibold text-white group-hover:text-blue-300 transition">
              Manage Jobs
            </h2>
            <p class="text-slate-400 text-sm mt-1">Create, edit, and delete job listings.</p>
          </div>

          {{-- Arrow --}}
          <div class="opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0">
            <svg class="w-5 h-5 text-blue-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </div>
        </div>
      </a>

      {{-- Manage Company Card --}}
      <a href="{{ route('companies.show', Auth::user()->employer->id ?? 0) }}"
         class="group relative overflow-hidden p-6 bg-gradient-to-br from-slate-800/40 to-slate-900/40 border border-slate-700/50 rounded-xl
                hover:border-emerald-500/50 hover:from-slate-800/60 hover:to-slate-900/60
                transition-all duration-300 shadow-lg hover:shadow-xl">

        {{-- Accent Line --}}
        <div class="absolute top-0 left-0 h-1 w-0 bg-gradient-to-r from-emerald-500 to-teal-400 
                    group-hover:w-full transition-all duration-300"></div>

        <div class="flex items-start gap-4">
          {{-- Icon Container --}}
          <div class="p-3 bg-emerald-500/20 rounded-lg group-hover:bg-emerald-500/30 transition">
            <svg class="w-8 h-8 text-emerald-400 group-hover:text-emerald-300 transition"
                 fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
            </svg>
          </div>

          <div class="flex-1">
            <h2 class="text-lg font-semibold text-white group-hover:text-emerald-300 transition">
              Company Profile
            </h2>
            <p class="text-slate-400 text-sm mt-1">Update company information and logo.</p>
          </div>

          {{-- Arrow --}}
          <div class="opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0">
            <svg class="w-5 h-5 text-emerald-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </div>
        </div>
      </a>

      {{-- Manage Tags Card --}}
      <a href="{{ route('tags.index') }}"
         class="group relative overflow-hidden p-6 bg-gradient-to-br from-slate-800/40 to-slate-900/40 border border-slate-700/50 rounded-xl
                hover:border-amber-500/50 hover:from-slate-800/60 hover:to-slate-900/60
                transition-all duration-300 shadow-lg hover:shadow-xl">

        {{-- Accent Line --}}
        <div class="absolute top-0 left-0 h-1 w-0 bg-gradient-to-r from-amber-500 to-orange-400 
                    group-hover:w-full transition-all duration-300"></div>

        <div class="flex items-start gap-4">
          {{-- Icon Container --}}
          <div class="p-3 bg-amber-500/20 rounded-lg group-hover:bg-amber-500/30 transition">
            <svg class="w-8 h-8 text-amber-400 group-hover:text-amber-300 transition"
                 fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
          </div>

          <div class="flex-1">
            <h2 class="text-lg font-semibold text-white group-hover:text-amber-300 transition">
              Manage Tags
            </h2>
            <p class="text-slate-400 text-sm mt-1">Create and organize job categories.</p>
          </div>

          {{-- Arrow --}}
          <div class="opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0">
            <svg class="w-5 h-5 text-amber-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </div>
        </div>
      </a>

      {{-- User Settings Card --}}
      <a href="{{ route('user.settings') }}"
         class="group relative overflow-hidden p-6 bg-gradient-to-br from-slate-800/40 to-slate-900/40 border border-slate-700/50 rounded-xl
                hover:border-violet-500/50 hover:from-slate-800/60 hover:to-slate-900/60
                transition-all duration-300 shadow-lg hover:shadow-xl">

        {{-- Accent Line --}}
        <div class="absolute top-0 left-0 h-1 w-0 bg-gradient-to-r from-violet-500 to-purple-400 
                    group-hover:w-full transition-all duration-300"></div>

        <div class="flex items-start gap-4">
          {{-- Icon Container --}}
          <div class="p-3 bg-violet-500/20 rounded-lg group-hover:bg-violet-500/30 transition">
            <svg class="w-8 h-8 text-violet-400 group-hover:text-violet-300 transition"
                 fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>

          <div class="flex-1">
            <h2 class="text-lg font-semibold text-white group-hover:text-violet-300 transition">
              Account Settings
            </h2>
            <p class="text-slate-400 text-sm mt-1">Manage password and profile preferences.</p>
          </div>

          {{-- Arrow --}}
          <div class="opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0">
            <svg class="w-5 h-5 text-violet-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </div>
        </div>
      </a>

    </div>

  </div>

</x-layout>