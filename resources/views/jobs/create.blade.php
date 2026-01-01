<x-layout>
  <div class="max-w-15xl mx-auto px-6 py-12">

    {{-- Header --}}
    <div class="mb-12">
      <h1 class="text-5xl font-bold text-white mb-2 tracking-tight">Post a New Job</h1>
      <p class="text-slate-400 text-lg">Fill in the details below to create a new job listing</p>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('jobs.store') }}" enctype="multipart/form-data"
          class="space-y-8 bg-gradient-to-br from-slate-800/40 to-slate-900/40 backdrop-blur-sm p-8 rounded-2xl border border-slate-700/50 shadow-xl">
      @csrf

      {{-- Job Title --}}
      <x-forms.input 
        label="Job Title" 
        name="title"
        placeholder="e.g., Senior React Developer"
        required
      />

      {{-- Description --}}
      <x-forms.field label="Job Description" name="description">
        <textarea name="description" id="description" rows="10"
          placeholder="Describe the role, responsibilities, and requirements..."
          class="w-full px-5 py-4 bg-slate-800/50 border border-slate-700/50 rounded-xl 
                 text-slate-100 placeholder-slate-500 text-sm resize-none
                 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                 hover:border-slate-600 transition-colors duration-200 leading-relaxed"
          required>{{ old('description') }}</textarea>
      </x-forms.field>

      {{-- Two Column Layout --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        {{-- Location --}}
        <x-forms.input 
          label="Location" 
          name="location"
          placeholder="e.g., Cairo, Egypt"
          required
        />

        {{-- Salary --}}
        <x-forms.input 
          label="Salary" 
          name="salary"
          placeholder="e.g., 50,000 - 80,000 EGP"
          required
        />

      </div>

      {{-- Two Column Layout --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- Job Type --}}
        <x-forms.field label="Job Type" name="type">
          <select name="type" id="type"
            class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-slate-100"
            required>
            <option value="">Select job type...</option>
            <option value="Full-time" {{ old('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
            <option value="Part-time" {{ old('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
            <option value="Contract" {{ old('type') == 'Contract' ? 'selected' : '' }}>Contract</option>
            <option value="Remote" {{ old('type') == 'Remote' ? 'selected' : '' }}>Remote</option>
          </select>
        </x-forms.field>

        {{-- Application URL --}}
        <x-forms.input 
          label="Application URL" 
          name="url"
          type="url"
          placeholder="https://example.com/apply"
          required
        />
        

      </div>

      {{-- Two Column Layout --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- Posted Date --}}
        <x-forms.input 
          label="Posted Date" 
          name="posted_date"
          type="date"
          required
        />

        {{-- Closing Date --}}
        <x-forms.input 
          label="Closing Date" 
          name="closing_date"
          type="date"
          required
        />

        

      </div>

      {{-- Tags --}}
      @if(isset($tags) && $tags->count())
        <x-forms.field label="Tags (Select one or more)" name="tags">
          <select name="tags[]" id="tags" multiple required
            class="w-full h-50 px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-slate-100">
            @foreach ($tags as $tag)
              <option value="{{ $tag->id }}"
                {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                {{ $tag->name }}
              </option>
            @endforeach
          </select>
        </x-forms.field>
      @endif

      {{-- Job Logo Upload --}}
      <x-forms.field label="Job Logo (Optional)" name="logo">
        <div class="space-y-4">

          {{-- File Input --}}
          <input type="file" name="logo" id="logo"
            accept="image/png, image/jpeg, image/gif"
            class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl 
                   text-slate-100 text-sm
                   file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                   file:text-sm file:font-thin file:bg-blue-600 file:text-white
                   file:hover:bg-blue-500 file:cursor-pointer file:transition-colors
                   focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                   hover:border-slate-600 transition-colors duration-200">

          <p class="text-xs text-slate-500">Accepted formats: PNG, JPEG, GIF (Max 2MB)</p>

          {{-- Image Preview Container --}}
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

            {{-- Current Image --}}
            @if(isset($job) && $job->logo)
              <div class="flex flex-col">
                <p class="text-sm font-thin text-slate-300 mb-3">Current Logo</p>
                <div class="relative group rounded-xl overflow-hidden border border-slate-700/50 bg-slate-800/50 h-48 flex items-center justify-center">
                  <img src="{{ Storage::url($job->logo) }}" alt="Current job logo" class="w-full h-full object-cover">
                  <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <p class="text-white text-sm font-medium">Current</p>
                  </div>
                </div>
              </div>
            @endif

              {{-- New Image Preview --}}
              <div class="flex flex-col" id="previewContainer" style="display: none;">
              <p class="text-sm fonth-thin text-slate-300 mb-3">New Logo Preview</p>

              <div class="relative rounded-xl overflow-hidden border border-blue-500/50 bg-slate-800/50 
                          w-36 h-36 flex items-center justify-left mx-auto shadow-md">
                <img id="logoPreview" 
                    src="" 
                    alt="New logo preview"
                    class="w-full h-full object-contain p-2">
              </div>
            </div>

          </div>
        </div>
      </x-forms.field>

      {{-- Divider --}}
      <x-forms.divider />

      {{-- Featured Checkbox --}}

      <input type="hidden" name="is_featured" value="0">

      <x-forms.checkbox 
          label="Mark this job as Featured" 
          name="is_featured" 
          value="1"
      />
      {{-- Submit Button --}}
      <div class="flex items-center justify-between pt-4">
        <a href="{{ route('index') }}"
           class="px-6 py-3 text-slate-300 fonth-thin rounded-xl
                  hover:text-white hover:bg-slate-700/50 transition-all duration-200 cursor-pointer">
          Cancel
        </a>
        <button type="submit" class="px-8 py-3 bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 
                 text-white fonth-thin rounded-xl shadow-lg hover:shadow-xl
                 transition-all duration-200 ease-out active:scale-95
                 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:ring-offset-2 focus:ring-offset-slate-900 cursor-pointer">
          Post Job
        </button>
      </div>

    </form>
  </div>

  <script>
    const logoInput = document.getElementById('logo');
    const previewContainer = document.getElementById('previewContainer');
    const logoPreview = document.getElementById('logoPreview');

    logoInput.addEventListener('change', function(e) {
      const file = e.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          logoPreview.src = event.target.result;
          previewContainer.style.display = 'flex';
        };
        reader.readAsDataURL(file);
      } else {
        previewContainer.style.display = 'none';
      }
    });
  </script>
</x-layout>
