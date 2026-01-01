<x-layout>
  <div class="max-w-5xl mx-auto px-6 py-12 space-y-12" x-data="{ showDelete: false, deleteUrl: '', deleteTagName: '' }">

    {{-- Header --}}
    <div class="mb-12">
      <h1 class="text-5xl font-bold text-white mb-2 tracking-tight">Tags Management</h1>
      <p class="text-slate-400 text-lg">Create, edit, and manage job category tags</p>
    </div>

    {{-- Create New Tag Section --}}
    <section>

      <form method="POST" action="{{ route('tags.store') }}"
            class="bg-gradient-to-br from-slate-800/40 to-slate-900/40 backdrop-blur-sm p-8 rounded-2xl border border-slate-700/50 shadow-xl">
        @csrf

        <x-forms.field label="Tag Name" name="name">
          <input type="text" name="name" id="name"
                 placeholder="e.g., Laravel, React, Python, Remote..."
                 class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl 
                        text-slate-100 placeholder-slate-500 text-sm
                        focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                        hover:border-slate-600 transition-colors duration-200"
                 required>
        </x-forms.field>

        <div class="mt-8">
          <button type="submit"
                  class="px-8 py-3 bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 
                         text-white font-semibold rounded-xl shadow-lg hover:shadow-xl cursor-pointer
                         transition-all duration-200 ease-out active:scale-95
                         focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:ring-offset-2 focus:ring-offset-slate-900">
            Create Tag
          </button>
        </div>
      </form>
    </section>

    {{-- Existing Tags Section --}}
    <section>
      <div class="mb-8">
        <h2 class="text-2xl font-bold text-white">Existing Tags ({{ $tags->total() }})</h2>
        <p class="text-slate-400 text-sm mt-2">Manage your tag library</p>
      </div>

      @if($tags->isEmpty())
        <div class="bg-gradient-to-br from-slate-800/30 to-slate-900/30 border border-slate-700/50 rounded-2xl p-12 text-center">
          <svg class="w-12 h-12 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
          </svg>
          <p class="text-slate-400 text-lg">No tags created yet</p>
          <p class="text-slate-500 text-sm mt-2">Create your first tag to get started</p>
        </div>
      @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          @foreach($tags as $tag)
            <div class="group flex items-center justify-between p-4 bg-gradient-to-br from-slate-800/40 to-slate-900/40 border border-slate-700/50 rounded-lg
                        hover:border-blue-500/50 hover:from-slate-800/60 hover:to-slate-900/60 transition-all duration-200">
              
              <div class="flex-1 min-w-0">
                <p class="text-white font-semibold text-sm truncate">{{ $tag->name }}</p>
                <p class="text-slate-500 text-xs mt-1">Tag ID: #{{ $tag->id }}</p>
              </div>

              <div class="flex gap-2 flex-shrink-0 ml-4">
                {{-- Edit Button --}}
                <a href="{{ route('tags.edit', $tag) }}"
                   class="p-2 rounded-lg bg-blue-500/20 hover:bg-blue-500/30 border border-slate-700/50 transition-all duration-200"
                   title="Edit Tag">
                  <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </a>

                {{-- Delete Button --}}
                <button type="button"
                        @click="showDelete = true; deleteUrl = '{{ route('tags.delete', $tag) }}'; deleteTagName = '{{ $tag->name }}'"
                        class="p-2 rounded-lg bg-red-500/20 hover:bg-red-500/30 border border-slate-700/50 transition-all duration-200"
                        title="Delete Tag">
                  <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </button>
              </div>
            </div>
          @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
          {{ $tags->links() }}
        </div>
      @endif
    </section>

    {{-- Delete Confirmation Modal --}}
    <div x-cloak x-show="showDelete"
         @keydown.escape="showDelete = false"
         class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50 p-4">

      <div class="bg-gradient-to-br from-slate-800/80 to-slate-900/80 border border-slate-700/50 p-8 rounded-2xl w-full max-w-md shadow-2xl">
        <div class="flex items-center gap-3 mb-4">
          <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2m0-14a9 9 0 110 18 9 9 0 010-18z" />
          </svg>
          <h2 class="text-xl font-bold text-white">Delete Tag</h2>
        </div>

        <p class="text-slate-300 mb-2">
          You are about to delete:
        </p>
        <p class="text-blue-400 font-semibold mb-6 text-lg">
          "<span x-text="deleteTagName"></span>"
        </p>

        <p class="text-slate-400 text-sm mb-6">
          This action cannot be undone. Any jobs associated with this tag will lose this categorization.
        </p>

        <div class="flex gap-3 justify-end">
          <button @click="showDelete = false"
                  class="px-4 py-2 rounded-lg bg-slate-700/50 hover:bg-slate-700 text-slate-300 font-semibold transition-all duration-200">
            Cancel
          </button>

          <form :action="deleteUrl" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-500 text-white font-semibold transition-all duration-200">
              Delete Tag
            </button>
          </form>
        </div>
      </div>

    </div>

  </div>
</x-layout>