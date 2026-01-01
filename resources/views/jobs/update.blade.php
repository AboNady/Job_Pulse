<x-layout>
@can('update', $job)
    <div class="max-w-15xl mx-auto px-6 py-12">

        {{-- Header --}}
        <div class="mb-12">
            <h1 class="text-5xl font-bold text-white mb-2 tracking-tight">Edit Job</h1>
            <p class="text-slate-400 text-lg">Update the job details below</p>
        </div>

        {{-- Form --}}
        <form method="POST"
              action="{{ route('jobs.update', $job) }}"
              enctype="multipart/form-data"
              class="space-y-8 bg-gradient-to-br from-slate-800/40 to-slate-900/40 backdrop-blur-sm p-8 rounded-2xl border border-slate-700/50 shadow-xl">
            @csrf
            @method('PATCH')

            {{-- Job Title --}}
            <x-forms.input 
                label="Job Title"
                name="title"
                placeholder="e.g., Senior React Developer"
                :value="old('title', $job->title)"
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
                    required>{{ old('description', $job->description) }}</textarea>
            </x-forms.field>

            {{-- Two Column Layout --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Location --}}
                <x-forms.input
                    label="Location"
                    name="location"
                    placeholder="e.g., Cairo, Egypt"
                    :value="old('location', $job->location)"
                    required
                />

                {{-- Salary --}}
                <x-forms.input
                    label="Salary"
                    name="salary"
                    placeholder="e.g., 50,000 - 80,000 EGP"
                    :value="old('salary', $job->salary)"
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
                        @foreach(['Full-time','Part-time','Contract','Remote'] as $type)
                            <option value="{{ $type }}"
                                {{ old('type', $job->type) === $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </x-forms.field>
                {{-- Application URL --}}
                <x-forms.input
                    type="url"
                    label="Application URL"
                    name="url"
                    placeholder="https://example.com/apply"
                    :value="old('url', $job->url)"
                    required
                />
            </div>

            {{-- Two Column Layout --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Posted Date --}}
                <x-forms.input
                    type="date"
                    label="Posted Date"
                    name="posted_date"
                    :value="$job->closing_date->format('Y-m-d')"
                    required
                />
                
                {{-- You no longer need to type old() here --}}
                <x-forms.input 
                    type="date" 
                    label="Closing Date" 
                    name="closing_date" 
                    :value="$job->closing_date->format('Y-m-d')" 
                    required 
                />

            </div>

            {{-- Tags --}}
            @if(isset($tags) && $tags->count())
                <x-forms.field label="Tags (Select one or more)" name="tags">
                    <select name="tags[]" id="tags"
                          multiple required
                          class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-slate-100">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ in_array($tag->id, old('tags', $job->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
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
                                  file:text-sm file:font-semibold file:bg-blue-600 file:text-white
                                  file:hover:bg-blue-500 file:cursor-pointer file:transition-colors
                                  focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20
                                  hover:border-slate-600 transition-colors duration-200">
                    
                    <p class="text-xs text-slate-500">Accepted formats: PNG, JPEG, GIF (Max 2MB)</p>

                    {{-- Image Preview Container --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        {{-- Current Image --}}
                        @if($job->logo)
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-300 mb-3">Current Logo</p>
                                <div class="relative group rounded-xl overflow-hidden border border-slate-700/50 bg-slate-800/50 h-48 flex items-center justify-center">
                                    <img src="{{ Storage::url($job->logo) }}" 
                                         alt="Current job logo"
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <p class="text-white text-sm font-medium">Current</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- New Image Preview --}}
                        <div class="flex flex-col" id="previewContainer" style="display: none;">
                            <p class="text-sm font-semibold text-slate-300 mb-3">New Logo Preview</p>
                            <div class="relative rounded-xl overflow-hidden border border-blue-500/50 bg-slate-800/50 h-48 flex items-center justify-center">
                                <img id="logoPreview" 
                                     src="" 
                                     alt="New logo preview"
                                     class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </x-forms.field>


            <x-forms.divider />

            {{-- Featured Checkbox --}}
            <x-forms.checkbox label="Mark this job as Featured" name="is_featured" :checked="(bool) $job->is_featured" />


            {{-- Submit --}}
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('jobs.manage') }}"
                   class="px-6 py-3 text-slate-300 font-semibold rounded-xl hover:text-white hover:bg-slate-700/50 cursor-pointer">
                    Cancel
                </a>
                <button type="submit"
                        class="px-8 py-3 bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600
                               text-white font-semibold rounded-xl shadow-lg hover:shadow-xl active:scale-95
                               focus:outline-none focus:ring-2 focus:ring-blue-400/50 cursor-pointer">
                    Save Changes
                </button>
            </div>

        </form>
    </div>
@endcan
</x-layout>

<script>
    const logoInput = document.getElementById('logo');
    const previewContainer = document.getElementById('previewContainer');
    const logoPreview = document.getElementById('logoPreview');

    logoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                logoPreview.src = e.target.result;
                previewContainer.style.display = 'flex';
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>
