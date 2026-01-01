{{-- resources/views/dashboard/jobs.blade.php --}}
<x-layout>
  <div class="max-w-5xl mx-auto px-6 py-10 space-y-10" x-data="{ showDelete:false, deleteUrl:null }">

    {{-- Header --}}
    <div class="flex justify-between items-center">
      <div>
        <h1 class="text-3xl font-thin text-white">Your Posted Jobs</h1>
        <p class="text-gray-400 mt-1 text-sm">
          You have <span class="text-blue-400 font-thin">{{ $jobs->total() }}</span> posted jobs.
        </p>
      </div>
      <a href="{{ route('jobs.create') }}"
         class="bg-blue-600 hover:bg-blue-500 text-white font-thin px-5 py-2 rounded-xl transition">
        + Post New Job
      </a>
    </div>

    {{-- Jobs List --}}
    <div class="space-y-10">
      @foreach($jobs as $job)
        <div class="relative group pt-3">

          {{-- Vertical Edit/Delete Buttons outside the card --}}
          @can('delete', $job)
            <div class="absolute top-1/2 -translate-y-1/2 right-[-60px] flex flex-col gap-3 
                        opacity-50 group-hover:opacity-100 transition duration-200 z-50 pointer-events-auto">

              {{-- Edit --}}
              <a href="{{ route('jobs.edit', $job) }}"
                 class="p-3 rounded-xl bg-blue-500/20 hover:bg-blue-500/30 border border-white/10 transition cursor-pointer"
                 title="Edit Job">
                <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" stroke-width="1.7"
                     viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.862 3.487l3.651 3.651M4 20h4.5L19 9.5l-4.5-4.5L4 15.5V20z"/>
                </svg>
              </a>

              {{-- Delete --}}
              <button @click=" showDelete = true; deleteUrl = '{{ route('jobs.delete', $job) }}' "
                      class="p-3 rounded-xl bg-red-500/20 hover:bg-red-500/30 border border-white/10 transition cursor-pointer"
                      title="Delete Job">
                <svg class="w-5 h-5 text-red-300" fill="none" stroke="currentColor" stroke-width="1.7"
                     viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 7h12M9 7V4h6v3m-7 4v6m4-6v6m4-6v6M4 7h16l-1 13H5L4 7z"/>
                </svg>
              </button>

            </div>
          @endcan

          {{-- Job Card --}}
          <x-job-card-wide :job="$job" :tags="$job->tags" />

        </div>
      @endforeach
    </div>

    {{-- Pagination --}}
    <div class="pt-4">
      {{ $jobs->links('pagination::tailwind') }}
    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-cloak x-show="showDelete"
         class="fixed inset-0 flex items-center justify-center bg-black/70 backdrop-blur-sm z-50">

      <div class="bg-neutral-900 border border-white/20 p-8 rounded-2xl w-[380px] shadow-xl">
        <h2 class="text-xl font-thin text-white">Delete Job</h2>
        <p class="text-gray-400 mt-2">
          Are you sure you want to delete this job? <br>
          This action cannot be undone.
        </p>

        <div class="mt-6 flex justify-end gap-3">
          <button @click="showDelete = false"
                  class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white transition cursor-pointer">
            Cancel
          </button>

          <form :action="deleteUrl" method="POST">
            @csrf
            @method('DELETE')
            <button class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-500 text-white transition cursor-pointer">
              Delete
            </button>
          </form>
        </div>
      </div>

    </div>

  </div>
</x-layout>
