<x-layout>

  {{-- Ambient Background Glow --}}
  <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[1000px] h-[600px] bg-blue-600/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

  {{-- 
      ALPINE INITIALIZATION 
      1. x-data: Connects to your JS component.
      2. @clear-search.window: A global listener to handle the "Clear" button from inside dynamic AJAX content.
  --}}
  <div x-data="companySearch()" 
       @clear-search.window="query = ''; performSearch()" 
       class="max-w-8xl mx-auto px-6 py-16 space-y-16">

    {{-- Hero Section --}}
    <div class="text-center space-y-6 max-w-3xl mx-auto">
      <h1 class="text-5xl md:text-6xl font-bold text-white tracking-tight leading-tight">
        Our Trusted <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Partners</span>
      </h1>
      <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto">
        Connect with industry-leading companies and discover the perfect environment for your next career move.
      </p>

      {{-- Search Bar --}}
      <div class="pt-4">
          <div class="relative max-w-2xl mx-auto group">

            {{-- Input Glow Effect --}}
            <div class="absolute inset-0 bg-blue-500/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

            <div class="relative flex items-center">
              <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-blue-400 group-focus-within:text-blue-300 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.7a7.5 7.5 0 006.15-3.05z" />
                </svg>
              </div>

              {{-- ALPINE INPUT --}}
              <input
                type="text"
                name="q"
                x-model="query"
                @input.debounce.500ms="performSearch"
                placeholder="Search companies by name or location..."
                class="w-full pl-14 pr-12 py-5 bg-slate-900/60 border border-slate-700/50 rounded-2xl 
                       text-slate-100 placeholder-slate-500 text-base shadow-xl backdrop-blur-md
                       focus:outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 focus:bg-slate-900/80
                       transition-all duration-300"
              >
              
              {{-- Loading Spinner (Controlled by Alpine) --}}
              <div x-show="isLoading" 
                   x-transition 
                   class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none"
                   style="display: none;"> {{-- inline style prevents flicker before Alpine loads --}}
                  <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
              </div>
            </div>
          </div>
      </div>
    </div>

    {{-- RESULTS CONTAINER --}}
    <div id="results-container" class="relative min-h-[400px]">
      
      @if($companies->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($companies as $company)
             {{-- Ensure you have an x-company-card component created --}}
            <x-company-card :company="$company" />
          @endforeach
        </div>

        {{-- Pagination Links --}}
        <div class="mt-12">
            {{ $companies->withQueryString()->links() }}
        </div>

      @else
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center py-24 text-center bg-gradient-to-br from-slate-800/30 to-slate-900/30 border border-slate-700/50 rounded-3xl backdrop-blur-sm">
          <div class="p-4 bg-slate-800/50 rounded-2xl mb-6 border border-slate-700/50 shadow-inner">
            <svg class="w-12 h-12 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-white mb-2">No partners found</h3>
          <p class="text-slate-400 max-w-md mx-auto">
              No companies match "<span class="text-blue-400 font-semibold">{{ request('q') }}</span>".
          </p>

          {{-- 
              CLEAR SEARCH BUTTON
              Uses a global event dispatch because this HTML is injected dynamically 
              and might not automatically bind to the parent Alpine scope.
          --}}
          <button onclick="window.dispatchEvent(new CustomEvent('clear-search'))" 
                  class="mt-8 px-6 py-2 rounded-lg bg-slate-700/50 hover:bg-slate-700 text-white text-sm font-medium transition-colors border border-slate-600/50">
            Clear Search
          </button>
        </div>
      @endif
      
    </div>

  </div>

</x-layout>