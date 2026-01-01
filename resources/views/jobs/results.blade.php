<x-layout>
  <div class="space-y-12 mx-auto px-6 sm:px-10 lg:px-0 max-w-7xl">

    {{-- Header --}}
    <section class="text-center mt-12 mb-8">
      <h1 class="text-4xl sm:text-5xl font-normal text-white tracking-tight">
        Search Results for “{{ $q }}”
      </h1>
      <p class="mt-2 text-sm text-slate-400">Find roles, companies and tags that match your search.</p>
    </section>

    {{-- Search bar (theme-aligned) --}}
    <form action="{{ route('search') }}" method="GET"
          class="group mx-auto max-w-2xl flex items-center gap-3 px-4 py-3
                 bg-slate-800/40 border border-slate-700/50 rounded-2xl backdrop-blur-sm
                 hover:scale-[1.02] transition-transform duration-200 ease-out">

      <div class="flex items-center justify-center pl-1">
        <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-200 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.7a7.5 7.5 0 006.15-3.05z"/>
        </svg>
      </div>

      <input type="text" name="q" value="{{ $q ?? '' }}"
             placeholder="Search for jobs, companies, or tags..."
             aria-label="Search jobs"
             class="flex-1 bg-transparent text-slate-100 placeholder-slate-500 text-sm
                    px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500/30
                    focus:border-blue-500 rounded-md" />

      <button type="submit"
              class="inline-flex items-center gap-2 bg-gradient-to-br from-blue-600 to-blue-700
                     hover:from-blue-500 hover:to-blue-600 text-white font-medium px-4 py-2 rounded-lg
                     text-sm shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400/40">
        Search
      </button>
    </form>

    <x-section-heading class="mt-10">
      You have <span class="text-blue-400 font-thin">{{ $jobs->count() }}</span>
      result{{ $jobs->count() == 1 ? '' : 's' }}.
    </x-section-heading>

    {{-- Results grid: use single column for wide cards (stack on mobile) --}}
    <div class="space-y-8">
      @forelse ($jobs as $job)
        <x-job-card-wide :job="$job" variant="primary" />
      @empty
        <p class="text-slate-400 text-center mt-8">
          No jobs found matching your query.
        </p>
      @endforelse
    </div>

    {{-- optional pagination --}}
    @if(method_exists($jobs, 'links'))
      <div class="mt-6">
        {{ $jobs->withQueryString()->links() }}
      </div>
    @endif

  </div>
</x-layout>
