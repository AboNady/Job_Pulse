<x-layout>
    <div class="space-y-12 mx-auto px-6 sm:px-10 lg:px-0 max-w-5xl">

        {{-- Header --}}
        <section class="text-center mt-12 mb-8 relative">
            {{-- Optional: subtle glow effect behind the title --}}
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-blue-500/10 blur-[80px] rounded-full -z-10"></div>

            <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight">
                Results for tag: “<span class="font-light text-blue-400">{{ $q }}</span>”
            </h1>
        </section>

        {{-- Results count & Meta --}}
        <div class="flex items-center justify-between border-b border-white/5 pb-4">
            <x-section-heading>
                {{-- FIX 1: Use total() because count() only counts the current page --}}
                Found {{ $jobs->total() }} Jobs
            </x-section-heading>

            {{-- Optional: Show current page info --}}
            <span class="text-sm text-slate-500">
                Page {{ $jobs->currentPage() }} of {{ $jobs->lastPage() }}
            </span>
        </div>

        {{-- Results list --}}
        <div class="space-y-6">
            @forelse ($jobs as $job)
                <x-job-card-wide :job="$job" :tags="$job->tags->pluck('name')" />
            @empty
                <div class="text-center py-12 border border-dashed border-slate-700/50 rounded-xl bg-slate-900/30">
                    <p class="text-slate-400 text-lg mb-2">No jobs found for this tag yet.</p>
                    <a href="{{ route('index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium transition-colors">
                        ← Browse all jobs
                    </a>
                </div>
            @endforelse
        </div>

        {{-- FIX 2: Add Pagination Links --}}
        {{-- We check hasPages() so we don't show empty space if there's only 1 page --}}
        @if ($jobs->hasPages())
            <div class="mt-10 pt-6 border-t border-white/5">
                {{ $jobs->links() }}
            </div>
        @endif

    </div>
</x-layout>