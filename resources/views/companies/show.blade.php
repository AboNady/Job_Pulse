<x-layout>

@auth
  @cannot('update', $company)
    {{-- Not Authorized --}}
    <div class="max-w-5xl mx-auto px-6 py-12">
      <div class="bg-slate-900/40 backdrop-blur-xl border border-red-500/20 
                  rounded-2xl p-12 text-center shadow-xl relative overflow-hidden">

        {{-- Soft red glow --}}
        <div class="absolute inset-0 bg-red-600/10 blur-3xl -z-10"></div>

        <svg class="w-16 h-16 text-red-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 9v2m0 4v2m0 4v2m0-14a9 9 0 110 18 9 9 0 010-18z"/>
        </svg>

        <h2 class="text-3xl font-semibold text-white mb-2 tracking-wide">Access Denied</h2>

        <p class="text-slate-400 mb-8">
            You are logged in as <span class="font-semibold text-white">{{ auth()->user()->name }}</span>,
            but you don’t have permission to edit this company.
        </p>

        <a href="{{ route('dashboard') }}"
           class="inline-block px-6 py-3 rounded-xl bg-gradient-to-br from-blue-600 to-blue-700
                  hover:from-blue-500 hover:to-blue-600 text-white font-semibold shadow-lg
                  transition-all duration-200 active:scale-95">
          Back to Dashboard
        </a>
      </div>
    </div>
  @endcannot
@endauth


@can('update', $company)

  <div class="max-w-6xl mx-auto px-6 py-12">

    {{-- Header --}}
    <div class="mb-12">
      <h1 class="text-5xl font-light text-white mb-3 tracking-tight">Edit Company</h1>
      <p class="text-slate-400 text-lg">Update your company information</p>
    </div>

    {{-- Form --}}
    <form method="POST"
          action="{{ route('companies.update', $company) }}"
          enctype="multipart/form-data"
          class="space-y-10 bg-slate-900/40 backdrop-blur-xl border border-slate-700/40
                 p-10 rounded-3xl shadow-2xl relative overflow-hidden">

      {{-- Subtle gradient glow --}}
      <div class="absolute -top-32 -right-32 w-72 h-72 bg-blue-600/10 rounded-full blur-3xl"></div>

      @csrf
      @method('PATCH')

      {{-- Company Information --}}
      <div>
        <h2 class="text-lg font-medium text-blue-300 mb-6 flex items-center gap-2 tracking-wide">
          Company Details
        </h2>

        <div class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <x-forms.input label="Company Name" name="employer_name" type="text"
                           placeholder="Company Name" required
                           value="{{ old('employer_name', $company->name) }}" />

            <x-forms.input label="Phone Number" name="employer_phone" type="tel"
                           placeholder="+1 (555) 123-4567" required
                           value="{{ old('employer_phone', $company->phone) }}" />
          </div>

          <x-forms.input label="Company Email" name="employer_email" type="email"
                         placeholder="hello@company.com" required
                         value="{{ old('employer_email', $company->email) }}" />

          <x-forms.input label="Company Address" name="employer_address" type="text"
                         placeholder="123 Business St, City" required
                         value="{{ old('employer_address', $company->address) }}" />
        </div>
      </div>

      <x-forms.divider />

      {{-- Logo Section --}}
      <div>
        <h2 class="text-lg font-medium text-blue-300 mb-6 flex items-center gap-2 tracking-wide">
          Company Logo
        </h2>

        <x-forms.field label="Logo (Optional)" name="employer_logo">
          <div class="space-y-4">

            {{-- File Input --}}
            <input type="file" name="employer_logo" id="employer_logo"
                   accept="image/png, image/jpeg, image/gif"
                   class="w-full px-5 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl
                          text-slate-100 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg
                          file:border-0 file:bg-blue-600 file:text-white hover:border-blue-500/40
                          focus:ring-2 focus:ring-blue-500/30 transition">

            <p class="text-xs text-slate-500">Accepted formats: PNG, JPEG, GIF (Max 2MB)</p>

            {{-- Preview Section --}}
            <div class="flex items-start gap-8 mt-6">

              {{-- Current Logo --}}
              @if($company->logo)
                <div class="flex flex-col">
                  <p class="text-sm font-semibold text-slate-300 mb-3">Current Logo</p>
                  <div class="w-28 h-28 rounded-xl border border-slate-700/50 bg-slate-800/40
                              overflow-hidden shadow-inner">
                    <img src="{{ Storage::url($company->logo) }}" class="w-full h-full object-cover">
                  </div>
                </div>
              @endif

              {{-- New Preview --}}
              <div class="flex flex-col hidden" id="logoPreviewContainer">
                <p class="text-sm font-semibold text-slate-300 mb-3">New Logo Preview</p>
                <div class="w-28 h-28 rounded-xl border border-blue-500/50 bg-slate-800/40
                            overflow-hidden shadow-inner">
                  <img id="logoPreview" class="w-full h-full object-cover">
                </div>
              </div>

            </div>
          </div>
        </x-forms.field>
      </div>

      {{-- Buttons --}}
      <div class="flex items-center justify-between pt-4">
        <a href="{{ route('dashboard') }}"
           class="px-6 py-3 rounded-xl text-slate-300 font-medium
                  hover:text-white hover:bg-slate-700/50 transition">
          Cancel
        </a>

        <button type="submit"
                class="px-8 py-3 rounded-xl bg-gradient-to-br from-blue-600 to-blue-700
                       hover:from-blue-500 hover:to-blue-600 text-white font-semibold
                       shadow-lg hover:shadow-blue-500/20 transition active:scale-95">
          Update Company
        </button>
      </div>

    </form>

  </div>
@endcan


@guest
  <div class="max-w-5xl mx-auto px-6 py-12">
    <div class="bg-slate-900/40 border border-yellow-500/20 backdrop-blur-md
                rounded-2xl p-12 text-center shadow-xl">
      <svg class="w-16 h-16 text-yellow-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>

      <h2 class="text-3xl font-semibold text-white mb-2 tracking-wide">Login Required</h2>

      <p class="text-slate-400 mb-8">You must be logged in to edit company information.</p>

      <a href="{{ route('login') }}"
         class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold shadow-lg transition active:scale-95">
        Log In
      </a>
    </div>
  </div>
@endguest

</x-layout>


<script>
const input = document.getElementById('employer_logo');
const preview = document.getElementById('logoPreview');
const previewContainer = document.getElementById('logoPreviewContainer');

if (input) {
  input.addEventListener('change', e => {
    const file = e.target.files[0];
    if (!file) return previewContainer.classList.add('hidden');

    const reader = new FileReader();
    reader.onload = event => {
      preview.src = event.target.result;
      previewContainer.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
  });
}
</script>
