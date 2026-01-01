<x-layout>

    <div class="space-y-16">
        
        {{-- Hero Section --}}
        <section class="relative mt-12 mb-4">
            {{-- Background Gradient --}}
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-transparent to-cyan-600/10 rounded-3xl blur-3xl -z-10"></div>

            <div class="text-center space-y-8 py-12">
                {{-- Heading --}}
                <div class="space-y-4">
                    <h1 class="text-6xl font-bold text-white tracking-tight">
                        Find Your Dream Job
                    </h1>
                    <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                        Discover incredible opportunities at amazing companies. Start your journey today.
                    </p>
                </div>

                {{-- Search Bar --}}
                <form action="{{ route('search') }}" method="GET"
                      class="group max-w-3xl mx-auto flex items-center gap-2
                             px-6 py-4 bg-gradient-to-br from-slate-800/50 to-slate-900/50 
                             border border-slate-700/50 backdrop-blur-xl rounded-2xl
                             hover:border-blue-500/50 focus-within:border-blue-500/50
                             transition-all duration-300 ease-out shadow-lg">

                    {{-- Icon --}}
                    <svg class="w-6 h-6 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.7a7.5 7.5 0 006.15-3.05z"/>
                    </svg>

                    {{-- Input --}}
                    <input
                        type="text"
                        name="q"
                        placeholder="Search jobs by title, company, or location..."
                        class="flex-1 bg-transparent text-slate-100 placeholder-slate-500 text-sm
                            focus:outline-none"
                    >

                    {{-- Button --}}
                    <button type="submit"
                            class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600
                                text-white font-semibold rounded-lg text-sm shadow-lg
                                transition-all duration-300 active:scale-95 flex-shrink-0">
                        Search
                    </button>
                </form>

                {{-- Quick Stats --}}
                <div class="grid grid-cols-3 gap-6 max-w-2xl mx-auto pt-4">
                    <div class="text-center">
                        {{-- FIX 1: Combine both counts for the Total --}}
                        <p class="text-2xl font-bold text-blue-400">{{$totalJobsCount}}</p>
                        <p class="text-sm text-slate-400">Active Jobs</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-cyan-400">{{ count($tags) }}</p>
                        <p class="text-sm text-slate-400">Categories</p>
                    </div>
                    <div class="text-center">
                        {{-- FIX 2: Use the direct collection count --}}
                        <p class="text-2xl font-bold text-emerald-400">{{ $featuredJobs->count() }}</p>
                        <p class="text-sm text-slate-400">Featured</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Featured Jobs Section --}}
        {{-- FIX 3: Check $featuredJobs variable --}}
        @if($featuredJobs->count() > 0)
            <section>
                <div class="flex items-center justify-between mb-2">
                    <x-section-heading>⭐ Featured Opportunities</x-section-heading>
                    <a href="{{ route('index') }}?filter=featured" class="text-blue-400 hover:text-blue-300 text-sm font-semibold transition">
                        View All →
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                    @foreach ($featuredJobs as $job)
                        <x-job-card :job="$job"/>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Tags Section --}}
        <section>
            <div class="mb-8">
                <x-section-heading>Browse by Category</x-section-heading>
                <p class="text-slate-400 text-sm mt-2">Find jobs in your area of interest</p>
            </div>
            <div class="flex flex-wrap gap-3">
                @foreach ($tags as $tag)
                    <x-tag :tag="$tag->name" size="lg" />            
                @endforeach
            </div>
        </section>

        {{-- All Jobs Section --}}
        <section>
            <div class="flex items-center justify-between mb-8">
                <div>
                    <x-section-heading>Latest Jobs</x-section-heading>
                    <p class="text-slate-400 text-sm mt-2">Explore all available positions</p>
                </div>
                <a href="{{ route('index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-semibold transition">
                    View All →
                </a>
            </div>
            
            <div class="space-y-4">
                @foreach ($jobs as $job)
                    <x-job-card-wide :job="$job" :tags="$job->tags->pluck('name')" />
                @endforeach
            </div>

            {{-- FIX 4: Add Pagination Links --}}
            <div class="mt-8">
                {{ $jobs->links() }}
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="bg-gradient-to-r from-blue-600/10 to-cyan-600/10 border border-slate-700/50 rounded-3xl p-12 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to Transform Your Career?</h2>
            <p class="text-slate-400 mb-8 max-w-2xl mx-auto">
                Join thousands of professionals finding their perfect job match. Sign up today to unlock exclusive opportunities and connect with top employers.
            </p>
            <a href="{{ route('register') }}" 
               class="inline-block px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-lg shadow-lg transition-colors duration-300">
                Get Started Free
            </a>
        </section>

    </div>
</x-layout>
