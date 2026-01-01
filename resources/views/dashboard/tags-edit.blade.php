<x-layout>
  <div class="max-w-5xl mx-auto px-6 py-12">

    {{-- Header --}}
    <div class="mb-12">
      <h1 class="text-5xl font-bold text-white mb-2 tracking-tight">Edit Tag</h1>
      <p class="text-slate-400 text-lg">Update the tag details below</p>
    </div>

    {{-- Edit Tag Form --}}
    <form method="POST" action="{{ route('tags.update', $tag) }}"
          class="space-y-8 bg-gradient-to-br from-slate-800/40 to-slate-900/40 backdrop-blur-sm p-8 rounded-2xl border border-slate-700/50 shadow-xl">
      @csrf
      @method('PATCH')

      {{-- Tag Information Section --}}
      <div>
        <h2 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
          Tag Details
        </h2>

        <x-forms.field label="Tag Name" name="name">
          <input type="text" name="name" id="name"
                 placeholder="e.g., Laravel, React, Python, Remote..."
                 class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl 
                        text-slate-100 placeholder-slate-500 text-sm
                        focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                        hover:border-slate-600 transition-colors duration-200"
                 value="{{ old('name', $tag->name) }}" required>
        </x-forms.field>
      </div>

      <x-forms.divider />

      {{-- Submit Button --}}
      <div class="flex items-center justify-between pt-4">
        <a href="{{ route('tags.index') }}"
           class="px-6 py-3 text-slate-300 font-semibold rounded-xl
                  hover:text-white hover:bg-slate-700/50 transition-all duration-200 cursor-pointer">
          Cancel
        </a>
        <button type="submit"
                class="px-8 py-3 bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 
                       text-white font-semibold rounded-xl shadow-lg hover:shadow-xl
                       transition-all duration-200 ease-out active:scale-95
                       focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:ring-offset-2 focus:ring-offset-slate-900 cursor-pointer">
          Update Tag
        </button>
      </div>

    </form>

  </div>
</x-layout>